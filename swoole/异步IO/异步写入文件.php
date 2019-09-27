<?php

// 需写入权限
$filename = 'test.txt';

// 写入内容(限4M)
$content = 'text';

// 回调函数，可选
function back($filename) {
    echo "filename:$filename";
}

// 写入方式，默认覆盖
$flags = FILE_APPEND;   // 追加

// 异步写入内容
swoole_async_writefile($filename, $content, back, $flags);