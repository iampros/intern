<?php
include 'db.php';
$form_id = $_GET['form_id'];
$form = $conn->query("SELECT * FROM forms WHERE form_id=$form_id")->fetch_assoc();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="responses_'.$form_id.'.csv"');

$output = fopen('php://output', 'w');

$fields = $conn->query("SELECT * FROM form_fields WHERE form_id=$form_id ORDER BY field_order ASC");
$headers = ['Response ID','Submitted At'];
$field_arr = [];
while($f = $fields->fetch_assoc()) {
    $headers[] = $f['field_label'];
    $field_arr[$f['field_id']] = $f['field_label'];
}
fputcsv($output, $headers);

$responses = $conn->query("SELECT * FROM form_responses WHERE form_id=$form_id");
while($resp = $responses->fetch_assoc()) {
    $row = [$resp['response_id'], $resp['submitted_at']];
    foreach($field_arr as $fid => $label) {
        $val = $conn->query("SELECT value FROM form_response_values WHERE response_id=".$resp['response_id']." AND field_id=$fid")->fetch_assoc()['value'];
        $row[] = $val;
    }
    fputcsv($output, $row);
}
fclose($output);
?>
