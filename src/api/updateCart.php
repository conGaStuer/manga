<?php

require ('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "UPDATE cart SET subtotal = quantity * price";
        $result = $conn->query($sql);
        echo json_encode(array("message" => "Update Cart Successful"));
    } catch (mysqli_sql_exception) {
        echo json_encode(array("message" => "Update Error"));
    }


}