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

// Oturum açmış kullanıcının user_id'sini al
$user_id = $_SESSION['user_id'];

// Kullanıcının eklediği çiçek bilgilerini veritabanından çek
$sql = "SELECT flower_id, flower_name, stock, color FROM flowers WHERE users_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// HTML sayfasını oluşturma
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Kullanıcı Çiçek Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff9dd3;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h1 {
            color: #ff9dd3;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 >Kullanıcı Çiçek Bilgileri</h1>
    <?php
    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'success') {
            echo "<p style='color: #ff9dd3;'>Çiçek başarıyla silindi.</p>";
        } elseif ($_GET['message'] == 'error') {
            echo "<p style='color: red;'>Çiçek silinirken bir hata oluştu.</p>";
        } elseif ($_GET['message'] == 'invalid') {
            echo "<p style='color: red;'>Geçersiz işlem.</p>";
        }
    }
    ?>
    <table>
        <tr>
            <th>Çiçek Adı</th>
            <th>Stok Bilgisi</th>
            <th>Rengi</th>
            <th>Sil</th>
            <th>Güncelle</th>
        </tr>
        <?php
        // Veritabanından çekilen verileri tabloya yazdır
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['flower_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                echo "<td>" . htmlspecialchars($row['color']) . "</td>";
                echo '<td><a href="ciceksil.php?flower_id=' . $row['flower_id'] . '">Sil</a></td>';
                echo '<td><a href="cicekbilgileriniguncelle.php?flower_id=' . $row['flower_id'] . '">Güncelle</a>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Henüz çiçek bilgisi eklenmedi.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Bağlantıyı kapat
$conn->close();
?>
