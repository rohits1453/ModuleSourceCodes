<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drscareapp";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    // Get user input
    $user_id = $_SESSION["user_id"];
    $question_id = $_POST["question_id"];
    $selected_option = $_POST["selected_option"];

    // Insert user response into survey_responses table
    $sql = "INSERT INTO survey_responses (user_id, question_id, option_text, score_value)
            SELECT '$user_id', '$question_id', '$selected_option', score_value
            FROM survey_responses
            WHERE question_id = '$question_id' AND option_text = '$selected_option'";

    // Log the SQL query
    error_log("SQL Query: $sql");

    if ($conn->query($sql) === TRUE) {
        echo "Quiz submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
