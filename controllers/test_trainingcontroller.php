<?php
session_start();

// Simulate a logged-in user
$_SESSION['user_id'] = 1;

require_once __DIR__ . '/TrainingController.php';

// Create test user if not already there
require_once __DIR__ . '/../config/database.php';
$db = (new Database())->connect();
$db->exec("INSERT IGNORE INTO users (id, username, email, password_hash)
           VALUES (1, 'Test User', 'test@example.com', 'testhash')");

// Create a dummy question if the table is empty
$questionCount = $db->query("SELECT COUNT(*) FROM questions")->fetchColumn();
if ($questionCount == 0) {
    $db->exec("INSERT INTO questions (
        text_de, text_en,
        choice1_de, choice1_en, choice2_de, choice2_en,
        choice3_de, choice3_en, choice4_de, choice4_en,
        correct_choice_index
    ) VALUES (
        'Frage auf Deutsch?', 'Question in English?',
        'Antwort 1 DE', 'Answer 1 EN',
        'Antwort 2 DE', 'Answer 2 EN',
        'Antwort 3 DE', 'Answer 3 EN',
        'Antwort 4 DE', 'Answer 4 EN',
        1
    )");
}

echo "🧪 Starting TrainingController test...\n";

$controller = new TrainingController();

// Simulate accessing the first question (normally this calls a view)
ob_start();
$controller->index();
$output = ob_get_clean();

echo "✅ TrainingController::index() ran successfully.\n";

// Optional: Output HTML contents of view if needed
echo $output;
