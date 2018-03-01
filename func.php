<?php

include 'vendor/autoload.php';
use Sunra\PhpSimple\HtmlDomParser;


function sendRequest($url = null) {
    $handle = null;

    if (empty($url)) {
        exit('url is not empty!!!');
    } else {
        $handle = fopen($url, 'rb');
    }
    //防止中文乱码
    // $opts = [
    //     'file' => [
    //         'encoding' => 'utf-8'
    //     ]
    // ];
    // $opts = [
    //     'http' => [
    //         'encoding' => 'utf-8'
    //     ]
    // ];
    // $ctxt = stream_context_create($opts);

    $contents = stream_get_contents($handle);
    $contents = iconv('gb2312', 'utf-8//TRANSLIT//IGNORE', $contents); //http://blog.51cto.com/ouyangjun/1710598

    fclose($handle);
    return $contents;
}



//获取歌曲信息
function getSongInfo($html_str) {
    // dd($html_str);
    if (!$html_str) {
        exit('html不能为空');
    }
    $dom = HtmlDomParser::str_get_html($html_str);

    // dd($dom->find('div[id=messagetext]'));
    foreach ($dom->find('div[id=messagetext]') as $v) {
        if (strpos($v->innertext, '出错了，歌曲数据不存在') !== FALSE) {
            
            return false;
            exit('出错了，歌曲数据不存在');
        }
    }

    //获取歌曲名称
    $elems = $dom->find('h2');
    $title = '';
    foreach ($elems as $el) {
        if (isset($el->attr['title'])) {
            $title = $el->attr['title'];
        }
    }

    //获取歌手名称
    $elems = $dom->find('p[class=blue lt] a', 0); //选中p标签里的a标签
    $singer = $elems->innertext; //然后通过innertext属性获取被a标签包裹住的text值

    //获取歌曲类型
    $elems = $dom->find('p[class=blue lt] a', 1); //同上，就是选择抓取到索引为1的数组对象
    $type = $elems->innertext;

    //获取音乐封面图
    $coverUrl = $dom->find('div[class=user lt]', 0)->children(0)->children(0)->src;
    /** 也可以使用 $dom->find('div[class=user lt] a img', 0)->src; */

    //获取文件大小
    
    
    //获取歌曲时长
    

    //获取mp3地址信息
    $elems = $dom->find('audio', 0);
    $mp3url = $elems->attr['src'];

    $data = [
        'title'  => $title,
        'singer' => $singer,
        'type'   => $type,
        'url'    => $mp3url,
        'cover'  => $coverUrl,
    ];
    return $data;
}