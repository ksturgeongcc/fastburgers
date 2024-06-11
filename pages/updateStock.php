<?php
include '../config/dbConfig.php';

$itemID = $_POST['itemID'];
$newStockLimit = $_POST['newStockLimit'];

// Update the stock limit in the item table
$updateStock = $conn->prepare("UPDATE item SET stock_limit = ? WHERE item_id = ?");
if (!$updateStock) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
$updateStock->bind_param("ii", $newStockLimit, $itemID);
if (!$updateStock->execute()) {
    die("Execute failed: (" . $updateStock->errno . ") " . $updateStock->error);
}

// Redirect back to the stock details page
header("Location: /fastburgers/stockDetails/$itemID");
exit();