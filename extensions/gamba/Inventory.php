<?php

namespace gamba;

class Inventory {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getUserInventory(int $id): array {
        return $this->database->getUserInventory($id);
    }
}