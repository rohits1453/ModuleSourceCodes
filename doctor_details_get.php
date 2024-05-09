<?php
require 'dbconn.php';

// SQL query to fetch doctor details
$sql = "SELECT `s_no`, `doctor_id`, `password`, `doctor_name`, `doctor_email`, `doctor_specification`, `doctor_mobilenumber`, `doctor_qualification`, `doctor_experience`, `doctor_education`, `doctor_location` FROM `doctor_table` WHERE 1";
$result = $conn->query($sql);

$doctorDetailsArray = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $doctorId = $row["doctor_id"];
        $doctorName = $row["doctor_name"];
        $doctorEmail = $row["doctor_email"];
        $doctorSpecification = $row["doctor_specification"];
        $doctormobilenumber = $row["doctor_mobilenumber"];
        $doctorExperience = $row["doctor_experience"];
        $doctorEducation = $row["doctor_education"];
        $doctorQualification = $row["doctor_qualification"];
        $doctorLocation = $row["doctor_location"];
        $doctorpassword = $row["password"];
        
        // Create an array to hold the data
        $doctorDetails = array(
            "doctor_id" => $doctorId,
            "doctor_name" => $doctorName,
            "doctor_email" => $doctorEmail,
            "doctor_specification" => $doctorSpecification,
            "doctor_mobilenumber" => $doctormobilenumber,
            "doctor_experience" => $doctorExperience,
            "doctor_education" => $doctorEducation,
            "doctor_qualification" => $doctorQualification,
            "doctor_location" => $doctorLocation,
            "password"  => $doctorpassword
        );

        // Add the doctor details array to the main array
        array_push($doctorDetailsArray, $doctorDetails);
    }

    // Encode the main array as JSON and output it
    echo json_encode($doctorDetailsArray);
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
