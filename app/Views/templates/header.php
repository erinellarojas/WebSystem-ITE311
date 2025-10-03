<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(session()->get('isLoggedIn')): ?>
                    <?php $role = session()->get('role'); ?>
                    <?php if($role === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Manage Courses</a></li>
                    <?php elseif($role === 'teacher'): ?>
                        <li class="nav-item"><a class="nav-link" href="#">My Courses</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Grades</a></li>
                    <?php elseif($role === 'student'): ?>
                        <li class="nav-item"><a class="nav-link" href="#">My Classes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Assignments</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Page content starts here -->
