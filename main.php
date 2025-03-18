<?php

define("SILENT_MESSAGE", 4096);

use Discord\Discord;
use Discord\WebSockets\Intents;

const TIME_ZONE = 'Europe/Stockholm';

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/extensions/autoloader.php';


$commandNames = [
    "buyWishingStone",
    "wish"
];

$token = file_get_contents('token.txt');

$discord = new Discord([
    'token' => $token,
    'loadAllMembers' => true,
    'intents' => 
        Intents::getDefaultIntents() | 
        Intents::GUILD_MEMBERS
]);

$discord->on('init', function ($discord) use ($commandNames) {
    foreach($commandNames as $commandName) {
        require_once "extensions/commands/".$commandName.".php";
    }

    echo "Bot is online.", PHP_EOL;
});


$discord->run();

?>