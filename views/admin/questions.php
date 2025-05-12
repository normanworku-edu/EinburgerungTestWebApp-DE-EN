<?php require 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Manage Questions</h2>
    <a href="?controller=admin&action=create" class="btn btn-primary mb-3">Add New Question</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Text (German)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td><?php echo $question['id']; ?></td>
                    <td><?php echo htmlspecialchars($question['text_de']); ?></td>
                    <td>
                        <a href="?controller=admin&action=edit&id=<?php echo $question['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <a href="?controller=admin&action=delete&id=<?php echo $question['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'views/layouts/footer.php'; ?>