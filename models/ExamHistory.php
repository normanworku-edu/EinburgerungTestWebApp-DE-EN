<?php
require_once 'config/database.php';

class ExamHistory {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function save($user_id, $score) {
        $stmt = $this->db->prepare('INSERT INTO exam_history (user_id, score) VALUES (?, ?)');
        $stmt->execute([$user_id, $score]);
        return $this->db->lastInsertId();
    }

    public function getUserExams($user_id) {
        $stmt = $this->db->prepare('SELECT * FROM exam_history WHERE user_id = ? ORDER BY timestamp DESC');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>