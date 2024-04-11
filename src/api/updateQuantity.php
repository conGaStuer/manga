<?php

require ('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->mangaId) && isset($data->quantity)) {
        $mangaId = $data->mangaId;
        $quantity = $data->quantity;
        $sql = "UPDATE cart SET quantity = '$quantity' WHERE manga_id = '$mangaId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode(array("message" => "Update Successful"));
        } else {
            echo json_encode(array("message" => "Update Error"));

        }
    }
}