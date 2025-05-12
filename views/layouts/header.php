<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training & Exam Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="?controller=dashboard">Exam Platform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=training">Training</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=exam&action=start">Exam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=dashboard">Dashboard</a>
                        </li>
                        <?php if ($_SESSION['is_admin']): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=admin&action=questions">Admin</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=auth&action=logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=auth&action=login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=auth&action=register">Register</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <button id="theme-toggle" class="btn btn-outline-secondary">Toggle Theme</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>