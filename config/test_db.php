<?php
require_once 'Database.php';  // Make sure this path is correct

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "✅ Connected successfully to the database.<br>";

    // Optional: Run a test query
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);

    if ($tables) {
        echo "Tables in the database:<br>";
        foreach ($tables as $table) {
            echo "- " . $table[0] . "<br>";
        }
    } else {
        echo "No tables found in the database.";
    }
} else {
    echo "❌ Failed to connect.";
}
?>
