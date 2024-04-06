<?php

require ('./config.php');



$sql = 'SELECT * FROM mangas ORDER BY RAND() LIMIT 3';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $mangas = array();
    while ($row = $result->fetch_assoc()) {
        $mangas[] = $row;
    }
    echo json_encode($mangas);
} else {
    echo json_encode(array('message' => "Not found"));
}