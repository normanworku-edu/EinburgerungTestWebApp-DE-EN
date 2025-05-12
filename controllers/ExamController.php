<?php
require_once 'models/Question.php';
require_once 'models/ExamHistory.php';
require_once 'models/UserAnswer.php';

class ExamController {
    private $questionModel;
    private $examModel;
    private $answerModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $this->questionModel = new Question();
        $this->examModel = new ExamHistory();
        $this->answerModel = new UserAnswer();
    }

    public function start() {
        $questions = $this->questionModel->getRandom(30);
        $_SESSION['exam_questions'] = $questions;
        $_SESSION['exam_start_time'] = time();
        $_SESSION['exam_answers'] = [];
        header('Location: ?controller=exam');
        exit;
    }

    public function index() {
        if (!isset($_SESSION['exam_questions'])) {
            header('Location: ?controller=exam&action=start');
            exit;
        }

        $current = isset($_GET['current']) ? (int)$_GET['current'] : 1;
        $questions = $_SESSION['exam_questions'];
        $total = count($questions);
        if ($current < 1 || $current > $total) $current = 1;

        $question = $questions[$current - 1];
        $answered = count(array_filter($_SESSION['exam_answers'], fn($a) => $a !== null));
        require 'views/exam/index.php';
    }

    public function submit() {
        $questions = $_SESSION['exam_questions'];
        $answers = $_SESSION['exam_answers'];
        $score = 0;

        foreach ($questions as $index => $question) {
            $selected = $answers[$index] ?? null;
            if ($selected && $selected == $question['correct_choice_index']) {
                $score++;
            }
            $this->answerModel->save($_SESSION['user_id'], $question['id'], $selected);
        }

        $this->examModel->save($_SESSION['user_id'], $score);
        unset($_SESSION['exam_questions'], $_SESSION['exam_start_time'], $_SESSION['exam_answers']);
        require 'views/exam/results.php';
    }
}
?>