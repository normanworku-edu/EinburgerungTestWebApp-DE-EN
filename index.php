<?php
require_once 'init.php';

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        if ($action === 'login') $authController->login();
        elseif ($action === 'register') $authController->register();
        elseif ($action === 'forgot') $authController->forgotPassword();
        elseif ($action === 'logout') $authController->logout();
        break;
    case 'training':
        $trainingController = new TrainingController();
        $trainingController->index();
        break;
    case 'exam':
        $examController = new ExamController();
        if ($action === 'start') $examController->start();
        elseif ($action === 'submit') $examController->submit();
        else $examController->index();
        break;
    case 'dashboard':
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;
    case 'admin':
        $questionController = new QuestionController();
        if ($action === 'questions') $questionController->index();
        elseif ($action === 'create') $questionController->create();
        elseif ($action === 'edit') $questionController->edit();
        elseif ($action === 'delete') $questionController->delete();
        break;
}
?>