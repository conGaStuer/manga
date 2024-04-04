<?php
session_start();
require ('./config.php');

$response = array();

if (isset($_SESSION['username'])) {
    $response['username'] = $_SESSION['username'];
} else {
    // Check if a login request is being made (POST method)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"));

        $username = $data->username;
        $password = $data->password;

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $response['message'] = 'Login successful';
        } else {
            $response['error'] = 'Invalid username or password';
        }

        // Close the connection (assuming it's in a separate function)
        $conn->close();
    } else {
        $response['error'] = 'User not logged in';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>