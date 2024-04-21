<?php
session_start();

require ("./config.php");
$data = json_decode(file_get_contents("php://input"));
$phone = $data->phone;

if (isset($data->cartItems) && is_array($data->cartItems)) {
    foreach ($data->cartItems as $item) {
        // Trích xuất thông tin từ mỗi mục đơn hàng
        $mangaId = $item->manga_id;
        $name = $item->name;
        $quantity = $item->quantity;
        $price = $item->price;
        $hinhanh = $item->hinhanh;

        // Thêm dữ liệu đơn hàng vào cơ sở dữ liệu
        $sql_insert_order = "INSERT INTO order_detail ( manga_id, name, quantity, price, hinhanh, order_status,phone)
            VALUES ( '$mangaId', '$name', '$quantity', '$price', '$hinhanh', 'Not Approve','$phone')";
        $result = $conn->query($sql_insert_order);
        if (!$result) {
            // Nếu có lỗi xảy ra khi thêm đơn hàng, trả về thông báo lỗi
            echo json_encode(array("message" => "Add to order fail"));
            exit(); // Dừng việc thêm đơn hàng nếu có lỗi
        }
    }
    // Trả về thông báo thành công nếu không có lỗi xảy ra khi thêm đơn hàng
    echo json_encode(array("message" => "Add to order success"));
} else {
    // Trả về thông báo nếu dữ liệu đơn hàng không hợp lệ
    echo json_encode(array("message" => "Invalid order data"));
}

?>