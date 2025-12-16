<?php
include 'db.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
    $form_id = $_POST['form_id'];
    $conn->query("INSERT INTO form_responses (form_id) VALUES ($form_id)");
    $response_id = $conn->insert_id;

    foreach($_POST as $key => $value) {
        if(strpos($key, 'field_') === 0) {
            $field_id = str_replace('field_', '', $key);

            if(is_array($value)) {
                $value = implode(',', $value);
            }

            $stmt = $conn->prepare("INSERT INTO form_response_values (response_id, field_id, value) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $response_id, $field_id, $value);
            $stmt->execute();
        }
    }
    echo "Thank you! Your response has been submitted.";
}
?>
