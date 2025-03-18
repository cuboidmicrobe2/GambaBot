<?php
namespace gamba;
use PDO;
use PDOException;

class Database {
    private PDO $pdo;
    function __construct(string $dsn, string $username, string $password) {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function checkIfUserExists(string $id) : void {
        // $otherID = $this->mysql->query("SELECT ID FROM wishing_stones WHERE ID = $id")->fetch_assoc();
        // if (!$otherID) {
        //     $this->mysql->query("INSERT INTO wishing_stones(ID, AMOUNT) VALUES($id, 10)");
        //     $this->mysql->query("INSERT INTO coins(ID, AMOUNT) VALUES($id, 1000)");
        //     $this->mysql->query("INSERT INTO pity(ID, Y_INCREASE, Y_PITY, P_PITY, WISH_COUNT) VALUES($id, 0, 0, 1, 1)");
        // }
        try {
            $statement = $this->pdo->prepare("SELECT ID FROM wishing_stones WHERE ID = :id");
            $statement->execute(["id" => $id]); 
            $otherID = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (!$otherID) {
                $statementArray = [
                    $this->pdo->prepare("INSERT INTO wishing_stones(ID, AMOUNT) VALUES(:id, 10)"),
                    $this->pdo->prepare("INSERT INTO coins(ID, AMOUNT) VALUES(:id, 1000)"),
                    $this->pdo->prepare("INSERT INTO pity(ID, Y_INCREASE, Y_PITY, P_PITY, WISH_COUNT) VALUES(:id, 0, 0, 1, 1)")
                ];

                foreach ($statementArray as $stmt) {
                    $stmt->execute(["id" => $id]);
                }
            }
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function getWishCount(string $id) : int {
        // return $this->mysql->query("SELECT WISH_COUNT FROM pity WHERE ID = $id")->fetch_assoc()['WISH_COUNT'];
        try {
            $statement = $this->pdo->prepare("SELECT WISH_COUNT FROM pity WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['WISH_COUNT'];
    }

    protected function getYellowPity(string $id) : int {
        // return $this->mysql->query("SELECT Y_PITY FROM pity WHERE ID = $id")->fetch_assoc()['Y_PITY'];
        try {
            $statement = $this->pdo->prepare("SELECT Y_PITY FROM pity WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['Y_PITY'];
    }

    protected function getPurplePity(string $id) : int {
        // return $this->mysql->query("SELECT P_PITY FROM pity WHERE ID = $id")->fetch_assoc()['P_PITY'];
        try {
            $statement = $this->pdo->prepare("SELECT P_PITY FROM pity WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['P_PITY'];
    }

    protected function getYellowIncrease(string $id) : int {
        // return $this->mysql->query("SELECT Y_INCREASE FROM pity WHERE ID = $id")->fetch_assoc()['Y_INCREASE'];
        try {
            $statement = $this->pdo->prepare("SELECT Y_INCREASE FROM pity WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['Y_INCREASE'];
    }

    protected function incrementWishCount(string $id) : void {
        // $this->mysql->query("UPDATE pity SET WISH_COUNT = WISH_COUNT + 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET WISH_COUNT = WISH_COUNT + 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function incrementYellowPity(string $id) : void {
        // $this->mysql->query("UPDATE pity SET Y_PITY = Y_PITY + 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET Y_PITY = Y_PITY + 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function incrementPurplePity(string $id) : void {
        // $this->mysql->query("UPDATE pity SET P_PITY = P_PITY + 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET P_PITY = P_PITY + 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function incrementYellowIncrease(string $id, float $amount) : void {
        // $this->mysql->query("UPDATE pity SET Y_INCREASE = Y_INCREASE + $amount WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET Y_INCREASE = Y_INCREASE + :amount WHERE ID = :id");
            $statement->execute(["amount" => $amount, "id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function resetYellowPity(string $id) : void {
        // $this->mysql->query("UPDATE pity SET Y_PITY = 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET Y_PITY = 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function resetPurplePity(string $id) : void {
        // $this->mysql->query("UPDATE pity SET P_PITY = 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET P_PITY = 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function resetYellowIncrease(string $id) : void {
        // $this->mysql->query("UPDATE pity SET Y_INCREASE = 0 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE pity SET Y_INCREASE = 0 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }


    protected function getNrOfWishingStones(string $id) : int {
        // return $this->mysql->query("SELECT AMOUNT FROM wishing_stones WHERE ID = $id")->fetch_assoc()['AMOUNT'];
        try {
            $statement = $this->pdo->prepare("SELECT AMOUNT FROM wishing_stones WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['AMOUNT'];
    }

    protected function getNrOfCoins(string $id) : int {
        // return $this->mysql->query("SELECT AMOUNT FROM coins WHERE ID = $id")->fetch_assoc()['AMOUNT'];
        try {
            $statement = $this->pdo->prepare("SELECT AMOUNT FROM coins WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['AMOUNT'];
    }

    protected function addWishingStones(string $id, int $amount) : void {
        // $this->mysql->query("UPDATE wishing_stones SET AMOUNT = AMOUNT + $amount WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE wishing_stones SET AMOUNT = AMOUNT + :amount WHERE ID = :id");
            $statement->execute(["amount" => $amount, "id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function subtractWishingStones(string $id) : void {
        // $this->mysql->query("UPDATE wishing_stones SET AMOUNT = AMOUNT - 1 WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE wishing_stones SET AMOUNT = AMOUNT - 1 WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function addCoins(string $id, int $amount) : void {
        // $this->mysql->query("UPDATE coins SET AMOUNT = AMOUNT + $amount WHERE ID = $id");
        try {
            $statement = $this->pdo->prepare("UPDATE coins SET AMOUNT = AMOUNT + :amount WHERE ID = :id");
            $statement->execute(["amount" => $amount, "id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }
    }

    protected function subtractCoins(string $id, int $amount) : bool {
        // $currentCurrency = $this->mysql->query("SELECT AMOUNT FROM coins WHERE ID = $id")->fetch_assoc()['AMOUNT'];
        // if ($currentCurrency < $amount) {
        //     return false;
        // }

        // $this->mysql->query("UPDATE coins SET AMOUNT = AMOUNT - $amount WHERE ID = $id");
        // return true;
        try {
            $statement = $this->pdo->prepare("SELECT AMOUNT FROM coins WHERE ID = :id");
            $statement->execute(["id" => $id]);

            $currentCurrency = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['AMOUNT'];
            if ($currentCurrency < $amount) {
                return false;
            }

            $statement = $this->pdo->prepare("UPDATE coins SET AMOUNT = AMOUNT - :amount WHERE ID = :id");
            $statement->execute(["amount" => $amount, "id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return true;
    }

    public function getUserInventory(string $id): array {
        // return $this->mysql->query("SELECT * FROM inventory WHERE ID = $id")->fetch_all();
        try {
            $statement = $this->pdo->prepare("SELECT * FROM inventory WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getNrOfStones(string $id): int {
        try {
            $statement = $this->pdo->prepare("SELECT AMOUNT FROM wishing_stones WHERE ID = :id");
            $statement->execute(["id" => $id]);
        }

        catch (PDOException $e) { echo $e->getMessage(); }

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['AMOUNT'];
    }
}

?>