<?php
session_start();
require ('./config.php');


if (isset($_SESSION['username'])) {

    $response = array('username' => $_SESSION['username']);
} else {

    $response = array('error' => 'User not logged in');
}


header('Content-Type: application/json');
echo json_encode($response);
?>