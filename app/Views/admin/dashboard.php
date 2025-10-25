<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <h1 class="mb-4"><?= esc($title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?= esc($totalUsers) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Courses</h5>
                    <p class="card-text"><?= esc($totalCourses) ?></p>
                </div>
            </div>
        </div>
    </div>

    <a href="/logout" class="btn btn-danger mt-3">Logout</a>
</div>

<?= $this->include('templates/footer') ?>
