<?php

use Discord\Discord;

require_once __DIR__."/vendor/autoload.php";
$token = file_get_contents("./token.txt");

$discord = new Discord([
    "token" => $token
]);

$discord->on("ready", function($discord) {
    $discord->application->commands->delete('1250767337729167402'); // Command ID
})

?>