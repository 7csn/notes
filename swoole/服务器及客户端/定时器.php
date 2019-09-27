<?php

/**
 * 循环执行 定时器
 * $time    循环间隔
 * $func    回调函数
 *     $id      定时器ID
 */
swoole_timeer_tick($time, $func);

/**
 * 单次执行 定时器
 * $time    等待时间
 * $func    回调函数
 */
swoole_timeer_after($time, $func);