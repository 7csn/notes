<?php

// 实例化资源
$db = swoole_mysql();

$config = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => 'root',
    'database' => 'mysql',
    'charset' => 'utf8'
];

// 连接数据库
$db->connect($config, function ($db, $res) {
    if ($res === false) {
        die('连接失败！错误行号：' . $db->connect_errno . '.错误信息：' . $db->connect_error);
    } else {
        $sql = 'show tables';
        $db->query($sql, function(swoole_mysql $db, $res) {
            if ($res === false) {
                die ('操作失败：' . $db->error);
            } elseif ($res === true) {
                var_dump($db->affected_rows, $db->insert_id);
            }
            var_dump($res);
            $db->close();
        });
    }
});