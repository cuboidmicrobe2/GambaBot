<?php

namespace gamba;
use gamba\Database;

class Shop extends Wish {
    const WISH_PRICE = 100;
    
    function __construct() {
        parent::__construct();
    }

    function buyWishingStone(int $id, int $nrOf) : bool {
        parent::checkIfUserExists($id);
        
        if (parent::getNrOfCoins($id) < self::WISH_PRICE * $nrOf) {
            return false;
        }

        parent::addWishingStones($id, $nrOf);
        parent::subtractCoins($id, self::WISH_PRICE * $nrOf);

        return true;
    }

    function checkWish(int $id, int $nrOf) : bool {
        parent::checkIfUserExists($id);

        if(parent::getNrOfWishingStones($id) < $nrOf) {
            return false;
        }

        return true;
    }

    function buyWish(int $id) {
        parent::gamba($id);
    }
}

?>