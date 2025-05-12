    document.addEventListener('DOMContentLoaded', () => {    
        // Use JSON.parse() to safely inject PHP data into JavaScript
        const progressData = JSON.parse('<?php echo json_encode($progress); ?>');
        const examsData = JSON.parse('<?php echo json_encode($exams); ?>');
        
        const progressChart = new Chart(document.getElementById('progressChart'), {
            type: 'pie',
            data: {
                labels: ['Correct', 'Incorrect', 'Unattempted'],
                datasets: [{
                    // Access the progress data safely after parsing
                    data: [progressData.correct, progressData.incorrect, progressData.unattempted],
                    backgroundColor: ['#28a745', '#dc3545', '#6c757d']
                }]
            }
        });

        const trendChart = new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                // Access the exams data safely after parsing
                labels: examsData.map(e => e.timestamp),
                datasets: [{
                    label: 'Exam Scores',
                    data: examsData.map(e => e.score),
                    borderColor: '#007bff',
                    fill: false
                }]
            }
        });
    });