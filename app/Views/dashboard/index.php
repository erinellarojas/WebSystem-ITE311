<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Welcome, <?= esc($username) ?>!</h2>
    <hr>

    <?php if ($role === 'student'): ?>
    <div class="row">
        <div class="col-md-6">
            <h4>Enrolled Courses</h4>
            <ul class="list-group">
                <?php if (empty($enrolledCourses)): ?>
                    <li class="list-group-item">No enrolled courses yet.</li>
                <?php else: ?>
                    <?php foreach ($enrolledCourses as $course): ?>
                        <li class="list-group-item"><?= esc($course['name']) ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <div class="col-md-6">
            <h4>Available Courses</h4>
            <ul class="list-group">
                <?php if (empty($availableCourses)): ?>
                    <li class="list-group-item">All courses are enrolled.</li>
                <?php else: ?>
                    <?php foreach ($availableCourses as $course): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($course['name']) ?>
                            <button class="btn btn-primary enroll-btn" data-course-id="<?= $course['id'] ?>">Enroll</button>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
$('.enroll-btn').click(function() {
    let btn = $(this);
    $.post('/course/enroll', { course_id: btn.data('course-id') }, function(res) {
        alert(res.message);
        if (res.status === 'success') {
            btn.prop('disabled', true).text('Enrolled');
        }
    }, 'json');
});
</script>
</body>
</html>
