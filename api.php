<?php
header('Content-type: application/json');
include 'vendor/autoload.php';
include 'inc/db.php';


$sql = "SELECT * FROM `maxrnb` ORDER BY rand() LIMIT 5";
$result = $db->query($sql);
$mp3_list = $result->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($mp3_list);
