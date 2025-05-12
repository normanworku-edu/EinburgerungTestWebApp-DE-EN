<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Exam Mode - Question <?php echo $current; ?> of <?php echo $total; ?></h5>
            <div>
                <span id="timer">30:00</span> |
                <span>Answered: <?php echo $answered; ?>/30</span> |
                <button id="pause-btn" class="btn btn-outline-secondary">Pause</button>
            </div>
        </div>
        <div class="card-body">
            <div id="question-text" class="mb-3"><?php echo htmlspecialchars($question['text_de']); ?></div>
            <?php if ($question['image_path']): ?>
                <img src="assets/uploads/<?php echo htmlspecialchars($question['image_path']); ?>" class="img-fluid mb-3" alt="Question image">
            <?php endif; ?>
            <form id="answer-form">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice" id="choice<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if (isset($_SESSION['exam_answers'][$current - 1]) && $_SESSION['exam_answers'][$current - 1] == $i) echo 'checked'; ?>>
                        <label class="form-check-label" for="choice<?php echo $i; ?>">
                            <?php echo htmlspecialchars($question["choice{$i}_de"]); ?>
                        </label>
                    </div>
                <?php endfor; ?>
            </form>
            <div class="mt-3">
                <a href="?controller=exam&current=<?php echo $current - 1; ?>" class="btn btn-secondary <?php if ($current == 1) echo 'disabled'; ?>">Previous</a>
                <a href="?controller=exam&current=<?php echo $current + 1; ?>" class="btn btn-secondary <?php if ($current == $total) echo 'disabled'; ?>">Next</a>
                <a href="?controller=exam&action=submit" class="btn btn-primary">Submit Exam</a>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/exam.js"></script>
<?php require 'views/layouts/footer.php'; ?>