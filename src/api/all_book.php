<?php

require ("./config.php");

header("Content-Type: application/json");

$sql = "SELECT *  FROM mangas ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mangas = array();
    while ($row = $result->fetch_assoc()) {
        $mangas[] = $row;
    }
    echo json_encode($mangas); // Sử dụng $mangas thay vì $manga
} else {
    echo json_encode(array("message" => "Không có dữ liệu được tìm thấy"));
}

$conn->close();