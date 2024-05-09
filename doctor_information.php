<?php
require("dbconn.php");

$response = array();

// Assuming you have a table called 'doctor_table' with columns 'doctor_name', 'doctor_education', and 'doctor_location'
$sql = "SELECT doctor_name, doctor_education, doctor_location FROM doctor_table";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Doctors found, fetch and return the data
    $doctors = array();
    while ($row = $result->fetch_assoc()) {
        $doctor = array(
            'doctor_name' => $row['doctor_name'],
            'doctor_education' => $row['doctor_education'],
            'doctor_location' => $row['doctor_location']
        );
        $doctors[] = $doctor;
    }
    
    $response['status'] = 'success';
    $response['message'] = 'Doctors data retrieved successfully';
    $response['doctors'] = $doctors;
} else {
    // No doctors found
    $response['status'] = 'error';
    $response['message'] = 'No doctors found';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
