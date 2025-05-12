<?php
require_once 'models/UserProgress.php';
require_once 'models/ExamHistory.php';

class DashboardController {
    private $progressModel;
    private $examModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $this->progressModel = new UserProgress();
        $this->examModel = new ExamHistory();
    }

    public function index() {
        $progress = $this->progressModel->getUserStats($_SESSION['user_id']);
        $exams = $this->examModel->getUserExams($_SESSION['user_id']);
        require 'views/dashboard/index.php';
    }
}
?>