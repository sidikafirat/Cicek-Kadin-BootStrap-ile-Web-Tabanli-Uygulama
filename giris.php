<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kullanıcı Girişi</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        background: #ff9dd3; /* Pembe arka plan rengi */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: white; /* Beyaz başlık rengi */
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        color: white; /* Beyaz etiket rengi */
    }
    .form-group input {
        width: calc(100% - 20px);
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-group input:focus {
        outline: none;
        border-color: #4CAF50;
    }
    .form-group button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }
    .form-group button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Kullanıcı Girişi</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Giriş Yap</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "dbusr21360859044";
$password = "TzHd7rT5ieOh";
$dbname = "dbstorage21360859044";

// Veritabanı bağlantısını oluşturalım
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // PDO hata modunu ayarlayalım, isteğe bağlıdır
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Formdan gelen email ve şifre değerlerini alalım
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Kullanıcıyı veritabanında kontrol edelim
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Kullanıcı var mı diye kontrol edelim
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Şifreyi kontrol edelim
            if (password_verify($password, $user['password'])) {
                // Kullanıcı doğrulandı, oturum başlat
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                // Kullanıcı girişi başarılı, yönlendirme yapabilirsiniz veya mesaj verebilirsiniz
                echo "<h2>Giriş Başarılı!</h2>";
                echo "<p>Email: " . $user['email'] . "</p>";
                header("Location:index.php");
            } else {
                // Şifre hatalı
                echo "<h2>Şifre Hatalı!</h2>";
                echo "<p>Lütfen şifrenizi kontrol edin.</p>";
            }
        } else {
            // Kullanıcı bulunamadı
            echo "<h2>Email Hatalı!</h2>";
            echo "<p>Belirtilen email adresi kayıtlı değil.</p>";
        }
    } catch(PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
}

// Veritabanı bağlantısını kapat
$conn = null;
?>
