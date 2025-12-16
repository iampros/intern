<?php
include 'db.php';
$form_id = $_GET['id'];
$form = $conn->query("SELECT * FROM forms WHERE form_id=$form_id")->fetch_assoc();
$fields = $conn->query("SELECT * FROM form_fields WHERE form_id=$form_id ORDER BY field_order ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $form['form_name'] ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2><?= $form['form_name'] ?></h2>
<p><?= $form['form_description'] ?></p>

<form method="post" action="save_response.php">
    <input type="hidden" name="form_id" value="<?= $form_id ?>">
    <?php while($field = $fields->fetch_assoc()): ?>
        <label><?= $field['field_label'] ?>:</label><br>
        <?php
        $required = $field['is_required'] ? 'required' : '';
        switch($field['field_type']) {
            case 'text':
                echo "<input type='text' name='field_{$field['field_id']}' $required><br><br>";
                break;
            case 'textarea':
                echo "<textarea name='field_{$field['field_id']}' $required></textarea><br><br>";
                break;
            case 'radio':
            case 'checkbox':
                $options = explode(',', $field['field_options']);
                foreach($options as $option) {
                    echo "<input type='{$field['field_type']}' name='field_{$field['field_id']}" . ($field['field_type']=='checkbox' ? "[]" : "") . "' value='$option' $required> $option ";
                }
                echo "<br><br>";
                break;
            case 'select':
                $options = explode(',', $field['field_options']);
                echo "<select name='field_{$field['field_id']}' $required>";
                foreach($options as $option) {
                    echo "<option value='$option'>$option</option>";
                }
                echo "</select><br><br>";
                break;
        }
        ?>
    <?php endwhile; ?>
    <input type="submit" value="Submit">
</form>
</body>
</html>
