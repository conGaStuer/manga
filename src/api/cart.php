<?php

require ('./config.php');

header('Content-Type: application/json');

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cart = array();
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
    }
    echo json_encode($cart);
} else {
    echo json_encode(array("message" => "Not found"));
}