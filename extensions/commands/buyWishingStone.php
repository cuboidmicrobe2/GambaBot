<?php

use Discord\Builders\MessageBuilder;
use Discord\Parts\Interactions\Interaction;
use gamba\Shop;

$shop = new Shop();

$discord->listenCommand("buywishingstone", function(Interaction $interaction) use ($shop) {
    $amount = $interaction->data->options->offsetGet("amount")->value;
    $id = $interaction->member->user->id;
    if ($shop->buyWishingStone($id, $amount)) {
        if ($amount == 1) {
            $interaction->respondWithMessage(MessageBuilder::new()
                ->setContent("You Bought $amount Wishing Stone"), false
            );
        }

        else {
            $interaction->respondWithMessage(MessageBuilder::new()
                ->setContent("You Bought $amount Wishing Stones"), false
            );
        }
    }

    else {
        $interaction->respondWithMessage(MessageBuilder::new()
            ->setContent("Not Enough Coins"), true
        );
    }
});

?>