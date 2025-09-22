<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title ?? 'Dashboard') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Manage Courses</a></li>
                <?php elseif (session()->get('role') === 'teacher'): ?>
                    <li class="nav-item"><a class="nav-link" href="/teacher/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">My Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Assignments</a></li>
                <?php elseif (session()->get('role') === 'student'): ?>
                    <li class="nav-item"><a class="nav-link" href="/student/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">My Classes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Grades</a></li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
