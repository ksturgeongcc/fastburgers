<?php

// include the database connection information,this will be included on all pages that requrie
// access to the database
include '../config/dbConfig.php';
// bring in the header component - this is the HTML components needed to render the page
include '../partials/header.php';
// include the navigation
include '../partials/navigation.php';

// all queries will be returned in a similar way, in this example I have returned all orders
// your query may be different denpending on what you want to return
// $orders is a variable wihich initially holds the query, the prepare() fucnction prevents
//  sql injection
$orders = $conn->prepare("SELECT
o.order_id,
o.order_date,
o.fk_payment_id,
c.customer_name,
p.payment_type
 from `order` o
 INNER JOIN customer c ON o.fk_customer_id = c.customer_id
 INNER JOIN menu_type m ON o.fk_menu_type_id = m.menu_type_id
 INNER JOIN payment p ON o.fk_payment_id = p.payment_id
 ORDER BY o.order_date DESC
");
//  the variable $orders is now being instructed to run the query
$orders->execute();
//  store the results in the variable
$orders->store_result();
// binding the results - You are just giving the data a variable name to make it neater for
// returning to the interface. This will be called later in the code
$orders->bind_result($oid, $date, $fk_payment_type, $customer, $payment_type);
?>

<!-- table component taken from tailwind components-->
<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
  <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
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
      <!-- as I wanted to return all orders I have use a while loop and have fetched the data -->
      <!-- the wihile loop should be round the whole element that I want to repeat for every row of data -->
      <!-- in this example it it the <tr> element (table row) -->
    <?php while($orders->fetch()) : ?>
      <tr class="hover:bg-gray-50">
        <!-- each of the variable created above in the bind_result can be added here -->
        <!-- to return the data we use <?= $variableName ?> this returns the data to the frontend -->
        <td class="px-6 py-4"><?= $oid ?></td>
        <td class="px-6 py-4"> <?= $customer ?></td>
        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
            <?= $date ?>
          </span>
        </td>
        <td class="px-6 py-4">Lunch</td>
        <td class="px-6 py-4">
          <div class="flex gap-2"><span class="inline-flex items-center gap-1 text-white rounded-full <?php if($fk_payment_type == 1) : ?> bg-green-500 <?php elseif($fk_payment_type == 2) : ?>bg-yellow-800 <?php else : ?> bg-red-400 <?php endif ?> px-2 py-1 text-xs font-semibold text-blue-600">
              <?= $payment_type ?>
            </span>
          </div>
        </td>
       
          <!-- as I want to view the details of each order, I want to pass a parameter $oid -->
          <!-- $oid is a variable name for the order id, as it is being passed as a parameter
                I can call it on the orderDetails page
                orderDetails has been setup slightly different on the .htaccess file
          -->
        <td onclick="window.location.href='orderDetails/<?= $oid ?>'"><i class="fa-solid fa-eye"></i></td>

  
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php
include '../partials/footer.php';