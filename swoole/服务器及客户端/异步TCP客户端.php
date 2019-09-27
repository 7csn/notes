<?php

// 创建客户端
$client = new swoole_client(SWOOLE_SOCK_ASYNC);

// 注册连接成功回调
$client->on('connect', function ($client) {
    $client->send('跟服务器打招呼');
});

// 注册接收数据回调
$client->on('receive', function ($client, $data) {
    echo '服务器接收到信息：', $data;
});

// 注册连接失败回调
$client->on('error', function ($client) {
    echo '连接失败';
});

// 注册连接失败回调
$client->on('close', function ($client) {
    echo '关闭连接';
});

// 发起连接
$client->connect($host, $port, $time);