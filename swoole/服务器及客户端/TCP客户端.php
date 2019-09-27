<?php

/**
 * 创建客户端
 */
$client = new swoole_client();

/**
 * 客户端连接
 * $host    客户端IP
 * $port    客户端端口
 * $time    连接时间限制(ms)
 */
$client->connect($host, $port, $time) or die('连接失败');

/**
 * 发送数据到服务器
 * $data    发送的信息
 */
$client->send($data) or die('发送失败');

/**
 * 从服务器接收数据
 */
$data = $client->recv();

if ($data) {
    echo $data;
} else {
    die('接收失败');
}

/**
 * 关闭连接
 */
$client->close();