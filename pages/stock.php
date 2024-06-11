<!-- 
    Show all orders in a table, give the option to view the order details
    -- option to view the customer details
    --- Item name
    --- stock level
    --- trigger an email once table is updated
    --- update stock
-->

<?php
include '../config/dbConfig.php';
include '../partials/header.php';
include '../partials/navigation.php';

$stock = $conn->prepare("SELECT
    o.order_id,
    o.order_date,
    c.customer_name
FROM `order` o
INNER JOIN customer c ON o.fk_customer_id = c.customer_id
ORDER BY o.order_date DESC");

$stock->execute();
$stock->store_result();
$stock->bind_result($oid, $date, $customer);
?>

<!-- table component taken from tailwind components-->
<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md m-5">
  <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Id</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Date</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">View order and stock details</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
    <?php while($stock->fetch()) : ?>
      <tr class="hover:bg-gray-50">
        <td class="px-6 py-4"><?= htmlspecialchars($oid) ?></td>
        <td class="px-6 py-4"><?= htmlspecialchars($customer) ?></td>
        <td class="px-6 py-4">
          <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
            <?= htmlspecialchars($date) ?>
          </span>
        </td>
        <td onclick="window.location.href='/fastburgers/stockDetails/<?= $oid ?>'" class="cursor-pointer">
          <i class="fa-solid fa-eye"></i> View
        </td>
      </tr>
    <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php
include '../partials/footer.php';
?>
