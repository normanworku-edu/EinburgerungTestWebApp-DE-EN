<?php
require_once 'models/Question.php';
require_once 'models/UserProgress.php';

class TrainingController {
    private $questionModel;
    private $progressModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $this->questionModel = new Question();
        $this->progressModel = new UserProgress();
    }

    public function index() {
        $current = isset($_GET['current']) ? (int)$_GET['current'] : 1;
        $questions = $this->questionModel->getAll();
        $total = count($questions);
        if ($current < 1 || $current > $total) $current = 1;

        $question = $questions[$current - 1];
        $progress = $this->progressModel->getProgress($_SESSION['user_id'], $question['id']);
        require 'views/training/index.php';
    }
}
?>