<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Forgot Password</div>
                <div class="card-body">
                    <?php if (isset($message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(bin2hex(random_bytes(32))); ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        <a href="?controller=auth&action=login" class="btn btn-link">Back to Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>