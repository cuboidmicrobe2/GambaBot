<?php

namespace gamba;

use gamba\Constants;

class Wish extends Database {
    function __construct() {
        parent::__construct('mysql:host=localhost;dbname=gamba', 'root', '');
    }

    public function getWishCount($id) : int {
        return parent::getWishCount($id);
    }

    private function yellow(int $id) : string {
        $type = rand(1, 2);
        if ($type == 1) {
            $result = Constants::YELLOW_CHARACTERS[array_rand(Constants::YELLOW_CHARACTERS)];
        } else {
            $result = Constants::YELLOW_WEAPONS[array_rand(Constants::YELLOW_WEAPONS)];
        }

        parent::resetYellowPity($id);
        parent::incrementPurplePity($id);
        parent::resetYellowIncrease($id);

        return $result." (★★★★★)";
    }

    private function purple(int $id) : string {
        $type = rand(1, 2);
        if ($type == 1) {
            $result = Constants::PURPLE_CHARACTERS[array_rand(Constants::PURPLE_CHARACTERS)];
        } else {
            $result = Constants::PURPLE_WEAPONS[array_rand(Constants::PURPLE_WEAPONS)];
        }

        parent::incrementYellowPity($id);
        parent::resetPurplePity($id);

        return $result." (★★★★)";
    }

    private function blue(int $id) : string {
        parent::incrementYellowPity($id);
        parent::incrementPurplePity($id);

        return ":(";
    }

    public function gamba(int $id) : ?string {
        parent::checkIfUserExists($id);

        parent::subtractWishingStones($id);
        parent::incrementWishCount($id);
        if (parent::getPurplePity($id) >= Constants::PURPLE_PITY_CAP) {
            return $this->purple($id);
        } else if (parent::getYellowPity($id) > Constants::YELLOW_PITY_CAP) {
            return $this->yellow($id);
        } else {
            $a = rand(1, Constants::PROB_MAX);

            if (parent::getYellowPity($id) > Constants::SOFT_PITY) {
                $adjustedYellowChance = Constants::BASE_YELLOW_CHANCE + parent::getYellowIncrease($id);

                if ($a >= Constants::BLUE_LOW && $a <= (Constants::PROB_MAX - $adjustedYellowChance)) {
                    return $this->blue($id);
                } elseif ($a > (Constants::PROB_MAX - $adjustedYellowChance) && $a <= Constants::ADJUSTED_PURPLE_HIGH) {
                    return $this->purple($id);
                } elseif ($a > Constants::ADJUSTED_YELLOW_LOW && $a <= Constants::PROB_MAX) {
                    return $this->yellow($id);
                }

                parent::incrementYellowIncrease($id, Constants::SOFT_PITY_ADDER);
            } else {
                if ($a >= Constants::BLUE_LOW && $a <= Constants::BLUE_HIGH) {
                    return $this->blue($id);
                } elseif ($a >= Constants::PURPLE_LOW && $a <= Constants::PURPLE_HIGH) {
                    return $this->purple($id);
                } elseif ($a >= Constants::YELLOW_LOW && $a <= Constants::YELLOW_HIGH) {
                    return $this->yellow($id);
                }
            }
        }

        return NULL;
    }
}