<?php
require_once 'User.php';  // Adjust path if needed

$user = new User();

// 🔹 Test findByEmail (returns dummy user)
$foundUser = $user->findByEmail('dummy@example.com');

echo "✅ User found:\n";
print_r($foundUser);

// 🔹 Optional: Test create()

$username = 'John Doe';
$email = 'john@example.com';
$passwordHash = password_hash('secret123', PASSWORD_DEFAULT);

$created = $user->create($username, $email, $passwordHash);
if ($created) {
    echo "✅ User created successfully.\n";
} else {
    echo "❌ Failed to create user.\n";
}


// 🔹 Optional: Test createPasswordReset()

$token = bin2hex(random_bytes(16));
$expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

$reset = $user->createPasswordReset($email, $token, $expiresAt);
if ($reset) {
    echo "✅ Password reset token created.\n";
} else {
    echo "❌ Failed to create password reset.\n";
}

?>
