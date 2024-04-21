<?php
session_start();
require "./config.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username;
    $password = $data->password;

    $sql_login = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql_login);

    if ($result->num_rows > 0) {
        // Set the session variable upon successful login
        $_SESSION['user'] = $username;

        // Echo the session variable for debugging
        echo json_encode($_SESSION);

        // Fetch user data and send it as response
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        // Send an error message if login fails
        echo json_encode(array("error" => "Invalid username or password"));
    }
}

$conn->close();
?>