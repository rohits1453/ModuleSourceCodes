<?php
// Include the database connection file
require_once "dbconn.php";  

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve form data
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $specification = $_POST['doctor_specification'];
    $mobile_number = $_POST['doctor_mobilenumber'];
    $qualification = $_POST['doctor_qualification'];
    $experience = $_POST['doctor_experience'];
    $education = $_POST['doctor_education'];
    $location = $_POST['doctor_location'];
    $password = $_POST['password']; // Add this line to retrieve the password

    // Prepare and execute the SQL statement to update data in the doctor_table
    $sql = "UPDATE `doctor_table` SET
            `doctor_email` = '$email',
            `doctor_specification` = '$specification',
            `doctor_mobilenumber` = '$mobile_number',
            `doctor_qualification` = '$qualification',
            `doctor_experience` = '$experience',
            `doctor_education` = '$education',
            `doctor_location` = '$location',
            `password` = '$password'
            WHERE `doctor_name` = '$name'";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

} else {
    echo "Error: Invalid request method";
}
?>
