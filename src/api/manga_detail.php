<?php

require ('./config.php');

if (isset($_GET['id'])) {
    $mangaId = $_GET['id'];

    $sql = "SELECT * FROM mangas where manga_id = '$mangaId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array("mangaID" => "Cant find manga!!"));
    }
} else {
    echo json_encode(array("message" => "Not found!!"));
}

$conn->close();