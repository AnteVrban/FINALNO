<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stil.css">
  
    <title>Web Shop Računalne Opreme - Početna stranica</title>
</head>
<body>
    <header class="header">
        <h1>WEB-SHOP RAČUNALNE OPREME</h1>
        <nav class="toolbar">
            <a href="index.html" class="toolbar-button">Početna stranica</a>
            <a href="proizvodi.php" class="toolbar-button">Proizvodi</a>
            <a href="kontakt.html" class="toolbar-button">Kontakt</a>
            <a href="registracija.php" class="toolbar-button">Prijavi se</a>
        </nav>
    </header>
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

    
    $loginUsername = $_POST["loginime"];
    $loginPassword = $_POST["loginsifra"];
$hashedPassword = password_hash($loginPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT * FROM korisnici WHERE ime = ? AND sifra = ?");
$stmt->bind_param("ss", $loginUsername, $hashedPassword);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
    echo "User found in the database!";
        $_SESSION["loggedin"] = true;
        
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.html';
        

       
        header("Location: $referer");
    } else {
        // Ako je netocno
        
    
   
       $_SESSION["login_error"] = "Ne tocne informacije. Pokušajte ponovo.";
        
        header("Location: registracija.php");
        echo "<script>alert('Ne točne informacije. Pokušajte ponovo.');</script>";
        exit();
    }

    $conn->close();
} /*else {
    
    header("Location: registracija.php");
exit();}*/
?>

            <div class="registration-form">
                <h2>Registracija</h2>
                <div class="form-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <label for="username">Korisničko ime:</label>
                        <input type="text" id="username" name="username" class="form-input" required>

                        <label for="username">Email:</label>
                        <input type="text" id="email" name="email" class="form-input" required>

                        <label for="password">Lozinka:</label>
                        <input type="password" id="password" name="password" class="form-input" required>

                        <label for="confirmPassword">Potvrdi lozinku:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" required>

                       
                        <button type="submit" class="form-button">Registriraj se</button>
                    </form>
                </div>
            </div>
            <div class="login-form">
                <h2>Prijava</h2>
                <div class="form-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    
                        <label for="loginime">Korisničko ime:</label>
                        <input type="text" id="loginime" name="loginime" class="form-input" required>

                        <label for="loginsifra">Lozinka:</label>
                        <input type="password" id="loginsifra" name="loginsifra" class="form-input" required>

                        <button type="submit" class="form-button">Prijavi se</button>
                        
   
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>