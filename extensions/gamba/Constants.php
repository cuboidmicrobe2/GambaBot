<?php

namespace gamba;

class Constants {
    const YELLOW_PITY_CAP = 80;
    const PURPLE_PITY_CAP = 10;
    const SOFT_PITY = 72;
    const PROB_MAX = 10000;
    const SOFT_PITY_ADDER = 0.10 * self::PROB_MAX;
    const BASE_YELLOW_CHANCE = 0.008 * self::PROB_MAX;
    const BLUE_LOW = 1;
    const BLUE_HIGH = 9200;
    const PURPLE_LOW = 9201;
    const PURPLE_HIGH = 9800;
    const YELLOW_LOW = 9801;
    const YELLOW_HIGH = self::PROB_MAX;
    const ADJUSTED_PURPLE_HIGH = 9800;
    const ADJUSTED_YELLOW_LOW = 9801;

    const NR_OF_YELLOW_CHARACTERS = 6;
    const NR_OF_YELLOW_WEAPONS = 6;
    const NR_OF_PURPLE_CHARACTERS = 10;
    const NR_OF_PURPLE_WEAPONS = 10;

    const YELLOW_CHARACTERS = ["Ozzcarr", "EDWIN", "Padre", "Ludleth", "Sokksverkstad", "Matte B"];
    const YELLOW_WEAPONS = ["Council Hammer", "Gjallarhorn", "Terrablade", "Great Epee", "Uno Reverse Card", "Glaive Prime"];
    
    const PURPLE_CHARACTERS = ["Mariohrst", "Fluffy", "Lello-chan", "Awken", "BiffOlle", "SibbeeeGold", "Albercik", "Anton", "Boggoman", "BombarBengt"];
    const PURPLE_WEAPONS = ["Pulse Rifle", "Gravity Gun", "Saw Cleaver", "Scattergun", "Crowbar", "Keyblade", "Hidden Blade", "Plasma Cutter", "Liberator", "Diamond Hoe"];

    const ALL_ITEMS = [
        'Ozzcarr' => [
            'id' => 1,
            'type' => 'character',
            'rarity' => 5
        ],
        'EDWIN' => [
            'id' => 2,
            'type' => 'character',
            'rarity' => 5
        ],
        'Padre' => [
            'id' => 3,
            'type' => 'character',
            'rarity' => 5
        ],
        'Ludleth' => [
            'id' => 4,
            'type' => 'character',
            'rarity' => 5
        ],
        'Sokksverkstad' => [
            'id' => 5,
            'type' => 'character',
            'rarity' => 5
        ],
        'Matte B' => [
            'id' => 6,
            'type' => 'character',
            'rarity' => 5
        ],
        'Great Epee' => [
            'id' => 7,
            'type' => 'weapon',
            'rarity' => 5
        ]
    ];
}

?>