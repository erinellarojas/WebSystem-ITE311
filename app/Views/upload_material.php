<!-- app/Views/upload_material.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Course Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center mb-4">📚 Upload Course Material</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('material/upload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="course_id" class="form-label">Course ID</label>
                <input type="number" name="course_id" id="course_id" class="form-control" placeholder="Enter Course ID" required>
            </div>

            <div class="mb-3">
                <label for="material" class="form-label">Select File</label>
                <input type="file" name="material" id="material" class="form-control" accept=".pdf,.ppt,.pptx,.doc,.docx,.zip" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Upload Material</button>
        </form>
    </div>
</div>

</body>
</html>
