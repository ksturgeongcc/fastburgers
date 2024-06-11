<?php
include '../config/dbConfig.php';
include '../partials/header.php';
include '../partials/navigation.php';

$oid = $_GET['oid'];

// Prepare the SQL statement with placeholders
$stockDetails = $conn->prepare("
    SELECT
        o.order_id,
        o.order_date,
        c.customer_name,
        c.customer_tel,
        st.store_name,
        st.store_location,
        st.store_email,
        i.item_id,
        i.item_name,
        i.stock_limit,
        i.restock_threshold,
        i.item_cost
    FROM `order` o
    LEFT JOIN customer c ON o.fk_customer_id = c.customer_id
    INNER JOIN order_items oi ON oi.fk_order_id = o.order_id
    INNER JOIN item i ON oi.fk_item_id = i.item_id
    LEFT JOIN store st ON o.fk_store_id = st.store_id
    WHERE o.order_id = ?
");

// Bind the parameter to the statement
$stockDetails->bind_param("i", $oid);

// Execute the statement
$stockDetails->execute();

// Bind the result variables
$stockDetails->bind_result($oid, $date, $customer, $custTel, $storeName, $storeLocation, $storeEmail, $itemID, $itemName, $stockLimit, $restockThreshold, $itemCost);

// Fetch the results
$stockDetails->fetch();

// Close the statement
$stockDetails->close();

// Determine if the stock is below the threshold
$lowStock = $stockLimit < $restockThreshold;
?>

<div class="flex flex-wrap justify-center mt-20">
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-6 p-4">
        <h2 class="text-xl underline">Customer Details</h2>
        <p><span class="text-slate-600">Customer Name:</span> <?= htmlspecialchars($customer) ?></p>
        <p><span class="text-slate-600">Customer Tel:</span> <?= htmlspecialchars($custTel) ?></p>
    </div>
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-6 p-4">
        <h2 class="text-xl underline">Order Details</h2>
        <p><span class="text-slate-600">Order Number: </span> <?= htmlspecialchars($oid) ?></p>
        <p><span class="text-slate-600">Order Date: </span> <?= htmlspecialchars($date) ?></p>
        <p><span class="text-slate-600">Ordered item ID: </span> <?= htmlspecialchars($itemID) ?></p>
        <p><span class="text-slate-600">Ordered item name: </span> <?= htmlspecialchars($itemName) ?></p>
        <p><span class="text-slate-600">Ordered item cost: </span> <?= htmlspecialchars($itemCost) ?></p>
    </div>
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-6 p-4">
        <h2 class="text-xl underline">Store Details</h2>
        <p><span class="text-slate-600"> Store Name: </span> <?= htmlspecialchars($storeName) ?></p>
        <p><span class="text-slate-600"> Store Location: </span> <?= htmlspecialchars($storeLocation) ?></p>
        <p><span class="text-slate-600"> Store Email: </span> <?= htmlspecialchars($storeEmail) ?></p>
    </div>
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-6 p-4">
        <h2 class="text-xl underline">Stock Details</h2>
        <p><span class="text-slate-600"> Item Stock Limit: </span> <?= htmlspecialchars($stockLimit) ?></p>
    </div>
</div>

<?php if ($lowStock): ?>
<div class="flex w-full justify-center mt-5">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Warning!</strong>
        <span class="block sm:inline">The stock for this item is below the minimum threshold.</span>
    </div>
</div>
<?php endif; ?>

<!-- Form to update stock -->
<div class="flex w-full justify-center mt-20">
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/3 mb-20">
        <h2 class="text-xl underline">Update Stock</h2>
        <form method="post" action="/fastburgers/updateStock/<?= $itemID ?>">
            <input type="hidden" name="itemID" value="<?= htmlspecialchars($itemID) ?>">
            <label for="newStockLimit" class="text-slate-600">New Stock Limit:</label>
            <input type="number" id="newStockLimit" name="newStockLimit" class="border rounded p-2 mb-4 w-full" required>
            <button type="submit" class="bg-yellow-500 text-white rounded-full p-2">Update Stock Limit</button>
        </form>
    </div>
</div>

<?php
include '../partials/footer.php';
?>