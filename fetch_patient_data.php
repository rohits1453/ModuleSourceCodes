<?php
require('dbconn.php');

$sql = "SELECT * FROM `patient_table` WHERE 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $rowData = array(
            'patient_id' => $row['patient_id'],
            'patient_name' => $row['patient_name'],
            'patient_age' => $row['patient_age'],
            'patient_mobile_number' => $row['patient_mobile_number']
        );
        $data[] = $rowData;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}
$conn->close();
?>
