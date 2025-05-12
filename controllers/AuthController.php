<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf_token = $_POST['csrf_token'] ?? '';
            if (!$this->verifyCsrfToken($csrf_token)) {
                die('Invalid CSRF token');
            }

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location: ?controller=dashboard');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }

        $csrf_token = $this->generateCsrfToken();
        require 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf_token = $_POST['csrf_token'] ?? '';
            if (!$this->verifyCsrfToken($csrf_token)) {
                die('Invalid CSRF token');
            }

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (strlen($password) < 8) {
                $error = 'Password must be at least 8 characters';
            } elseif ($this->userModel->findByEmail($email)) {
                $error = 'Email already registered';
            } else {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $this->userModel->create($username, $email, $password_hash);
                header('Location: ?controller=auth&action=login');
                exit;
            }
        }

        $csrf_token = $this->generateCsrfToken();
        require 'views/auth/register.php';
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $this->userModel->createPasswordReset($email, $token, $expires_at);
            // Send email with reset link (implementation omitted for brevity)
            $message = 'Password reset link sent to your email';
        }

        require 'views/auth/forgot-password.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ?controller=auth&action=login');
        exit;
    }

    private function generateCsrfToken() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    private function verifyCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>