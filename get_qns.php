<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drscareapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user responses
$sql = "SELECT
            u.username,
            s.question_text,
            s.option_text,
            s.score_value
        FROM
            users u
        JOIN
            survey_responses s ON u.user_id = s.user_id";

$result = $conn->query($sql);

// Process the result and convert to JSON
$response_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response_data[] = $row;
    }
}

// Convert to JSON
$json_data = json_encode($response_data);

// Output JSON
echo $json_data;

// Close connection
$conn->close();
?>
