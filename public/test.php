<?php

$start = microtime(true);

for ($i = 0; $i <= 1000; $i++){
    $bool = is_file(__DIR__ . '/helper.js');
    echo var_dump($bool) . '<br>';
}

$finish = microtime(true) - $start;

echo $finish;