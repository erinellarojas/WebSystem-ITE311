<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📤 Upload Course Material</h2>

    <!-- ✅ Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- ✅ Upload Form -->
    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('admin/course/' . $course_id . '/upload') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="material" class="form-label">Select File (PDF, PPT, DOC, etc.)</label>
                    <input type="file" class="form-control" id="material" name="material" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Material</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>
</div>

</body>
</html>
