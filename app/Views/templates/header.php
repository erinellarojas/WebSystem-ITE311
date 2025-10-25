<!doctype html><html><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>ITE311 RBAC</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">LMS Demo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if (session()->get('isLoggedIn')): ?>
          <li class="nav-item"><a class="nav-link" href="/dashboard">Home</a></li>
          <?php if (session()->get('role') === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="/admin/users">Manage Users</a></li>
          <?php elseif (session()->get('role') === 'teacher'): ?>
            <li class="nav-item"><a class="nav-link" href="/teacher/courses">My Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="/teacher/upload">Upload Material</a></li>
            <li class="nav-item"><a class="nav-link" href="/materials">All Materials</a></li>
          <?php elseif (session()->get('role') === 'student'): ?>
            <li class="nav-item"><a class="nav-link" href="/materials">Materials</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (! session()->get('isLoggedIn')): ?>
          <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
        <?php else: ?>
          <li class="nav-item"><span class="navbar-text me-2">Hello, <?= esc(session()->get('username')) ?> (<?= esc(session()->get('role')) ?>)</span></li>
          <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
