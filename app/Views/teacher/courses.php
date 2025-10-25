<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📚 My Courses</h2>

    <!-- ✅ Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- ✅ Courses Table -->
    <div class="card">
        <div class="card-body">
            <?php if (!empty($courses)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= esc($course['course_name']) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/course/' . $course['id'] . '/upload') ?>" class="btn btn-sm btn-primary">Upload Material</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted text-center">No courses assigned to you.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>
</div>

</body>
</html>
