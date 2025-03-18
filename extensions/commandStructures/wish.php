<?php

use Discord\Discord;
use Discord\Builders\CommandBuilder;
use Discord\Parts\Interactions\Command\Option;
use Discord\Parts\Interactions\Command\Choice;

require_once __DIR__."/vendor/autoload.php";
$token = file_get_contents("./token.txt");

$discord = new Discord([
    "token" => $token
]);

$discord->on("ready", function($discord) {
    $discord->application->commands->save(
        $discord->application->commands->create(CommandBuilder::new()
            ->setName("wish")
            ->setDescription("Spend Wishing Stones for Rewards")
            ->addOption((new Option($discord))
                ->setName("amount")
                ->setDescription("Amount of Wishes")
                ->setType(Option::STRING)
                ->setRequired(true)
                ->addChoice((new Choice($discord))
                    ->setName('Use 1 Wish')
                    ->setValue('1')
                )
                ->addChoice((new Choice($discord))
                    ->setName('Use 5 Wishes')
                    ->setValue('5')
                )
                ->addChoice((new Choice($discord))
                    ->setName('Use 10 Wishes')
                    ->setValue('10')
                )
            )
            ->toArray()
        )
    );
});

?>