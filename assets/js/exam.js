document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('answer-form');
    const pauseBtn = document.getElementById('pause-btn');
    const timerDisplay = document.getElementById('timer');
    let timeLeft = 30 * 60;
    let isPaused = false;
    let timer;

    const updateTimer = () => {
        if (isPaused) return;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        if (timeLeft <= 0) {
            window.location.href = '?controller=exam&action=submit';
        }
        timeLeft--;
    };

    timer = setInterval(updateTimer, 1000);

    pauseBtn.addEventListener('click', () => {
        isPaused = !isPaused;
        pauseBtn.textContent = isPaused ? 'Resume' : 'Pause';
        if (isPaused) {
            document.body.style.pointerEvents = 'none';
        } else {
            document.body.style.pointerEvents = 'auto';
        }
    });

    

form.addEventListener('change', () => {
    const selected = form.querySelector('input[name="choice"]:checked');
    if (selected) {
        const questionIndex = JSON.parse("<?php echo json_encode($current - 1); ?>");
        fetch('?controller=exam&action=saveAnswer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                question_index: questionIndex,
                choice_index: parseInt(selected.value)
            })
        });
    }
});
});