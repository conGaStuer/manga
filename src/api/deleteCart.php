<?php

require ('./config.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->mangaId)) {
        $manga_id = $data->mangaId;
        $sql = "SELECT * FROM cart WHERE manga_id = '$manga_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql_delete = "DELETE FROM cart WHERE manga_id = '$manga_id'";
            $result_delete = $conn->query($sql_delete);
            echo json_encode(array("message" => "Delete successful"));
        } else {
            echo json_encode(array("message" => "Error when delete"));
        }
    }
}
$conn->close();