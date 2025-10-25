<div class="container mt-5">
    <h2>Upload Course Material</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('material/upload') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Course ID:</label>
            <input type="text" name="course_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Choose File:</label>
            <input type="file" name="material" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
