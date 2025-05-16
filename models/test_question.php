<?php
require_once 'Question.php';  // Adjust path if needed

$question = new Question();

// 🔹 Test 1: Get all questions
echo "🔍 All Questions:\n";
$all = $question->getAll();
print_r($all);

// 🔹 Test 2: Insert a new question
$newData = [
    'text_de' => 'Was ist die Hauptstadt von Deutschland?',
    'text_en' => 'What is the capital of Germany?',
    'image_path' => null,
    'choice1_de' => 'Berlin',
    'choice1_en' => 'Berlin',
    'choice2_de' => 'München',
    'choice2_en' => 'Munich',
    'choice3_de' => 'Frankfurt',
    'choice3_en' => 'Frankfurt',
    'choice4_de' => 'Hamburg',
    'choice4_en' => 'Hamburg',
    'correct_choice_index' => 1
];

echo "\n➕ Creating new question...\n";
$createSuccess = $question->create($newData);
echo $createSuccess ? "✅ Question created.\n" : "❌ Failed to create question.\n";

// 🔹 Test 3: Get a random question
echo "\n🎲 Random Question:\n";
$random = $question->getRandom(1);
print_r($random);

$questionId = $random[0]['id'] ?? null;

if ($questionId) {
    // 🔹 Test 4: Update the question
    $random[0]['text_en'] = 'Updated: What is the capital of Germany?';
    $random[0]['text_de'] = 'Aktualisiert: Was ist die Hauptstadt von Deutschland?';
    echo "\n✏️ Updating question ID $questionId...\n";
    $updateSuccess = $question->update($random[0]);
    echo $updateSuccess ? "✅ Question updated.\n" : "❌ Failed to update.\n";

    // 🔹 Test 5: Delete the question
    echo "\n🗑️ Deleting question ID $questionId...\n";
    $deleteSuccess = $question->delete($questionId);
    echo $deleteSuccess ? "✅ Question deleted.\n" : "❌ Failed to delete.\n";
} else {
    echo "⚠️ No question found to update/delete.\n";
}
?>
