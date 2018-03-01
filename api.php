<?php
header('Content-type: application/json');
include 'vendor/autoload.php';
include 'inc/db.php';
include 'func.php';

use Sunra\PhpSimple\HtmlDomParser;

$sql = "SELECT * FROM `maxrnb` ORDER BY rand() LIMIT 10";
$result = $db->query($sql);
$mp3_list = $result->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($mp3_list);exit;
// 
// 

// $html_str = sendRequest('http://maxrnb.cn/music-217.html');
// $dom = HtmlDomParser::str_get_html($html_str);

// $imgUrl = $dom->find('div[class=user lt]', 0)->children(0)->children(0)->src;


// dump($imgUrl);




