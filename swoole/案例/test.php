<?php

// 创建websocket服务器
$ws = new swoole_websocket_server('0.0.0.0', 9501);

// 监听事件
$ws->on('open', function ($ws, $request) {
    echo "新用户{$request->fd}加入。\n";
    $GLOBALS['fd'][$request->fd] = [
        'id' => $request->fd,
        'name' => '用户名' . $request->fd
    ];
});
$ws->on('message', function ($ws, $request) {
    if (strstr($request->data, "#name#")) { // 用户设置昵称
        $GLOBALS['fd'][$request->fd]['name'] = str_replace('#name', '', $request->data);
    } else {    // 信息发送
        $msg = $GLOBALS['fd'][$request->fd]['name'] . ":" . $request->data . "\n";
        // 发送到每个客户端
        foreach ($GLOBALS['fd'] as $v) {
            $ws->push($v['id'], $msg);
        }
    }
});
$ws->on('close', function ($ws, $request) {
    echo "客户端-{$request} 断开连接\n";
    unsert($GLOBALS['fd'][$request]);
});

// 启动服务器
$ws->start();