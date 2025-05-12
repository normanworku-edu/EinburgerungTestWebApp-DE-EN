<?php
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict'
]);

require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/TrainingController.php';
require_once 'controllers/ExamController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/QuestionController.php';

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
?>