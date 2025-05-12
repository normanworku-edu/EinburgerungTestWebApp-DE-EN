<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Training Overview</div>
                <div class="card-body">
                    <canvas id="progressChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Performance Trend</div>
                <div class="card-body">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Exam History</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Exam #</th>
                        <th>Date/Time</th>
                        <th>Score</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exams as $exam): ?>
                        <tr>
                            <td><?php echo $exam['exam_id']; ?></td>
                            <td><?php echo $exam['timestamp']; ?></td>
                            <td><?php echo $exam['score']; ?>/30</td>
                            <td><a href="?controller=exam&action=details&exam_id=<?php echo $exam['exam_id']; ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/dashboard.js"></script>
<?php require 'views/layouts/footer.php'; ?>