<?php
session_start();
require ('./config.php');

header("Content-Type: application/json");

if (isset($_SESSION['user'])) {
    // If user session exists, retrieve user data based on the session username
    $username = $_SESSION['user'];
    $sql_user = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql_user);

    if ($result->num_rows > 0) {
        // Fetch user data and send it as response
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        // Send an error message if user data is not found
        echo json_encode(array("error" => "User not found"));
    }
} else {
    // Send an error message if user is not logged in
    echo json_encode(array("error" => "User not logged in"));
}

$conn->close();
?>