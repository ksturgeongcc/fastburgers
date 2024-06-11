<?php
// include the database connection information
include '../config/dbConfig.php';
// include the header component
include '../partials/header.php';
// include the navigation
include '../partials/navigation.php';

// Fetch Saver Menu
$saverMenu = $conn->prepare("SELECT 
    sm.saver_menu_id,
    sm.saver_menu_name,
    sm.saver_menu_item,
    sm.saver_menu_deal,
    sm.saver_menu_start,
    sm.saver_menu_end,
    sm.saver_menu_type
FROM saver_menu sm");
$saverMenu->execute();
$saverMenu->store_result();
$saverMenu->bind_result($saverId, $saverName, $saverItem, $saverDeal, $saverStart, $saverEnd, $saverType);

// Fetch Regular Menu
$regularMenu = $conn->prepare("SELECT
    rm.regular_menu_id,
    rm.regular_menu_meal_type,
    rm.regular_menu_type
FROM regular_menu rm");
$regularMenu->execute();
$regularMenu->store_result();
$regularMenu->bind_result($regularId, $regularMealType, $regularType);
?>

<div class="min-h-screen bg-gray-50/50 p-5">
    <div class="mb-10">
        <h2 class="text-2xl font-bold mb-5">Saver Menu</h2>
        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md">
            <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Menu ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Item</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Deal</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Start</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">End</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Type</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    <?php while($saverMenu->fetch()) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><?= htmlspecialchars($saverId) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverName) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverItem) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverDeal) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverStart) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverEnd) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($saverType) ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-5">Regular Menu</h2>
        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md">
            <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Menu ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Meal Type</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Type</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    <?php while($regularMenu->fetch()) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><?= htmlspecialchars($regularId) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($regularMealType) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($regularType) ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>
