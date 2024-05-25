<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çiçek Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
            color:#ffabcf;
        }

        form {
            background-color: #ffabcf;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container form {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="form-container">
        <h1>Çiçek Bilgileri Ekle</h1>
        <form action="cicekbilgileri.php" method="post">
            <label for="flower_name">Çiçek Adı:</label>
            <input type="text" id="flower_name" name="flower_name" required>
            
            <label for="stock">Stok Bilgisi:</label>
            <input type="number" id="stock" name="stock" required>
            
            <label for="color">Rengi:</label>
            <input type="text" id="color" name="color" required>
            
            <input type="submit" value="Ekle" style="background-color:green;">
        </form>
    </div>
</body>
</html>

<?php
session_start();

// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "dbusr21360859044";
$password = "TzHd7rT5ieOh";
$dbname = "dbstorage21360859044";

// Veritabanı bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formun POST metoduyla gönderildiğinden emin olun
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $flower_name = isset($_POST['flower_name']) ? $_POST['flower_name'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : 0;
    $color = isset($_POST['color']) ? $_POST['color'] : '';

    // Oturum açmış kullanıcının user_id'sini al
    $user_id = $_SESSION['user_id'];

    // Verilerin boş olmadığını kontrol et
    if (!empty($flower_name) && !empty($stock) && !empty($color)) {
        // Hazırlıklı ifade kullanarak çiçek bilgilerini veritabanına ekle
        $stmt = $conn->prepare("INSERT INTO flowers (users_id, flower_name, stock, color) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $flower_name, $stock, $color);

        if ($stmt->execute()) {
            echo "Yeni çiçek bilgisi başarıyla eklendi.";
            header("Location:index.php");
        } else {
            echo "Hata: " . $stmt->error;
        }

        // İfadenin kapatılması
        $stmt->close();
    } else {
        echo "Lütfen tüm alanları doldurun.";
    }
}

// Bağlantıyı kapat
$conn->close();
?>
