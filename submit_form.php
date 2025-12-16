<?php
include 'db.php';
$form_id = $_POST['form_id'];
mysqli_query($conn, "INSERT INTO responses(form_id) VALUES('$form_id')");
$rid = mysqli_insert_id($conn);


foreach ($_POST as $k => $v) {
if ($k != 'form_id') {
mysqli_query($conn, "INSERT INTO response_values(response_id, field_label, value)
VALUES('$rid','$k','$v')");
}
}


echo "Form Submitted Successfully";
?>