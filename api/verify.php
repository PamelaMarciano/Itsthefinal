<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appName'])) {
    $appName = $_POST['appName'];

    // Retrieve applicant information from database
    $query = "SELECT * FROM users WHERE name = '$appName'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Applicant exists, display applicant information
            $row = mysqli_fetch_assoc($result);

            echo "<h2>Applicant Information</h2>";
            echo "<p>Name: {$row['name']}</p>";
            echo "<p>Age: {$row['age']}</p>";
            echo "<p>Birthday: {$row['birthday']}</p>";
            echo "<p>Address: {$row['address']}</p>";
            echo "<p>Position: {$row['position']}</p>";

            // Optionally display public key if available
            if (!empty($row['public_key'])) {
                echo "<h3>Public Key:</h3><pre>{$row['public_key']}</pre>";
            } else {
                echo "<p>No public key available.</p>";
            }
        } else {
            // Applicant does not exist
            echo "<h2>Invalid Applicant</h2>";
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
