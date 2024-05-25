<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "dbusr21360859044"; // Veritabanı kullanıcı adı
$password = "TzHd7rT5ieOh"; // Veritabanı şifresi
$dbname = "dbstorage21360859044"; // Kullanılacak veritabanı adı

// Veritabanı bağlantısını oluşturalım
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edelim
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// POST ile gelen verileri alalım
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Şifre hashleme
$email = $_POST['email'];
$occupation = $_POST['occupation'];



// SQL sorgusunu hazırlayalım
$sql = "INSERT INTO users (first_name, last_name, gender, password, email, occupation)
        VALUES (?, ?, ?, ?, ?, ?)";

// Sorguyu hazırlayalım
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $first_name, $last_name, $gender, $password, $email, $occupation);

// Sorguyu çalıştıralım
if ($stmt->execute()) {
    echo "Kullanıcı başarıyla kaydedildi.";
    header("Location: index.php");
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
