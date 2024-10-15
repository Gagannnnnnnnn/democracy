<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $message = $_POST["message"];
    $candidate = isset($_POST["candidate"]) ? $_POST["candidate"] : "";




    // Process the uploaded image file
    if ($_FILES["myfile"]["error"] === UPLOAD_ERR_OK) {
        $tempName = $_FILES["myfile"]["tmp_name"];
        $fileName = $_FILES["myfile"]["name"];
        $uploadDir = "uploads/"; // Directory to store uploaded files
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the desired directory
        move_uploaded_file($tempName, $filePath);
    }

    // Save the data to the database
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "india"; // Replace with your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO complaints (message, candidate, image__path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $message, $candidate, $filePath); // Bind the username parameter

    // Execute the statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to a success page or do further processing
    header("Location: success.php");
    exit();
}
?>
