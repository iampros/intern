<?php
include 'db.php';
$form_id = $_GET['id'];

// Fetch form info
$form = $conn->query("SELECT * FROM forms WHERE form_id=$form_id")->fetch_assoc();
$fields = $conn->query("SELECT * FROM form_fields WHERE form_id=$form_id ORDER BY field_order ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Form</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
<h2>Edit Form: <?= $form['form_name'] ?></h2>

<form method="post" action="save_form.php">
    <input type="hidden" name="form_id" value="<?= $form_id ?>">

    <label>Form Name:</label>
    <input type="text" name="form_name" value="<?= $form['form_name'] ?>" required>

    <label>Form Description:</label>
    <textarea name="form_description"><?= $form['form_description'] ?></textarea>

    <h3>Fields:</h3>
    <div id="fields_container">
        <?php $fieldCount = 0; ?>
        <?php while($field = $fields->fetch_assoc()): $fieldCount++; ?>
            <div class="field-box" id="field_<?= $fieldCount ?>" draggable="true">
                <label>Field Label:</label>
                <input type="text" name="fields[<?= $fieldCount ?>][label]" value="<?= $field['field_label'] ?>" required>

                <label>Field Type:</label>
                <select name="fields[<?= $fieldCount ?>][type]" onchange="toggleOptions(this, <?= $fieldCount ?>)">
                    <option value="text" <?= $field['field_type']=='text'?'selected':'' ?>>Text</option>
                    <option value="textarea" <?= $field['field_type']=='textarea'?'selected':'' ?>>Textarea</option>
                    <option value="radio" <?= $field['field_type']=='radio'?'selected':'' ?>>Radio</option>
                    <option value="checkbox" <?= $field['field_type']=='checkbox'?'selected':'' ?>>Checkbox</option>
                    <option value="select" <?= $field['field_type']=='select'?'selected':'' ?>>Dropdown</option>
                </select>

                <label>Options (comma separated for radio/checkbox/select):</label>
                <input type="text" name="fields[<?= $fieldCount ?>][options]" id="options_<?= $fieldCount ?>" value="<?= $field['field_options'] ?>" <?= in_array($field['field_type'], ['radio','checkbox','select'])?'':'disabled' ?>>

                <label>Required:</label>
                <input type="checkbox" name="fields[<?= $fieldCount ?>][required]" <?= $field['is_required']?'checked':'' ?>>

                <button type="button" onclick="removeField('field_<?= $fieldCount ?>')">Remove Field</button>
            </div>
        <?php endwhile; ?>
    </div>

    <button type="button" onclick="addField()">Add Field</button><br><br>
    <input type="submit" value="Save Changes">
</form>

<script>
document.addEventListener('DOMContentLoaded', function(){
    addDragAndDrop();
});
</script>

</body>
</html>
