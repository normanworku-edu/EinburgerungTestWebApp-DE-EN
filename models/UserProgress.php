<?php
require_once __DIR__ . '/../config/database.php';

class UserProgress {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getProgress($user_id, $question_id) {
        $stmt = $this->db->prepare('SELECT * FROM user_progress WHERE user_id = ? AND question_id = ?');
        $stmt->execute([$user_id, $question_id]);
        $progress = $stmt->fetch(PDO::FETCH_ASSOC);
        return $progress ?: ['attempt_count' => 0, 'correct_count' => 0, 'incorrect_count' => 0];
    }

    public function updateProgress($user_id, $question_id, $is_correct) {
        $stmt = $this->db->prepare('
            INSERT INTO user_progress (user_id, question_id, attempt_count, correct_count, incorrect_count)
            VALUES (?, ?, 1, ?, ?)
            ON DUPLICATE KEY UPDATE
                attempt_count = attempt_count + 1,
                correct_count = correct_count + ?,
                incorrect_count = incorrect_count + ?
        ');
        return $stmt->execute([
            $user_id, $question_id,
            $is_correct ? 1 : 0, $is_correct ? 0 : 1,
            $is_correct ? 1 : 0, $is_correct ? 0 : 1
        ]);
    }

    public function getUserStats($user_id) {
        $stmt = $this->db->prepare('
            SELECT
                SUM(correct_count) as correct,
                SUM(incorrect_count) as incorrect,
                (SELECT COUNT(*) FROM questions) - COUNT(*) as unattempted
            FROM user_progress
            WHERE user_id = ?
        ');
        $stmt->execute([$user_id]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stats ?: ['correct' => 0, 'incorrect' => 0, 'unattempted' => $this->getTotalQuestions()];
    }

    private function getTotalQuestions() {
        $stmt = $this->db->query('SELECT COUNT(*) FROM questions');
        return $stmt->fetchColumn();
    }
}
?>