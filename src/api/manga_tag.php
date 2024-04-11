<?php
require ('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->mangaTag)) {
        $mangaTag = $data->mangaTag;
        $sql = "SELECT * FROM mangas WHERE tags = '$mangaTag'";
        $result = $conn->query($sql);
        $mangaTags = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mangaTags[] = $row;
            }
            echo json_encode($mangaTags);
        } else {
            echo json_encode(array("error" => "Not found"));
        }
    }
}
?>