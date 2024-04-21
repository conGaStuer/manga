<?php
session_start();
require ('./config.php');

header("Content-Type: application/json");

$sql = 'SELECT * FROM order_detail';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode($orders);
} else {
    echo json_encode(array("message" => "Error"));
}

$conn->close();

