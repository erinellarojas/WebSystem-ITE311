<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Course Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="text-center mb-4">📚 Upload Course Material</h3>

    <!-- Success or Error Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Upload Form -->
    <form action="<?= site_url('material/upload') ?>" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="course_id" class="form-label">Select Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="">-- Choose Course --</option>
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= esc($course['id']) ?>"><?= esc($course['course_name']) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="material" class="form-label">Upload File</label>
            <input type="file" name="material" id="material" class="form-control" accept=".pdf,.ppt,.pptx,.doc,.docx" required>
            <small class="text-muted">Allowed types: PDF, PPT, DOC. Max size: 5MB</small>
        </div>

        <button type="submit" class="btn btn-primary w-100">Upload</button>
    </form>
</div>

</body>
</html>
