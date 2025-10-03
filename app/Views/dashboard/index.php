<!DOCTYPE html>
<html>
<head>
    <title>LMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if(session()->get('isLoggedIn')): ?>
            <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 text-center">
    <h2>Welcome, <?= esc(session()->get('username') ?? 'User') ?>!</h2>
    <p>Your role: <?= esc(session()->get('role') ?? 'N/A') ?></p>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p class="fs-3"><?= esc($totalUsers ?? 0) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <p class="fs-3"><?= esc($totalCourses ?? 0) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
