<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Training Mode - Question <?php echo $current; ?> of <?php echo $total; ?></h5>
            <button id="lang-toggle" class="btn btn-outline-secondary">Switch to English</button>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <span>Correct: <?php echo $progress['correct_count']; ?> ✓</span>
                <span>Incorrect: <?php echo $progress['incorrect_count']; ?> ✕</span>
            </div>
            <div id="question-text" class="mb-3"><?php echo htmlspecialchars($question['text_de']); ?></div>
            <?php if ($question['image_path']): ?>
                <img src="assets/uploads/<?php echo htmlspecialchars($question['image_path']); ?>" class="img-fluid mb-3" alt="Question image">
            <?php endif; ?>
            <form id="answer-form">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice" id="choice<?php echo $i; ?>" value="<?php echo $i; ?>">
                        <label class="form-check-label" for="choice<?php echo $i; ?>" id="choice<?php echo $i; ?>-text">
                            <?php echo htmlspecialchars($question["choice{$i}_de"]); ?>
                        </label>
                    </div>
                <?php endfor; ?>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
            <div id="feedback" class="mt-3"></div>
            <div class="mt-3">
                <a href="?controller=training&current=<?php echo $current - 1; ?>" class="btn btn-secondary <?php if ($current == 1) echo 'disabled'; ?>">Previous</a>
                <a href="?controller=training&current=<?php echo $current + 1; ?>" class="btn btn-secondary <?php if ($current == $total) echo 'disabled'; ?>">Next</a>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/training.js"></script>
<?php require 'views/layouts/footer.php'; ?>