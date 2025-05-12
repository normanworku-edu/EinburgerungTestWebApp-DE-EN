<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <h2><?php echo isset($question) ? 'Edit Question' : 'Create Question'; ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(bin2hex(random_bytes(32))); ?>">
        <div class="mb-3">
            <label for="text_de" class="form-label">Question Text (German)</label>
            <textarea class="form-control" id="text_de" name="text_de" required><?php echo isset($question) ? htmlspecialchars($question['text_de']) : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="text_en" class="form-label">Question Text (English)</label>
            <textarea class="form-control" id="text_en" name="text_en" required><?php echo isset($question) ? htmlspecialchars($question['text_en']) : ''; ?></textarea>
        </div>
        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="mb-3">
                <label for="choice<?php echo $i; ?>_de" class="form-label">Choice <?php echo $i; ?> (German)</label>
                <input type="text" class="form-control" id="choice<?php echo $i; ?>_de" name="choice<?php echo $i; ?>_de" value="<?php echo isset($question) ? htmlspecialchars($question["choice{$i}_de"]) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="choice<?php echo $i; ?>_en" class="form-label">Choice <?php echo $i; ?> (English)</label>
                <input type="text" class="form-control" id="choice<?php echo $i; ?>_en" name="choice<?php echo $i; ?>_en" value="<?php echo isset($question) ? htmlspecialchars($question["choice{$i}_en"]) : ''; ?>" required>
            </div>
        <?php endfor; ?>
        <div class="mb-3">
            <label for="correct_choice_index" class="form-label">Correct Choice</label>
            <select class="form-control" id="correct_choice_index" name="correct_choice_index" required>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo isset($question) && $question['correct_choice_index'] == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php if (isset($question) && $question['image_path']): ?>
                <img src="assets/uploads/<?php echo htmlspecialchars($question['image_path']); ?>" class="img-fluid mt-2" style="max-width: 200px;" alt="Current image">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="?controller=admin&action=questions" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php require 'views/layouts/footer.php'; ?>