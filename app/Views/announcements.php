<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Announcements</h2>
    <ul class="list-group mt-3">
        <?php if(!empty($announcements)): ?>
            <?php foreach($announcements as $ann): ?>
                <li class="list-group-item">
                    <h5><?= esc($ann['title']) ?></h5>
                    <p><?= esc($ann['content']) ?></p>
                    <small>Posted on: <?= date('F d, Y', strtotime($ann['created_at'])) ?></small>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">No announcements yet.</li>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
