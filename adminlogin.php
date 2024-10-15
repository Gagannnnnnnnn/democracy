<?php
$adminUsername = "Gagan"; // Replace with your desired admin username
$adminPassword = "Gagan@123"; // Replace with your desired admin password

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $adminUsername && $password === $adminPassword) {
        // Start a session and set logged-in status
        session_start();
        $_SESSION["loggedin"] = true;

        // Redirect to the admin page
        header("Location: admindata.php");
        exit();
    } else {
        echo "Incorrect username or password. Please try again.";
    }
}
?>
