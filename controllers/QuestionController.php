<?php
require_once 'models/Question.php';

class QuestionController {
    private $questionModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $this->questionModel = new Question();
    }

    public function index() {
        $questions = $this->questionModel->getAll();
        require 'views/admin/questions.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'text_de' => filter_input(INPUT_POST, 'text_de', FILTER_SANITIZE_STRING),
                'text_en' => filter_input(INPUT_POST, 'text_en', FILTER_SANITIZE_STRING),
                'choice1_de' => filter_input(INPUT_POST, 'choice1_de', FILTER_SANITIZE_STRING),
                'choice1_en' => filter_input(INPUT_POST, 'choice1_en', FILTER_SANITIZE_STRING),
                'choice2_de' => filter_input(INPUT_POST, 'choice2_de', FILTER_SANITIZE_STRING),
                'choice2_en' => filter_input(INPUT_POST, 'choice2_en', FILTER_SANITIZE_STRING),
                'choice3_de' => filter_input(INPUT_POST, 'choice3_de', FILTER_SANITIZE_STRING),
                'choice3_en' => filter_input(INPUT_POST, 'choice3_en', FILTER_SANITIZE_STRING),
                'choice4_de' => filter_input(INPUT_POST, 'choice4_de', FILTER_SANITIZE_STRING),
                'choice4_en' => filter_input(INPUT_POST, 'choice4_en', FILTER_SANITIZE_STRING),
                'correct_choice_index' => (int)$_POST['correct_choice_index']
            ];

            if ($_FILES['image']['size'] > 0) {
                $upload_dir = 'assets/uploads/';
                $file_name = uniqid() . '-' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $file_name)) {
                    $data['image_path'] = $file_name;
                }
            }

            $this->questionModel->create($data);
            header('Location: ?controller=admin&action=questions');
            exit;
        }

        require 'views/admin/edit-question.php';
    }

    public function edit() {
        $id = (int)$_GET['id'];
        $question = $this->questionModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'text_de' => filter_input(INPUT_POST, 'text_de', FILTER_SANITIZE_STRING),
                'text_en' => filter_input(INPUT_POST, 'text_en', FILTER_SANITIZE_STRING),
                'choice1_de' => filter_input(INPUT_POST, 'choice1_de', FILTER_SANITIZE_STRING),
                'choice1_en' => filter_input(INPUT_POST, 'choice1_en', FILTER_SANITIZE_STRING),
                'choice2_de' => filter_input(INPUT_POST, 'choice2_de', FILTER_SANITIZE_STRING),
                'choice2_en' => filter_input(INPUT_POST, 'choice2_en', FILTER_SANITIZE_STRING),
                'choice3_de' => filter_input(INPUT_POST, 'choice3_de', FILTER_SANITIZE_STRING),
                'choice3_en' => filter_input(INPUT_POST, 'choice3_en', FILTER_SANITIZE_STRING),
                'choice4_de' => filter_input(INPUT_POST, 'choice4_de', FILTER_SANITIZE_STRING),
                'choice4_en' => filter_input(INPUT_POST, 'choice4_en', FILTER_SANITIZE_STRING),
                'correct_choice_index' => (int)$_POST['correct_choice_index']
            ];

            if ($_FILES['image']['size'] > 0) {
                $upload_dir = 'assets/uploads/';
                $file_name = uniqid() . '-' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $file_name)) {
                    $data['image_path'] = $file_name;
                }
            }

            $this->questionModel->update($data);
            header('Location: ?controller=admin&action=questions');
            exit;
        }

        require 'views/admin/edit-question.php';
    }

    public function delete() {
        $id = (int)$_GET['id'];
        $this->questionModel->delete($id);
        header('Location: ?controller=admin&action=questions');
        exit;
    }
}
?>