<?php
session_start();

require ('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->userId)) {
        $userId = $data->userId;
        $sql_user = "SELECT * FROM user WHERE user_id = '$userId'";

        $result = $conn->query($sql_user);

        if ($result->num_rows > 0) {
            $user = array();
            while ($row = $result->fetch_assoc()) {
                $user = $row;
            }
            echo json_encode($user);
        }
    }
}




?>