<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Veritabanı bağlantısı
$servername = "localhost";
$username = "dbusr21360859044";
$password = "TzHd7rT5ieOh";
$dbname = "dbstorage21360859044";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, first_name, last_name, gender, email, occupation FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $first_name, $last_name, $gender, $email, $occupation);
$stmt->fetch();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Bilgileri</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
        }
        .profile-table {
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-table th, .profile-table td {
            padding: 15px;
            text-align: left;
        }
        .profile-table th {
            background-color: #ffabcf;
            color: white;
        }
        .profile-table td {
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5 profile-container">
        <h1 class="mb-4 text-center" style="color: #ffabcf ">Profil Bilgileri</h1>
        <table class="table profile-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Cinsiyet</th>
                    <th scope="col">Email</th>
                    <th scope="col">Meslek</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($id); ?></td>
                    <td><?php echo htmlspecialchars($first_name); ?></td>
                    <td><?php echo htmlspecialchars($last_name); ?></td>
                    <td><?php echo htmlspecialchars($gender); ?></td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td><?php echo htmlspecialchars($occupation); ?></td>
                </tr>
            </tbody>
        </table>
  
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
