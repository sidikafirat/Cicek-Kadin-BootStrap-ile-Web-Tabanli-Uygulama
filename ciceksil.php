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

// GET parametresinden flower_id'yi al
if (isset($_GET['flower_id']) && isset($_SESSION['user_id'])) {
    $flower_id = $_GET['flower_id'];
    $user_id = $_SESSION['user_id'];
    
    // Silme sorgusunu hazırlama ve çalıştırma
    $stmt = $conn->prepare("DELETE FROM flowers WHERE flower_id = ? AND users_id = ?");
    $stmt->bind_param("ii", $flower_id, $user_id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Çiçek başarıyla silindi
        $stmt->close();
        $conn->close();
        header("Location: tumcicekbilgileri.php?message=success");
        exit();
    } else {
        // Çiçek silinirken bir hata oluştu veya çiçek bulunamadı
        $stmt->close();
        $conn->close();
        header("Location: tumcicekbilgileri.php?message=error");
        exit();
    }
} else {
    // Gerekli parametreler eksik
    $conn->close();
    header("Location: tumcicekbilgileri.php?message=invalid");
    exit();
}
?>
