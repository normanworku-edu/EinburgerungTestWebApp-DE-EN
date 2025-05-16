<?php
class DatabaseImporter {
    private $host = 'localhost';
    private $port = 3306;
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'german_citizenship_test_db';
    private $mysqlPath = 'C:\\Program Files\\MySQL\\MySQL Workbench 8.0\\mysql.exe';// <-- UPDATE this path if needed

    public function import($sqlFile) {
        // Step 1: Create the database if it doesn't exist
        try {
            $pdo = new PDO(
                "mysql:host=$this->host;port=$this->port;charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$this->dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
            echo "✅ Database '$this->dbname' is ready.\n";
        } catch (PDOException $e) {
            die("❌ Error creating database: " . $e->getMessage());
        }

        // Step 2: Import the SQL dump
        if (!file_exists($sqlFile)) {
            die("❌ SQL file '$sqlFile' not found.");
        }

        $command = "\"{$this->mysqlPath}\" -h {$this->host} -P {$this->port} -u {$this->username} -p{$this->password} {$this->dbname} < \"$sqlFile\"";

        $result = null;
        system($command, $result);

        if ($result === 0) {
            echo "✅ Database imported successfully from '$sqlFile'.\n";
        } else {
            echo "❌ Error importing database. Return code: $result\n";
        }
    }
}

// Usage
$importer = new DatabaseImporter();
$importer->import(__DIR__ . '/backup_20250516_143105.sql'); // Replace with your actual filename
