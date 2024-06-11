<?php
// include the database connection information
include '../config/dbConfig.php';
// bring in the header component
include '../partials/header.php';
// include the navigation
include '../partials/navigation.php';

// Fetch all orders with menu type
$orders = $conn->prepare("SELECT
    o.order_id,
    o.order_date,
    o.fk_payment_id,
    c.customer_name,
    p.payment_type,
    IFNULL(sm.saver_menu_name, rm.regular_menu_meal_type) AS menu_name
FROM `order` o
INNER JOIN customer c ON o.fk_customer_id = c.customer_id
INNER JOIN menu_type mt ON o.fk_menu_type_id = mt.menu_type_id
INNER JOIN payment p ON o.fk_payment_id = p.payment_id
LEFT JOIN saver_menu sm ON mt.fk_saver_id = sm.saver_menu_id
LEFT JOIN regular_menu rm ON mt.fk_regular_id = rm.regular_menu_id
ORDER BY o.order_date DESC
");
// Execute the query
$orders->execute();
// Store the results in the variable
$orders->store_result();
// Bind the results
$orders->bind_result($oid, $date, $fk_payment_type, $customer, $payment_type, $menu_name);
?>

<!-- table component taken from tailwind components-->
<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md m-5">
  <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Id</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Date</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Menu</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cash / Card</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">View order details</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
      <!-- this section returns the data -->
      <!-- as I wanted to return all orders I have used a while loop and fetched the data -->
      <!-- the while loop should be around the whole element that I want to repeat for every row of data -->
      <!-- in this example it is the <tr> element (table row) -->
      <?php while($orders->fetch()) : ?>
      <tr class="hover:bg-gray-50">
        <!-- each of the variable created above in the bind_result can be added here -->
        <!-- to return the data we use <?= $variableName ?> this returns the data to the frontend -->
        <td class="px-6 py-4"><?= htmlspecialchars($oid) ?></td>
        <td class="px-6 py-4"><?= htmlspecialchars($customer) ?></td>
        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"><?= htmlspecialchars($date) ?></span></td>
        <td class="px-6 py-4"><?= htmlspecialchars($menu_name) ?></td>
        <td class="px-6 py-4">
          <div class="flex gap-2">
            <span class="inline-flex items-center gap-1 text-white rounded-full <?php if($fk_payment_type == 1) : ?> bg-green-500 <?php elseif($fk_payment_type == 2) : ?> bg-yellow-800 <?php else : ?> bg-red-400 <?php endif ?> px-2 py-1 text-xs font-semibold text-blue-600">
              <?= htmlspecialchars($payment_type) ?>
            </span>
          </div>
        </td>
        <!-- as I want to view the details of each order, I want to pass a parameter $oid -->
        <!-- $oid is a variable name for the order id, as it is being passed as a parameter -->
        <!-- I can call it on the orderDetails page -->
        <!-- orderDetails has been setup slightly different on the .htaccess file -->
        <td class="px-6 py-4 cursor-pointer" onclick="window.location.href='orderDetails/<?= htmlspecialchars($oid) ?>'"><i class="fa-solid fa-eye"></i></td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php
include '../partials/footer.php';
?>
