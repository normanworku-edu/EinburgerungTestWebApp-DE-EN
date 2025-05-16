<?php
session_start();
require_once __DIR__ . '/../controllers/QuestionController.php';

// Mock admin user session
$_SESSION['user_id'] = 1;
$_SESSION['is_admin'] = true;

// Disable exit() in redirects for testing — you need to implement this in your controller base
ControllerHelper::$disableExit = true;

$controller = new QuestionController();

// 1. Test index() - list all questions
echo "Testing index()...\n";
ob_start();
$controller->index();
$output = ob_get_clean();
echo "Output length from index(): " . strlen($output) . "\n\n";

// 2. Test create() GET (show form)
echo "Testing create() GET...\n";
$_SERVER['REQUEST_METHOD'] = 'GET';
ob_start();
$controller->create();
$output = ob_get_clean();
echo "Output length from create() GET: " . strlen($output) . "\n\n";

// 3. Test create() POST (simulate question creation)
echo "Testing create() POST...\n";
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [
    'text_de' => 'Test Frage DE',
    'text_en' => 'Test Question EN',
    'choice1_de' => 'Antwort 1 DE',
    'choice1_en' => 'Answer 1 EN',
    'choice2_de' => 'Antwort 2 DE',
    'choice2_en' => 'Answer 2 EN',
    'choice3_de' => 'Antwort 3 DE',
    'choice3_en' => 'Answer 3 EN',
    'choice4_de' => 'Antwort 4 DE',
    'choice4_en' => 'Answer 4 EN',
    'correct_choice_index' => 2
];
$_FILES = ['image' => ['size' => 0]];

$controller->create();
echo "Create POST simulated (should redirect without exit).\n\n";

// 4. Test edit() GET (load question edit form)
echo "Testing edit() GET...\n";
$_SERVER['REQUEST_METHOD'] = 'GET';
$_GET['id'] = 1; // Ensure this exists in your DB or mock
ob_start();
$controller->edit();
$output = ob_get_clean();
echo "Output length from edit() GET: " . strlen($output) . "\n\n";

// 5. Test edit() POST (update question)
echo "Testing edit() POST...\n";
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [
    'text_de' => 'Updated Frage DE',
    'text_en' => 'Updated Question EN',
    'choice1_de' => 'Updated Antwort 1 DE',
    'choice1_en' => 'Updated Answer 1 EN',
    'choice2_de' => 'Updated Antwort 2 DE',
    'choice2_en' => 'Updated Answer 2 EN',
    'choice3_de' => 'Updated Antwort 3 DE',
    'choice3_en' => 'Updated Answer 3 EN',
    'choice4_de' => 'Updated Antwort 4 DE',
    'choice4_en' => 'Updated Answer 4 EN',
    'correct_choice_index' => 3
];
$_FILES = ['image' => ['size' => 0]];

$controller->edit();
echo "Edit POST simulated (should redirect without exit).\n\n";

// 6. Test delete() (delete question)
echo "Testing delete()...\n";
$_GET['id'] = 1; // Ensure this exists or mock

$controller->delete();
echo "Delete simulated (should redirect without exit).\n\n";
