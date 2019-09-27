<?php

// 创建服务器
$serv = new swoole_http_server('0.0.0.0', 9501);

/**
 * 监听事件
 *
 * $event       事件类型
 *   request        服务器获取请求
 * $func        回调函数
 *   request        $request 请求信息 $response 返回信息
 * 例：
 * $serv->on('request', function($request, $response) {
 *      var_dump($request);
 *      $response->header('Content-Type', 'text/html;charset=utf-8');   // 设置返回头信息
 *      $response->end('hello world!');     // 发送信息
 * }
 */
$serv->on($event, $func);

// 启动服务器
$serv->start();