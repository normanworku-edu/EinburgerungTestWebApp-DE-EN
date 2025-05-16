<?php
require_once 'UserAnswer.php';
require_once __DIR__ . '/../config/database.php';

// Create DB connection
$db = (new Database())->connect();

// Step 1: Insert dummy exam_history row (adjust if needed)
try {
    $db->exec("INSERT IGNORE INTO exam_history (exam_id, user_id) VALUES (1, 1)");
} catch (PDOException $e) {
    echo "❌ Error inserting into exam_history: " . $e->getMessage() . "\n";
    exit;
}

// Step 2: Make sure question with ID 1 exists
try {
    $db->exec("INSERT IGNORE INTO questions (id, text_de, text_en, choice1_de, choice1_en, choice2_de, choice2_en, choice3_de, choice3_en, choice4_de, choice4_en, correct_choice_index)
        VALUES (1, 'Was ist Deutschland?', 'What is Germany?', 'Ein Land', 'A country', 'Ein Tier', 'An animal', 'Ein Auto', 'A car', 'Ein Baum', 'A tree', 1)");
} catch (PDOException $e) {
    echo "❌ Error inserting into questions: " . $e->getMessage() . "\n";
    exit;
}

// Step 3: Test UserAnswer model
$userAnswer = new UserAnswer();

$exam_id = 1;
$question_id = 1;
$selected_choice_index = 2;

echo "💾 Saving user answer...\n";
$success = $userAnswer->save($exam_id, $question_id, $selected_choice_index);

echo $success ? "✅ User answer saved successfully.\n" : "❌ Failed to save user answer.\n";
?>
