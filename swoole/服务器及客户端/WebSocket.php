<?php

// 创建服务器
$serv = new swoole_websocket_server('0.0.0.0', 9501);

/**
 * 监听事件
 *
 * $event       事件类型
 *   open           建立连接
 *   message        接收信息
 *   close          关闭连接
 * $func        回调函数
 *   open           $ws 服务器 $request 客户端信息
 *   message        $ws 服务器 $request 客户端信息
 *   close          $ws 服务器 $request 客户端信息
 */
$serv->on($event, $func);

/**
 * 发送信息到客户端(常用于message回调)
 *
 * $fd      客户端ID
 * $data    发送的信息
 */
$serv->push($fd, $data);

// 启动服务器
$serv->start();