<?php

// include the database connection information,this will be included on all pages that require access to the database
include '../config/dbConfig.php';
// bring in the header component - this is the HTML components needed to render the page
include '../partials/header.php';
// include the navigation
include '../partials/navigation.php';

$staff = $conn->prepare("SELECT 
    s.staff_firstname,
    s.staff_surname,
    s.staff_shift
FROM `order` o
LEFT JOIN staff s ON o.fk_staff_id = s.staff_id
GROUP BY s.staff_id, s.staff_firstname, s.staff_surname, s.staff_shift
;");
$staff->execute();
$staff->store_result();
$staff->bind_result($firstName, $surname, $shift);
?>
<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md m-5">
  <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Firstname</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Surname</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Shift</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
         <?php while($staff->fetch()) : ?>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><?= htmlspecialchars($firstName) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($surname) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($shift) ?></td>
            </tr>
        <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php
include '../partials/footer.php';
?>