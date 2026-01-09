<!DOCTYPE html>
<html>
<head>
    <title><?= $data['title'] ?></title>
</head>
<body>

<h1><?= $data['title'] ?></h1>

<h3>User List</h3>

<ul>
    <?php foreach ($data['users'] as $user): ?>
        <li>
            <?= htmlspecialchars($user['name']) ?>
            (<?= htmlspecialchars($user['email']) ?>)
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
