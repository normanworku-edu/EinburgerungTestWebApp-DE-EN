<?php
require_once __DIR__ . '/ExamHistory.php'; // Adjust if needed
require_once __DIR__ . '/../config/database.php';

$db = (new Database())->connect();

// Ensure test user exists
try {
    $db->exec("INSERT IGNORE INTO users (id, username, email, password_hash)
               VALUES (1, 'testuser', 'test@example.com', 'hash')");
} catch (PDOException $e) {
    echo "❌ Error creating test user: " . $e->getMessage() . "\n";
    exit;
}

// Create ExamHistory instance
$examHistory = new ExamHistory();

// Save a new exam record
echo "📝 Saving exam record...\n";
$exam_id = $examHistory->save(1, 85); // user_id = 1, score = 85

echo $exam_id ? "✅ Exam record saved with ID: $exam_id\n" : "❌ Failed to save exam record.\n";

// Get all exams for user
echo "📚 Fetching exams for user_id = 1...\n";
$exams = $examHistory->getUserExams(1);
print_r($exams);
?>
