<?php
include 'db.php';
$form_id = $_GET['form_id'];
$form = $conn->query("SELECT * FROM forms WHERE form_id=$form_id")->fetch_assoc();
$responses = $conn->query("SELECT * FROM form_responses WHERE form_id=$form_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Responses for <?= $form['form_name'] ?></title>
</head>
<body>
<h2>Responses for <?= $form['form_name'] ?></h2>
<a href="export_csv.php?form_id=<?= $form_id ?>">Export CSV</a><br><br>
<table border="1">
<tr>
    <th>Response ID</th>
    <th>Submitted At</th>
    <?php
    $fields = $conn->query("SELECT * FROM form_fields WHERE form_id=$form_id ORDER BY field_order ASC");
    $field_arr = [];
    while($f = $fields->fetch_assoc()) {
        echo "<th>".$f['field_label']."</th>";
        $field_arr[$f['field_id']] = $f['field_label'];
    }
    ?>
</tr>
<?php while($resp = $responses->fetch_assoc()): ?>
<tr>
    <td><?= $resp['response_id'] ?></td>
    <td><?= $resp['submitted_at'] ?></td>
    <?php
    foreach($field_arr as $fid => $label) {
        $val = $conn->query("SELECT value FROM form_response_values WHERE response_id=".$resp['response_id']." AND field_id=$fid")->fetch_assoc()['value'];
        echo "<td>$val</td>";
    }
    ?>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
