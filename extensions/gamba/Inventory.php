<?php

namespace gamba;

class Inventory {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getUserInventory(string $id): array {
        return $this->database->getUserInventory($id);
    }
}