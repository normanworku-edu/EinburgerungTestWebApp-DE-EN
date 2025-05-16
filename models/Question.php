<?php
require_once __DIR__ . '/../config/database.php';

class Question {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM questions ORDER BY id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandom($count) {
        $stmt = $this->db->query("SELECT * FROM questions ORDER BY RAND() LIMIT $count");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare('
            INSERT INTO questions (
                text_de, text_en, image_path,
                choice1_de, choice1_en, choice2_de, choice2_en,
                choice3_de, choice3_en, choice4_de, choice4_en,
                correct_choice_index
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        return $stmt->execute([
            $data['text_de'], $data['text_en'], $data['image_path'] ?? null,
            $data['choice1_de'], $data['choice1_en'],
            $data['choice2_de'], $data['choice2_en'],
            $data['choice3_de'], $data['choice3_en'],
            $data['choice4_de'], $data['choice4_en'],
            $data['correct_choice_index']
        ]);
    }

    public function update($data) {
        $stmt = $this->db->prepare('
            UPDATE questions SET
                text_de = ?, text_en = ?, image_path = ?,
                choice1_de = ?, choice1_en = ?, choice2_de = ?, choice2_en = ?,
                choice3_de = ?, choice3_en = ?, choice4_de = ?, choice4_en = ?,
                correct_choice_index = ?
            WHERE id = ?
        ');
        return $stmt->execute([
            $data['text_de'], $data['text_en'], $data['image_path'] ?? null,
            $data['choice1_de'], $data['choice1_en'],
            $data['choice2_de'], $data['choice2_en'],
            $data['choice3_de'], $data['choice3_en'],
            $data['choice4_de'], $data['choice4_en'],
            $data['correct_choice_index'],
            $data['id']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM questions WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>