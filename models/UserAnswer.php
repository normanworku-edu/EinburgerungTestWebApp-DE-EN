<?php
require_once __DIR__ . '/../config/database.php';

class UserAnswer {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function save($exam_id, $question_id, $selected_choice_index) {
        $stmt = $this->db->prepare('
            INSERT INTO user_answers (exam_id, question_id, selected_choice_index)
            VALUES (?, ?, ?)
        ');
        return $stmt->execute([$exam_id, $question_id, $selected_choice_index]);
    }
}
?>