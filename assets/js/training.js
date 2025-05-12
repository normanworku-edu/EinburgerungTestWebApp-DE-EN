document.addEventListener('DOMContentLoaded', () => {
    let currentLang = 'de';
    const questionText = document.getElementById('question-text');
    const choices = Array.from(document.querySelectorAll('label[id^="choice"]'));
    const form = document.getElementById('answer-form');
    const feedback = document.getElementById('feedback');
    const langToggle = document.getElementById('lang-toggle');
    const questionId = JSON.parse("<?php echo json_encode($question['id']); ?>");

    // Language toggle
    langToggle.addEventListener('click', () => {
        currentLang = currentLang === 'de' ? 'en' : 'de';
        langToggle.textContent = `Switch to ${currentLang === 'de' ? 'English' : 'German'}`;
        fetch(`?controller=training&action=getQuestion&lang=${currentLang}&id=${questionId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.json())
            .then(data => {
                questionText.textContent = data.text;
                choices.forEach((choice, index) => {
                    choice.textContent = data.choices[index];
                });
            });
    });

    // Answer submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const selected = form.querySelector('input[name="choice"]:checked');
        if (!selected) {
            feedback.innerHTML = '<div class="alert alert-warning">Please select an answer.</div>';
            return;
        }

        const choiceIndex = parseInt(selected.value);
        fetch('?controller=training&action=submitAnswer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                question_id: questionId,
                choice_index: choiceIndex
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.correct) {
                    feedback.innerHTML = '<div class="alert alert-success">Correct!</div>';
                    selected.nextElementSibling.classList.add('text-success');
                } else {
                    feedback.innerHTML = '<div class="alert alert-danger">Incorrect.</div>';
                    selected.nextElementSibling.classList.add('text-danger');
                    document.getElementById(`choice${data.correct_choice}`).nextElementSibling.classList.add('text-success');
                }
            });
    });
});
