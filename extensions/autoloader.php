<?php

const PHP_FILENAME_EXTENSION = '.php';

spl_autoload_register(function($name) {
    $file = str_replace('\\', '/', $name) . PHP_FILENAME_EXTENSION;

    try {
        $time = new DateTime(timezone: new DateTimeZone(TIME_ZONE));
        $formatedTime = $time->format('Y-m-d\TH:i:s.uP');
    }
    catch(Exception $e) {
        $formatedTime = $e->getMessage();
    }
    

    if(file_exists(__DIR__.'/'.$file)) {
        echo '[' . $formatedTime . '] GambaBOT.INFO: loaded class: ' . $name . PHP_EOL;
        require_once $file;
    } 
    else {
        $file ??= 'FILENAME_IS_NULL';
        echo '[' . $formatedTime . '] GambaBOT.WARNIG: Could not load class: ' . $name . ' from: ' . $file . PHP_EOL;
    }
});