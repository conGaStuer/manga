<?php
session_start();


require_once ("./config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->manga_id) && isset($data->name) && isset($data->price) && isset($data->hinhanh)) {
        $manga_id = $data->manga_id;
        $mangaName = $data->name;
        $mangaPrice = $data->price;
        $mangaImage = $data->hinhanh;
        $sql_check = "SELECT * FROM cart WHERE manga_id= '$manga_id'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $sql_update = "UPDATE cart SET quantity = quantity + 1, subtotal = price * (quantity + 1) WHERE manga_id = '$manga_id'";
            $result_update = $conn->query($sql_update);
            echo json_encode(array("message" => "Item quantity updated in cart."));
        } else {
            $sql_insert = "INSERT INTO cart  (manga_id,name,quantity,price,subtotal,hinhanh) VALUES
            ('$manga_id','$mangaName',1,'$mangaPrice','$mangaPrice','$mangaImage')";
            $result_insert = $conn->query($sql_insert);
            echo json_encode(array("message" => "Item added to cart successfully."));
        }
    } else {
        echo json_encode(array("message" => "Invalid data provided."));
    }
}

$conn->close();
?>