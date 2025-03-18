<?php

use Discord\Discord;
use Discord\Builders\CommandBuilder;
use Discord\Parts\Interactions\Command\Option;

require_once __DIR__."/vendor/autoload.php";
$token = file_get_contents("./token.txt");

$discord = new Discord([
    "token" => $token
]);

$discord->on("ready", function($discord) {
    $discord->application->commands->save(
        $discord->application->commands->create(CommandBuilder::new()
            ->setName("buywishingstone")
            ->setDescription("Buy Wishing Stones for 100 Coins Each")
            ->addOption((new Option($discord))
                ->setName("amount")
                ->setDescription("Amount of Wishing Stones to Buy")
                ->setType(Option::INTEGER)
                ->setRequired(true)
                ->setMinValue(1)
            )
            ->toArray()
        )
    );
})

?>