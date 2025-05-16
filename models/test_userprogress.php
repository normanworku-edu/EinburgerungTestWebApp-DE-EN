<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/UserProgress.php'; // Adjust path if needed

$db = (new Database())->connect();

// Ensure user with ID 1 exists
try {
    $db->exec("INSERT IGNORE INTO users (id, username, email, password_hash) VALUES (1, 'testuser', 'test@example.com', 'dummyhash')");
} catch (PDOException $e) {
    echo "❌ Error inserting user: " . $e->getMessage() . "\n";
    exit;
}

// Ensure question with ID 1 exists
try {
    $db->exec("INSERT IGNORE INTO questions (id, text_de, text_en, choice1_de, choice1_en, choice2_de, choice2_en, choice3_de, choice3_en, choice4_de, choice4_en, correct_choice_index)
               VALUES (1, 'Was ist das?', 'What is this?', 'A', 'A', 'B', 'B', 'C', 'C', 'D', 'D', 2)");
} catch (PDOException $e) {
    echo "❌ Error inserting question: " . $e->getMessage() . "\n";
    exit;
}

$user_id = 1;
$question_id = 1;
$is_correct = true; // simulate correct answer

$userProgress = new UserProgress();

// Update progress
echo "💾 Updating progress...\n";
$success = $userProgress->updateProgress($user_id, $question_id, $is_correct);
echo $success ? "✅ Progress updated.\n" : "❌ Failed to update progress.\n";

// Get and print current progress
$progress = $userProgress->getProgress($user_id, $question_id);
echo "📊 Current Progress for question_id = $question_id:\n";
print_r($progress);

// Get and print overall stats
$stats = $userProgress->getUserStats($user_id);
echo "📈 User Stats:\n";
print_r($stats);
?>
