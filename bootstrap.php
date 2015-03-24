<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

$includePaths = array();
$includePaths[] = __DIR__;
$includePaths[] = __DIR__.'/class';
$includePaths[] = __DIR__.'/factory';
$includePaths[] = __DIR__.'/tests';

set_include_path(get_include_path().':'.implode(':',$includePaths));

function classLoader($className) {
    include_once $className.'.php';
}

spl_autoload_register('classLoader');