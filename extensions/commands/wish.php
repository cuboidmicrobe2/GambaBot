<?php

use Discord\Builders\MessageBuilder;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Interactions\Interaction;
use gamba\Wish;

$wish = new Wish();

$discord->listenCommand("wish", function(Interaction $interaction) use ($discord, $wish, $shop) {
    $reward = "";
    $id = $interaction->member->user->id;
    $nrOf = $interaction["data"]["options"]->offsetGet("amount")->value;
    if($shop->checkWish($id, $nrOf)) {
        for($i = 0; $i < $nrOf; $i++) {
            if (!$item = $wish->gamba($id)) {
                continue;
            }
            
            $reward .= $item.PHP_EOL;
        }
        
        $interaction->respondWithMessage(MessageBuilder::new()
            ->addEmbed((new Embed($discord))
                ->setTitle("You Got the Following Rewards")
                ->setDescription($reward)
            )
        );
    }

    else {
        $interaction->respondWithMessage(MessageBuilder::new()
            ->setContent("Not Enough Wishing Stones"), true
        );
    }
});

?>