<!DOCTYPE html>
<html>
<head>
    <title>Admin - Questions</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>All Questions</h3>
    <a href="/Admin/create" class="btn btn-success mb-3">Add New Question</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th><th>Text (DE)</th><th>Text (EN)</th><th>Image</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $q): ?>
            <tr>
                <td><?= $q['id'] ?></td>
                <td><?= htmlentities($q['text_de']) ?></td>
                <td><?= htmlentities($q['text_en']) ?></td>
                <td>
                    <?php if ($q['image_path']): ?>
                        <img src="/<?= $q['image_path'] ?>" width="60">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/Admin/delete?id=<?= $q['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this question?')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>
