<?php

header("Access-Control-Allow-Origin: *"); // Cho phép truy cập từ bất kỳ domain nào
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Cho phép các phương thức POST, GET và OPTIONS
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Các header được phép


$server = "localhost";
$username = "root";
$password = "";
$database = "manga_online";


// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($server, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
print_r($_SERVER["REQUEST_METHOD"]);
// Xử lý yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Kiểm tra dữ liệu đã gửi từ phía client
    if (isset($data->username) && isset($data->password)) {
        $username = $data->username;
        $password = $data->password;
        print_r($username);
        // Truy vấn kiểm tra tài khoản trong cơ sở dữ liệu
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        // Kiểm tra kết quả truy vấn
        if ($result->num_rows > 0) {
            // Tài khoản hợp lệ, gửi phản hồi JSON thành công
            echo json_encode(array('message' => "Login successful"));
        } else {
            // Tài khoản không hợp lệ, gửi phản hồi JSON lỗi
            echo json_encode(array('error' => 'Invalid username or password'));
        }
    } else {
        // Dữ liệu không đầy đủ, gửi phản hồi JSON lỗi
        echo json_encode(array('error' => 'Missing username or password'));
    }
} else {
    // Yêu cầu không hợp lệ, gửi phản hồi JSON lỗi
    echo json_encode(array('error' => 'Invalid request method'));
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();

?>