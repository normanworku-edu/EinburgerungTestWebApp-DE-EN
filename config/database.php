<?php
class Database {
    private $host = 'localhost';
    private $port = 3306;
    private $dbname = 'german_citizenship_test_db';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>