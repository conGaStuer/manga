<?php

require ('./config.php');
header("Content-Type: application/json");

$sql = "SELECT name,hinhanh,price,category from mangas order by rand() limit 4";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mangas = array();
    while ($row = $result->fetch_assoc()) {
        $mangas[] = $row; // Thêm phần tử vào mảng $mangas
    }
    echo json_encode($mangas); // Sử dụng $mangas thay vì $manga
} else {
    echo json_encode(array("message" => "Không có dữ liệu được tìm thấy"));
}

$conn->close();
?>