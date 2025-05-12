import os

# Define the folder structure
structure = [
    'core/',
    'core/assets/',
    'core/assets/css/',
    'core/assets/css/styles.css',
    'core/assets/js/',
    'core/assets/js/training.js',
    'core/assets/js/exam.js',
    'core/assets/js/dashboard.js',
    'core/assets/js/admin.js',
    'core/assets/js/theme.js',
    'core/assets/images/',
    'core/assets/uploads/',
    'core/config/',
    'core/config/database.php',
    'core/controllers/',
    'core/controllers/AuthController.php',
    'core/controllers/QuestionController.php',
    'core/controllers/TrainingController.php',
    'core/controllers/ExamController.php',
    'core/controllers/DashboardController.php',
    'core/models/',
    'core/models/User.php',
    'core/models/Question.php',
    'core/models/UserProgress.php',
    'core/models/ExamHistory.php',
    'core/models/UserAnswer.php',
    'core/views/',
    'core/views/auth/',
    'core/views/auth/login.php',
    'core/views/auth/register.php',
    'core/views/auth/forgot-password.php',
    'core/views/training/',
    'core/views/training/index.php',
    'core/views/exam/',
    'core/views/exam/index.php',
    'core/views/dashboard/',
    'core/views/dashboard/index.php',
    'core/views/admin/',
    'core/views/admin/questions.php',
    'core/views/admin/edit-question.php',
    'core/views/layouts/',
    'core/views/layouts/header.php',
    'core/views/layouts/footer.php',
    'core/.htaccess',
    'core/index.php',
    'core/init.php',
    'core/sql/',
    'core/sql/schema.sql'
]

for path in structure:
    if path.endswith('/'):
        os.makedirs(path, exist_ok=True)
    else:
        os.makedirs(os.path.dirname(path), exist_ok=True)
        with open(path, 'w') as f:
            pass  # create an empty file
