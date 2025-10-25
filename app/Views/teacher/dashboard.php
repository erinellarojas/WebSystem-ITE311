<?= $this->include('templates/header') ?>

<h1 class="mb-4"><?= esc($title) ?></h1>

<h4>Your Courses</h4>
<ul class="list-group mb-3">
    <?php foreach ($courses as $course): ?>
        <li class="list-group-item"><?= esc($course) ?></li>
    <?php endforeach; ?>
</ul>

<a href="/logout" class="btn btn-danger">Logout</a>

<?= $this->include('templates/footer') ?>
