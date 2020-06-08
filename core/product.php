<?php
    class Product {
        private $conn;
        private $table = 'products';

        public $id;
        public $name;
        public $price;
        public $category;
        public $created_date;
        public $updated_date;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'SELECT
                id,
                name,
                price,
                category,
                created_date,
                updated_date
                FROM '.$this->table;

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT
                id,
                name,
                price,
                category,
                created_date,
                updated_date
                FROM '.$this->table .' WHERE id = ? LIMIT 1';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->category = $row['category'];
            $this->created_date = $row['created_date'];
            $this->updated_date = $row['updated_date'];

        }

        public function create() {
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $query = "INSERT INTO ".$this->table." (name, price, category, created_date, updated_date)
                                    VALUES ('".$this->name."', '".$this->price."', '".$this->category."', '".$this->created_date."', '".$this->created_date."') ";
            $stmt = $this->conn->prepare($query);


            if ($stmt->execute()) {
                return true;
            } else {
                printf("Error %s", $stmt->error);
                return false;
            }
        }

        public function update() {
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $query = "UPDATE ".$this->table." SET name='".$this->name."', price='".$this->price."', category='".$this->category."',
                                                updated_date='".$this->updated_date."' WHERE id=".$this->id." ";
            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                return true;
            } else {
                printf("Error %s", $stmt->error);
                return false;
            }

        }

        public function delete() {
            $query = "DELETE FROM ".$this->table." WHERE id=".$this->id." ";
            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                return true;
            } else {
                printf("Error %s", $stmt->error);
                return false;
            }
        }

        public function exists() {
            $query = "SELECT * FROM ".$this->table." WHERE id=".$this->id." ";
            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (! $row) {
                    return false;
                }
                return true;
            } else {
                printf("Error %s", $stmt->error);
                return false;
            }
        }
    }

?>