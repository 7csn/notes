<?php

// 建立tcp通道，同fsockopen
$fp = stream_socket_client('tcp://www.qq.com:80', $errno, $errstr, 30);

// 写入信息
fwrite($fp, "GET / HTTP1.1\r\nHost: www.qq.com\r\n\r\n");

// 添加异步事件
swoole_event_add($fp, function ($fp) {
    $str = '';
    while ($row = fread($fp, 1024)) {
        $str .= $row;
    }
    echo $str;
    swoole_event_del($fp);
    fclose($fp);
});