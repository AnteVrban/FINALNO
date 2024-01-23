<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #007BFF; 
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

        .toolbar {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .toolbar-button {
            margin: 0 10px;
            padding: 8px 16px;
            font-size: 16px;
            background-color: #555;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .main {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .product {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
            width: 300px;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-name {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        .product-price {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        .product-specs {
            font-size: 14px;
            color: #777;
        }

        .form-container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        .form-button {
            background-color: #555;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #333;
        }
    </style>
    <title>Web Shop Računalne Opreme</title>
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
    <main>
        <div class="main">   
            <?php
            $servername = "student.veleri.hr";
            $username = "avrban";
            $password = "11";
            $dbname = "avrban";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM proizvid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<img src="' . $row["slika"] . '" alt="Product Image" class="product-image">';
                    echo '<h2 class="product-name">' . $row["ime"] . '</h2>';
                    echo '<p class="product-price">' . $row["cijena"] . '</p>';
                    echo '<p class="product-specs">' . $row["opis"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
