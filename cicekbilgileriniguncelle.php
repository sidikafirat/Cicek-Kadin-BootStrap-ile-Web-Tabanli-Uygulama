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

// Form verilerini almak için gerekli kontroller
$flower_id = $_GET['flower_id'] ?? null;
if (!isset($flower_id)) {
    header("Location: tumcicekbilgileri.php?message=invalid");
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
if (!isset($user_id)) {
    header("Location: tumcicekbilgileri.php?message=invalid");
    exit();
}

// Eğer form gönderilmişse, veritabanında güncelleme işlemini yap
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flower_name = $_POST['flower_name'] ?? '';
    $stock = $_POST['stock'] ?? 0;
    $color = $_POST['color'] ?? '';

    // Verilerin boş olmadığını kontrol et
    if (!empty($flower_name) && !empty($stock) && !empty($color)) {
        // Güncelleme sorgusunu hazırla ve çalıştır
        $stmt = $conn->prepare("UPDATE flowers SET flower_name = ?, stock = ?, color = ? WHERE flower_id = ? AND users_id = ?");
        $stmt->bind_param("sisis", $flower_name, $stock, $color, $flower_id, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Güncelleme başarılı oldu
            $stmt->close();
            $conn->close();
            header("Location: tumcicekbilgileri.php?message=update_success");
            exit();
        } else {
            // Güncelleme başarısız oldu veya çiçek bulunamadı
            $stmt->close();
            $conn->close();
            header("Location: tumcicekbilgileri.php?message=update_error");
            exit();
        }
    } else {
        echo "Lütfen tüm alanları doldurun.";
    }
}

// Çiçek bilgilerini al
$sql = "SELECT flower_name, stock, color FROM flowers WHERE flower_id = ? AND users_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $flower_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $flower_name = $row['flower_name'];
    $stock = $row['stock'];
    $color = $row['color'];
} else {
    // Çiçek bulunamadı
    header("Location: tumcicekbilgileri.php?message=flower_not_found");
    exit();
}

// Bağlantıyı kapat
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çiçek Bilgilerini Güncelle</title>
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

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            width: 400px;
        }

        h1 {
            color: #ff9dd3;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Çiçek Bilgilerini Güncelle</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?flower_id=" . $flower_id; ?>" method="post">
            <div>
                <label for="flower_name">Çiçek Adı:</label><br>
                <input type="text" id="flower_name" name="flower_name" value="<?php echo htmlspecialchars($flower_name); ?>" required><br><br>
            </div>
            
            <div>
                <label for="stock">Stok Bilgisi:</label><br>
                <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($stock); ?>" required><br><br>
            </div>
            
            <div>
                <label for="color">Rengi:</label><br>
                <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($color); ?>" required><br><br>
            </div>
            
            <input type="submit" value="Güncelle">
        </form>
    </div>
</body>
</html>
