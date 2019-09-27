<?php

// 异步读取文件
swoole_async_readfile('abc.txt', function($filename, $content) {
    echo "filename:$filename,content:$content";
});