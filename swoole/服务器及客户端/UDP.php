<?php

// 创建服务器
$serv = new swoole_server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

/**
 * 监听事件
 *
 * $event       事件类型
 *   packet         接收到数据（服务器）
 * $func        回调函数
 *   packet         $serv 服务器 $data 接收到的数据 $fd 客户端信息
 */
$serv->on($event, $func);

/**
 * 发送信息到客户端(常用于packet回调)
 * $address     IP
 * $port        端口
 * $data        发送的信息
 */
$serv->sendto($address, $port, $data);

// 启动服务器
$serv->start();

/**
 * 注意：客户端接收到信息和php显示该信息是两回事，接收不代表要显示出来。
 */