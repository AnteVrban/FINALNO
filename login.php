<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "korisnici";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the form
    $loginUsername = $_POST["loginIme"];
    $loginPassword = $_POST["loginSifra"];

    // Validate user credentials (you may need to adjust this based on your database structure)
    $sql = "SELECT * FROM korisnici WHERE ime = '$loginIme' AND password = '$loginSifra'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, set a session variable and redirect to a protected page
        $_SESSION["loggedin"] = true;
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.html';

        // Redirect back to the referring page
        header("Location: $referer");
    } else {
        // Invalid credentials, redirect back to the login page with an error message
        $_SESSION["login_error"] = "Invalid credentials. Please try again.";
        header("Location: login.php");
        exit();
    }

    $conn->close();
} else {
    // If the form is not submitted, redirect back to the login page
    header("Location: login.php");
    exit();
}
?>