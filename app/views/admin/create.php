<!DOCTYPE html>
<html>
<head>
    <title>Create Question</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h3>Add New Question</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3"><label>Text DE</label><textarea name="text_de" class="form-control" required></textarea></div>
        <div class="mb-3"><label>Text EN</label><textarea name="text_en" class="form-control" required></textarea></div>
        <div class="row">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-6">
                    <label>Choice <?= $i ?> DE</label>
                    <input type="text" name="choice<?= $i ?>_de" class="form-control" required>
                    <label>Choice <?= $i ?> EN</label>
                    <input type="text" name="choice<?= $i ?>_en" class="form-control" required>
                </div>
            <?php endfor ?>
        </div>
        <div class="mb-3"><label>Correct Choice Index (1-4)</label>
            <input type="number" name="correct_choice_index" class="form-control" min="1" max="4" required>
        </div>
        <div class="mb-3"><label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="/Admin/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
