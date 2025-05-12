<?php
require_once 'config/database.php';

class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password_hash) {
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $email, $password_hash]);
    }

    public function createPasswordReset($email, $token, $expires_at) {
        $stmt = $this->db->prepare('INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE token = ?, expires_at = ?');
        return $stmt->execute([$email, $token, $expires_at, $token, $expires_at]);
    }
}
?>