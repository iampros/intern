<?php
include 'db.php';
$forms = $conn->query("SELECT * FROM forms ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2>All Forms</h2>
<a href="create_form.php">+ Create New Form</a><br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while($form = $forms->fetch_assoc()): ?>
    <tr>
        <td><?= $form['form_id'] ?></td>
        <td><?= $form['form_name'] ?></td>
        <td><?= $form['form_description'] ?></td>
        <td>
            <a href="view_form.php?id=<?= $form['form_id'] ?>">View</a> |
            <a href="edit_form.php?id=<?= $form['form_id'] ?>">Edit</a> |
            <a href="save_form.php?duplicate=<?= $form['form_id'] ?>" onclick="return confirm('Duplicate this form?')">Duplicate</a> |
            <a href="delete_form.php?id=<?= $form['form_id'] ?>" onclick="return confirm('Delete this form?')">Delete</a> |
            <a href="view_responses.php?form_id=<?= $form['form_id'] ?>">Responses</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
