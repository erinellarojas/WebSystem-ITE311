<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📚 Course Materials</h2>

    <!-- ✅ Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- ✅ Materials Table -->
    <div class="card">
        <div class="card-body">
            <?php if (!empty($materials)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Filename</th>
                            <th>Uploaded By</th>
                            <th>Uploaded On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($materials as $m): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= esc($m['course_name']) ?></td>
                            <td><?= esc($m['filename']) ?></td>
                            <td><?= esc($m['uploader_name']) ?></td>
                            <td><?= esc($m['uploaded_at']) ?></td>
                                <td>
                                    <a href="<?= site_url('material/download/' . $m['id']) ?>" class="btn btn-sm btn-success">
                                        ⬇ Download
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted text-center">No materials uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>
</div>

</body>
</html>
