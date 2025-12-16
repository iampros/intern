<?php
include 'db.php';
$id = $_GET['id'];
$fields = mysqli_query($conn, "SELECT * FROM form_fields WHERE form_id=$id");
?>
<form action="submit_form.php" method="post">
<input type="hidden" name="form_id" value="<?php echo $id; ?>">
<?php while($f = mysqli_fetch_assoc($fields)) { ?>
<label><?php echo $f['label']; ?></label><br>
<input type="<?php echo $f['field_type']; ?>" name="<?php echo $f['label']; ?>" <?php if($f['required']) echo 'required'; ?>><br><br>
<?php } ?>
<button type="submit">Submit</button>
</form>