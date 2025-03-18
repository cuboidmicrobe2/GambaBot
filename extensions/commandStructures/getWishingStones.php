<?php

use Discord\Discord;
use Discord\Builders\CommandBuilder;

require_once __DIR__."/vendor/autoload.php";
$token = file_get_contents("./token.txt");

$discord = new Discord([
    "token" => $token
]);

$discord->on("ready", function($discord) {
    $discord->application->commands->save(
        $discord->application->commands->create(CommandBuilder::new()
            ->setName("wishingstoneamount")
            ->setDescription("Displays the amount of Wishing Stones in thy puny satchel")
            ->toArray()
        )
    );
})

?>