<?php

use Discord\Builders\MessageBuilder;
use Discord\Parts\Interactions\Interaction;

$discord->listenCommand("wishingstoneamount", function(Interaction $interaction) {
    $interaction->acknowledgeWithResponse(false)->then(function() use ($interaction) {
        global $database;
        
        $id = $interaction->member->user->id;
        $amount = $database->getNrOfStones($id);

        $interaction->updateOriginalResponse(MessageBuilder::new()->setContent("You currently have $amount Wishing Stones."));
    });    
});

?>