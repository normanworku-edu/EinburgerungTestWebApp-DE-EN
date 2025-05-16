<?php
require_once __DIR__ . '/../models/Question.php';

class ControllerHelper {
    public static $disableExit = true; // true for testing purposes. make false to exit after redirecting in production.

    public static function redirect(string $url) {
        header("Location: $url");
        if (!self::$disableExit) {
            exit;
        } else {
            return;  // If testing mode (disableExit), return immediately to prevent further output.
        }
    }
}

class QuestionController {
    private $questionModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            ControllerHelper::redirect('?controller=auth&action=login');
        }
        $this->questionModel = new Question();
    }

    private function getPostParam(string $key) {
        // Use FILTER_SANITIZE_SPECIAL_CHARS instead of deprecated FILTER_SANITIZE_STRING
        $value = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($value === null || $value === false) {
            $value = isset($_POST[$key]) ? htmlspecialchars($_POST[$key], ENT_QUOTES | ENT_HTML5) : null;
        }
        return $value;
    }

    public function index() {
        $questions = $this->questionModel->getAll();
        require __DIR__ . '/../views/admin/questions.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correctChoice = filter_input(INPUT_POST, 'correct_choice_index', FILTER_VALIDATE_INT);
            if ($correctChoice === false || $correctChoice === null) {
                $correctChoice = isset($_POST['correct_choice_index']) ? intval($_POST['correct_choice_index']) : null;
            }

            $data = [
                'text_de' => $this->getPostParam('text_de'),
                'text_en' => $this->getPostParam('text_en'),
                'choice1_de' => $this->getPostParam('choice1_de'),
                'choice1_en' => $this->getPostParam('choice1_en'),
                'choice2_de' => $this->getPostParam('choice2_de'),
                'choice2_en' => $this->getPostParam('choice2_en'),
                'choice3_de' => $this->getPostParam('choice3_de'),
                'choice3_en' => $this->getPostParam('choice3_en'),
                'choice4_de' => $this->getPostParam('choice4_de'),
                'choice4_en' => $this->getPostParam('choice4_en'),
                'correct_choice_index' => $correctChoice
            ];

            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $upload_dir = 'assets/uploads/';
                $file_name = uniqid() . '-' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $file_name)) {
                    $data['image_path'] = $file_name;
                }
            }

            // Validate required fields
            if (empty($data['text_de'])) {
                $_SESSION['error'] = "Field 'text_de' is required.";
                header('Location: ?controller=admin&action=create');
                if (!empty(ControllerHelper::$disableExit)) return; else exit;
            }
            if ($data['correct_choice_index'] === null) {
                $_SESSION['error'] = "Field 'correct_choice_index' is required and must be an integer.";
                header('Location: ?controller=admin&action=create');
                if (!empty(ControllerHelper::$disableExit)) return; else exit;
            }

            $this->questionModel->create($data);
            ControllerHelper::redirect('?controller=admin&action=questions');
        }

        require __DIR__ . '/../views/admin/edit-question.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $question = $this->questionModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correctChoice = filter_input(INPUT_POST, 'correct_choice_index', FILTER_VALIDATE_INT);
            if ($correctChoice === false || $correctChoice === null) {
                $correctChoice = isset($_POST['correct_choice_index']) ? intval($_POST['correct_choice_index']) : null;
            }

            $data = [
                'id' => $id,
                'text_de' => $this->getPostParam('text_de'),
                'text_en' => $this->getPostParam('text_en'),
                'choice1_de' => $this->getPostParam('choice1_de'),
                'choice1_en' => $this->getPostParam('choice1_en'),
                'choice2_de' => $this->getPostParam('choice2_de'),
                'choice2_en' => $this->getPostParam('choice2_en'),
                'choice3_de' => $this->getPostParam('choice3_de'),
                'choice3_en' => $this->getPostParam('choice3_en'),
                'choice4_de' => $this->getPostParam('choice4_de'),
                'choice4_en' => $this->getPostParam('choice4_en'),
                'correct_choice_index' => $correctChoice
            ];

            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $upload_dir = 'assets/uploads/';
                $file_name = uniqid() . '-' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $file_name)) {
                    $data['image_path'] = $file_name;
                }
            }

            $this->questionModel->update($data);
            ControllerHelper::redirect('?controller=admin&action=questions');
        }

        require __DIR__ . '/../views/admin/edit-question.php';
    }

    public function delete() {
        $id = (int)($_GET['id'] ?? 0);
        $this->questionModel->delete($id);
        ControllerHelper::redirect('?controller=admin&action=questions');
    }
}
?>
