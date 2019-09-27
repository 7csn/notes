<?php

/**
 * 创建进程
 *
 * $func        创建成功回调
 * $redirect    是否将数据写入管道而不打印到屏幕(默认阻塞读取)，默认false
 * $pipe        是否创建管道，默认true(若开启进程通信，应传false)
 * $redirect2   强制为true，忽略用户参数；若子进程内没有进程间通信，可设置false
 */
// 进程对应执行函数
function doProcess($process) {
    echo 'PID:' , $process->pid;
    sleep(10);
}

// 创建并执行进程1
$process = new swoole_process('doProcess');
$pid = $process->start();
// 创建并执行进程2
$process = new swoole_process('doProcess');
$pid = $process->start();
// 创建并执行进程3
$process = new swoole_process('doProcess');
$pid = $process->start();

// 等待结束
swoole_process::wait();