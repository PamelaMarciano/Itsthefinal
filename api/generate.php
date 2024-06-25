<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appName'])) {
    $appName = $_POST['appName'];

    // Attempt to retrieve applicant information from database
    $query = "SELECT * FROM users WHERE name = '$appName'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Applicant exists, proceed with operations
            $row = mysqli_fetch_assoc($result);

            // Attempt to generate private key
            $privateKey = openssl_pkey_new();
            if ($privateKey === false) {
                die('Failed to generate private key: ' . openssl_error_string());
            }

            // Export private key
            $exported = openssl_pkey_export($privateKey, $privateKeyString);
            if ($exported === false) {
                die('Failed to export private key: ' . openssl_error_string());
            }

            // Get public key details
            $publicKeyDetails = openssl_pkey_get_details($privateKey);
            if ($publicKeyDetails === false) {
                die('Failed to get public key details: ' . openssl_error_string());
            }
            $publicKey = $publicKeyDetails['key'];

            // Display generated keys (or perform other operations)
            echo "<h2>Generated Keys for $appName</h2>";
            echo "<h3>Private Key:</h3><pre>$privateKeyString</pre>";
            echo "<h3>Public Key:</h3><pre>$publicKey</pre>";

            // Update keys in the database
            $privateKeyString = mysqli_real_escape_string($conn, $privateKeyString);
            $publicKey = mysqli_real_escape_string($conn, $publicKey);
            $updateQuery = "UPDATE users SET private_key = '$privateKeyString', public_key = '$publicKey' WHERE name = '$appName'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                die("Error updating keys: " . mysqli_error($conn));
            }
        } else {
            // Applicant does not exist
            echo "<h2>Invalid Applicant</h2>";
        }
    } else {
        // Query execution failed
        die("Query failed: " . mysqli_error($conn));
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
