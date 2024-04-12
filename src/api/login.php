<?php
session_start();
require "./config.php";


header("Content-Type: application/json");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username;
    $password = $data->password;

    $sql_login = "SELECT * FROM user WHERE username = '$username'AND password = '$password'";
    $result = $conn->query($sql_login);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $user = array();
        while ($row = $result->fetch_assoc()) {
            $user = $row;
        }
        echo json_encode($user);
        // echo json_encode(array("message" => "Login Success", $_SESSION["username"]));


    } else {
        echo "chua co du lieu";
    }


}

$conn->close();

?>