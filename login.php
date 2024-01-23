<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "ucka.veleri.hr";
    $username = "avrban";
    $password = "11";
    $dbname = "avrban";

   
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $loginUsername = $_POST["ime"];
    $loginPassword = $_POST["sifra"];

  
    $sql = "SELECT * FROM korisnici WHERE ime = '$loginIme' AND password = '$loginSifra'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION["loggedin"] = true;
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.html';

       
        header("Location: $referer");
    } else {
        // Ako je netocno
        $_SESSION["login_error"] = "Invalid credentials. Please try again.";
        header("Location: login.php");
        exit();
    }

    $conn->close();
} else {
    
    header("Location: login.php");
    exit();
}
?>