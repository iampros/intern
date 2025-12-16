<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST') {
    $form_name = $_POST['form_name'];
    $form_description = $_POST['form_description'];

    if(isset($_POST['form_id'])) {
        // Update existing form
        $form_id = $_POST['form_id'];
        $conn->query("UPDATE forms SET form_name='$form_name', form_description='$form_description' WHERE form_id=$form_id");

        // Remove old fields
        $conn->query("DELETE FROM form_fields WHERE form_id=$form_id");

    } else {
        // Create new form
        $conn->query("INSERT INTO forms (form_name, form_description) VALUES ('$form_name','$form_description')");
        $form_id = $conn->insert_id;
    }

    // Insert new fields
    foreach($_POST['fields'] as $order => $field) {
        $label = $field['label'];
        $type = $field['type'];
        $options = isset($field['options']) ? $field['options'] : NULL;
        $required = isset($field['required']) ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO form_fields (form_id, field_label, field_type, field_options, is_required, field_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssii", $form_id, $label, $type, $options, $required, $order);
        $stmt->execute();
    }

    header("Location: index.php");
    exit();
}

// Handle duplication via GET
if(isset($_GET['duplicate'])) {
    $orig_id = $_GET['duplicate'];
    $form = $conn->query("SELECT * FROM forms WHERE form_id=$orig_id")->fetch_assoc();
    $conn->query("INSERT INTO forms (form_name, form_description) VALUES ('Copy of ".$form['form_name']."', '".$form['form_description']."')");
    $new_id = $conn->insert_id;

    $fields = $conn->query("SELECT * FROM form_fields WHERE form_id=$orig_id");
    while($f = $fields->fetch_assoc()) {
        $stmt = $conn->prepare("INSERT INTO form_fields (form_id, field_label, field_type, field_options, is_required, field_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssii", $new_id, $f['field_label'], $f['field_type'], $f['field_options'], $f['is_required'], $f['field_order']);
        $stmt->execute();
    }
    header("Location: index.php");
    exit();
}
?>
