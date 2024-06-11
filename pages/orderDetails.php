<!-- 
    Show all orders in a table, give the option to view the order details
    -- option to view the customer details
    --- Order for specific customer
    --- Order date and time
    --- Menu ordered from
    --- Cash / Card
    --- member of staff
    
-->
<?php
include '../config/dbConfig.php';
include '../partials/header.php';
include '../partials/navigation.php';

// Get the order ID from the URL parameter
$oid = $_GET['oid'];

// Prepare the query to fetch order details including menu information
$orderDetails = $conn->prepare("
    SELECT
        o.order_id,
        o.order_date,
        c.customer_name,
        c.customer_tel,
        st.store_name,
        p.payment_type,
        IFNULL(sm.saver_menu_name, rm.regular_menu_meal_type) AS menu_name,
        s.staff_firstname
    FROM `order` o
    LEFT JOIN customer c ON o.fk_customer_id = c.customer_id
    LEFT JOIN menu_type m ON o.fk_menu_type_id = m.menu_type_id
    LEFT JOIN payment p ON o.fk_payment_id = p.payment_id
    LEFT JOIN staff s ON o.fk_staff_id = s.staff_id
    LEFT JOIN store st ON o.fk_store_id = st.store_id
    LEFT JOIN saver_menu sm ON m.fk_saver_id = sm.saver_menu_id
    LEFT JOIN regular_menu rm ON m.fk_regular_id = rm.regular_menu_id
    WHERE o.order_id = ?
");

// Bind the order ID parameter
$orderDetails->bind_param("i", $oid);

// Execute the query
$orderDetails->execute();
$orderDetails->store_result();
$orderDetails->bind_result($oid, $date, $customer, $custTel, $store, $payment_type, $menu_name, $staff);

// Fetch the results
$orderDetails->fetch();
?>

<!-- component -->
<link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
<!-- Display the order details -->
<div class="flex flex-wrap w-full justify-center mt-20">
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-10 px-4">
        <h2 class="text-xl underline mb-4">Customer Details</h2>
        <p><span class="text-slate-600 font-semibold">Customer Name:</span> <?= htmlspecialchars($customer) ?></p>
        <p><span class="text-slate-600 font-semibold">Customer Tel:</span> <?= htmlspecialchars($custTel) ?></p>
    </div>
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-10 px-4">
        <h2 class="text-xl underline mb-4">Order Details</h2>
        <p><span class="text-slate-600 font-semibold">Order Number: </span> <?= htmlspecialchars($oid) ?></p>
        <p><span class="text-slate-600 font-semibold">Order Date: </span> <?= htmlspecialchars($date) ?></p>
        <p><span class="text-slate-600 font-semibold">Payment Type: </span> <?= htmlspecialchars($payment_type) ?></p>
        <p><span class="text-slate-600 font-semibold">Menu Type: </span> <?= htmlspecialchars($menu_name) ?></p>
    </div>
    <div class="flex flex-col w-full sm:w-1/2 lg:w-1/4 mb-10 px-4">
        <h2 class="text-xl underline mb-4">Store Details</h2>
        <p><span class="text-slate-600 font-semibold">Store Location: </span> <?= htmlspecialchars($store) ?></p>
    </div>
</div>

<?php
// Include the footer
include '../partials/footer.php';
?>
