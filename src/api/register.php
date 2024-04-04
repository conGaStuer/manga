<?php
session_start();
require ('./config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Lấy dữ liệu gửi từ client
    $username = $data->username;
    $password = $data->password;

    // Sử dụng câu lệnh INSERT để thêm dữ liệu mới vào bảng 'users'

    $check_query = "SELECT * FROM user where username = '$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $response = array("message" => "Username already exists");
    } else {
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {

            $response = array('message' => 'Registration successful');
        } else {
            $response = array('message' => 'Error: ' . $sql . '<br>' . $conn->error);
        }
    }

    // Trả về JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối đến MySQL
$conn->close();
?>