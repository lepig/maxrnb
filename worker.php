<?php

include 'func.php';
include 'inc/db.php';

global $db;


// $mid = 157;
// $url = "http://maxrnb.cn/music-{$mid}.html";
// $html_str = sendRequest($url);

// getSongInfo($html_str);

function worker() {
    static $mid = 0;
    $table = 'maxrnb';
    global $db;
    
    if ($mid == 0) {
        $sql = "SELECT * FROM `maxrnb` ORDER BY `id` DESC LIMIT 1";
        $data = $db->query($sql);
        $row = $data->fetch(PDO::FETCH_ASSOC);

        if (! empty($row)) {
            $mid = $row['mid'] + 1;
        } else {
            $mid = 1;
        }
    } else {
        $mid++;
    }

    // dd($row);

    $url = "http://maxrnb.cn/music-{$mid}.html";
    $html_str = sendRequest($url);
    $mp3info = getSongInfo($html_str);
    $mp3info['mid'] = $mid;

    //入库
    if (isset($mp3info['url'])) {
        $result = $db->insert($table, $mp3info);
    }
    // dump($result, $db->pdo->lastInsertId());
    
    return $mp3info;
}

while (true) {
    $mp3info = worker();
    file_put_contents('/tmp/maxrnb.log', date('[Y-m-d H:i:s] ') . json_encode($mp3info) . PHP_EOL, FILE_APPEND);
    sleep(1);

}