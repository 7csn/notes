<?php

$workers = [];      // 进程池
$worker_num = 2;    // 创建进程数量

// 批量创建进程
for ($i = 0; $i < $worker_num; $i++) {
    $process = new swoole_process('doProcess', false, false); // 创建子进程
    $process->useQueue();   // 开启队列，类似于全局函数
    $pid = $process->start();   // 启动进程，并获取进程ID
    $workers[$pid] = $process;  // 存入进程数组
}

// 创建进程执行函数
function doProcess(swoole_process $process)
{
    $recv = $process->pop();    // 默认8192长度
    echo '从主进程获取到的数据：', $recv , "\n";
    sleep(5);
    $process->exit(0);  // 当前子进程退出
}

// 添加进程事件 向每个子进程添加需要执行的动作
foreach ($workers as $pid => $process) {
    $process->push('子进程' . $pid . "\n");
}

// 等待子进程结束
for ($i = 0; $i < $worker_num; $i++) {
    $ret = swoole_process::wait();
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo '子进程退出' , $pid;
}
