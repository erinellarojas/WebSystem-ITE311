<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">🎓 Student Dashboard</h2>

    <!-- ✅ Enrolled Courses -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Your Enrolled Courses</div>
        <div class="card-body" id="enrolledCourses">
            <?php if (!empty($enrolledCourses)): ?>
                <ul class="list-group">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <li class="list-group-item"><?= esc($course['course_name']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">You are not enrolled in any courses yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ✅ Available Courses -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Available Courses</div>
        <div class="card-body">
            <?php if (!empty($availableCourses)): ?>
                <ul class="list-group">
                    <?php foreach ($availableCourses as $course): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($course['course_name']) ?>
                            <button class="btn btn-sm btn-outline-primary enroll-btn"
                                    data-course-id="<?= $course['id'] ?>">Enroll</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No available courses right now.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ✅ Course Materials Section -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">📚 Downloadable Materials</div>
        <div class="card-body">
            <?php if (!empty($enrolledCourses)): ?>
                <?php foreach ($enrolledCourses as $course): ?>
                    <h5 class="mt-3">Materials for <?= esc($course['course_name']) ?></h5>
                    <?php
                        $materials = $materialModel->getMaterialsByCourse($course['id']);
                    ?>
                    <?php if (!empty($materials)): ?>
                        <ul class="list-group mb-3">
                            <?php foreach ($materials as $material): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= esc($material['filename']) ?>
                                    <a href="<?= site_url('materials/download/' . $material['id']) ?>" class="btn btn-sm btn-success">⬇ Download</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No materials available for this course.</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Enroll in courses to access materials.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ✅ Alert message -->
    <div id="alertBox"></div>
</div>

<script>
$(document).ready(function(){
    $(".enroll-btn").click(function(){
        let courseId = $(this).data("course-id");
        let button = $(this);

        $.post("<?= site_url('course/enroll') ?>", { course_id: courseId }, function(response){
            if (response.status === "success") {
                $("#alertBox").html(`<div class="alert alert-success">${response.message}</div>`);
                button.prop("disabled", true).text("Enrolled");
                $("#enrolledCourses").append(`<li class='list-group-item'>New Course Added (ID: ${courseId})</li>`);
            } else {
                $("#alertBox").html(`<div class="alert alert-danger">${response.message}</div>`);
            }
        }, "json");
    });
});
</script>

</body>
</html>
