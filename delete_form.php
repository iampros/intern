<?php
include 'db.php';
$form_id = $_GET['id'];
$conn->query("DELETE FROM forms WHERE form_id=$form_id");
header("Location: index.php");
exit();
?>
