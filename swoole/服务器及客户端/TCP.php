<?php
/**
 * swoole服务由php开启
 * 用网络调试助手进行测试
 * ps -ajft 查看端口
 */

/**
 * 创建服务器
 *
 * $host        IP:string
 *                  127.0.0.1   本机
 *                  0.0.0.0     本机所有IP(可用于同端口多服务器)
 * $port        端口(1024以内需root权限，通常从9501开始):int
 * $mode        方式(默认SWOOLE_PROCESS多进程)
 * $socke_type  服务(默认SWOOLE_SOCK_TCP)
 */
$serv = new swoole_server($host, $port, $mode, $socke_type);

/**
 * 多端口服务器添加
 */
$serv->addlistener($host, $port, $sock_type);

/**
 * 监听事件
 *
 * $event       事件类型
 *   connect        连接
 *   receive        服务器接收到数据(服务器)
 *   close          关闭连接
 * $func        回调函数
 *   connect        $serv 服务器 $fd 客户端信息
 *   receive        $serv 服务器 $fd 客户端信息 $from_id 客户端ID $data 传递的数据
 *   close          $serv 服务器 $fd 客户端信息
 */
$serv->on($event, $func);

/**
 * 启动服务器
 */
$serv->start();