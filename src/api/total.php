<?php

require ('./config.php');

$sql = "SELECT SUM(subtotal) AS total_subtotal FROM cart";

try {
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $totalSubtotal = $row['total_subtotal'];

        echo json_encode($totalSubtotal);
    } else {
        echo "No results found.";
    }

} catch (mysqli_sql_exception) {
    echo "Error: " . $e->getMessage();
}