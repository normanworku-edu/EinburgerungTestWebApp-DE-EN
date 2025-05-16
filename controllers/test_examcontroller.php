<?php
// Simple manual test for ExamController without PHPUnit

// Start session
session_start();

// Include your controller and models (adjust paths as needed)
require_once __DIR__ . '/controllers/ExamController.php';
require_once __DIR__ . '/models/Question.php';
require_once __DIR__ . '/models/ExamHistory.php';
require_once __DIR__ . '/models/UserAnswer.php';

// Mock models by extending and overriding methods
class MockQuestion extends Question {
    public function getRandom($count) {
        echo "MockQuestion::getRandom called\n";
        $questions = [];
        for ($i = 1; $i <= $count; $i++) {
            $questions[] = [
                'id' => $i,
                'correct_choice_index' => ($i % 4) + 1,
                'text_de' => "Question DE $i",
                'text_en' => "Question EN $i",
                'choice1_de' => "Choice1 DE",
                'choice1_en' => "Choice1 EN",
                'choice2_de' => "Choice2 DE",
                'choice2_en' => "Choice2 EN",
                'choice3_de' => "Choice3 DE",
                'choice3_en' => "Choice3 EN",
                'choice4_de' => "Choice4 DE",
                'choice4_en' => "Choice4 EN",
            ];
        }
        return $questions;
    }
}

class MockExamHistory extends ExamHistory {
    public function save($userId, $score) {
        echo "MockExamHistory::save called with userId=$userId, score=$score\n";
    }
}

class MockUserAnswer extends UserAnswer {
    public function save($userId, $questionId, $selected) {
        echo "MockUserAnswer::save called with userId=$userId, questionId=$questionId, selected=$selected\n";
    }
}

// Override the ExamController to inject mocks (simplified)
class TestExamController extends ExamController {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = 123; // fake login user
        }
        $this->questionModel = new MockQuestion();
        $this->examModel = new MockExamHistory();
        $this->answerModel = new MockUserAnswer();
    }
}

// Create test instance
$controller = new TestExamController();

echo "=== Test start() ===\n";
$controller->start();
echo "Session exam_questions count: " . count($_SESSION['exam_questions']) . "\n";
echo "Session exam_start_time: " . date('Y-m-d H:i:s', $_SESSION['exam_start_time']) . "\n";
echo "Session exam_answers: ";
var_dump($_SESSION['exam_answers']);

echo "\n=== Test index() ===\n";
// Simulate $_GET param current=2
$_GET['current'] = 2;
// Call index (which includes view, so let's capture output)
ob_start();
$controller->index();
$output = ob_get_clean();
echo "Output length: " . strlen($output) . " chars\n";
// Optionally you can print $output here or check parts of it.

echo "\n=== Test submit() ===\n";
// Prepare answers in session (matching questions)
$_SESSION['exam_answers'] = [];
foreach ($_SESSION['exam_questions'] as $idx => $q) {
    // Select correct choice for each question to get full score
    $_SESSION['exam_answers'][$idx] = $q['correct_choice_index'];
}
ob_start();
$controller->submit();
$output = ob_get_clean();
echo "Submit method output length: " . strlen($output) . " chars\n";

// Verify session cleared
echo "Session exam_questions after submit: ";
var_dump(isset($_SESSION['exam_questions']));

echo "\nTest finished.\n";
