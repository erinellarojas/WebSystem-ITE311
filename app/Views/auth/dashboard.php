<div class="row">
  <div class="col-12">
    <h1>Dashboard</h1>
    <p>Welcome, <strong><?= esc($username) ?></strong> &mdash; Role: <em><?= esc($role) ?></em></p>
  </div>
</div>

<div class="row mt-3">
<?php if ($role === 'admin'): ?>
  <div class="col-md-4">
    <div class="card p-3">
      <h5>Admin Dashboard</h5>
      <p>Total Users: <?= esc($stats['users_count'] ?? 'N/A') ?></p>
      <a href="/admin/users" class="btn btn-primary">Manage Users</a>
    </div>
  </div>
<?php elseif ($role === 'teacher'): ?>
  <div class="col-md-12">
    <div class="card p-3">
      <h5>Teacher Dashboard</h5>
      <p>Total Courses: <?= esc($stats['course_count'] ?? 0) ?></p>
      <a href="/teacher/courses" class="btn btn-primary">View My Courses</a>
      <a href="/teacher/upload" class="btn btn-secondary ms-2">Upload Material</a>
    </div>
  </div>
  <?php if (!empty($courses)): ?>
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-primary text-white">My Courses</div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Course Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
              <td><?= esc($course['course_name']) ?></td>
              <td>
                <a href="/admin/course/<?= $course['id'] ?>/upload" class="btn btn-sm btn-success">Upload Material</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endif; ?>
<?php else: ?>
  <div class="col-md-12">
    <div class="card p-3">
      <h5>Student Dashboard</h5>
      <p>Enrolled Courses: <?= esc($stats['enrolled_courses'] ?? 0) ?></p>
    </div>
  </div>

  <!-- Enrolled Courses Section -->
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-success text-white">Your Enrolled Courses</div>
      <div class="card-body" id="enrolledCourses">
        <?php if (!empty($enrolledCourses)): ?>
          <ul class="list-group">
            <?php foreach ($enrolledCourses as $course): ?>
              <li class="list-group-item">
                <strong><?= esc($course['course_name']) ?></strong>
                <div class="mt-2">
                  <?php $materials = $materialModel->getMaterialsByCourse($course['id']); ?>
                  <?php if (!empty($materials)): ?>
                    <small class="text-muted">Materials:</small>
                    <ul>
                      <?php foreach ($materials as $material): ?>
                        <li><a href="/materials/download/<?= $material['id'] ?>" class="btn btn-sm btn-outline-primary">⬇ Download <?= esc($material['filename']) ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <small class="text-muted">No materials available yet.</small>
                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted">You are not enrolled in any courses yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Available Courses Section -->
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-info text-white">Available Courses</div>
      <div class="card-body">
        <?php if (!empty($availableCourses)): ?>
          <div class="row">
            <?php foreach ($availableCourses as $course): ?>
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?= esc($course['course_name']) ?></h5>
                            <button class="btn btn-primary enroll-btn" data-course-id="<?= $course['id'] ?>">Enroll Ready</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-muted">No available courses.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $(".enroll-btn").click(function(){
    let courseId = $(this).data("course-id");
    let button = $(this);

    $.post("<?= site_url('course/enroll') ?>", { course_id: courseId }, function(response){
      if (response.status === "success") {
        button.prop("disabled", true).text("Enrolled");
        location.reload(); // Reload to update the dashboard
      } else {
        alert("Enrollment failed: " + response.message);
      }
    }, "json").fail(function(){
      alert("An error occurred during enrollment.");
    });
  });
});
</script>
