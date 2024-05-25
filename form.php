<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Formu</title>
    <script>
        function validateForm() {
            var gender = document.getElementById("gender").value;
            if (gender !== "Female") {
                alert("Kadın cinsiyetini seçmelisiniz.");
                return false;
            }
            return true;
        }
    </script>
    <style>
        h2{
            color:#ff9dd3;
        }
        label{
            color:#ff9dd3;
        }
    </style>
</head>
<body>
    <h2>Kayıt Formu</h2>
    <form action="database.php" method="post" onsubmit="return validateForm()">
        <label for="first_name">İsim:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>
        
        <label for="last_name">Soyisim:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="gender">Cinsiyet:</label><br>
        <select id="gender" name="gender" required>
            <option value="">Cinsiyet Seçiniz</option>
            <option value="Male">Erkek</option>
            <option value="Female">Kadın</option>
            <option value="Other">Diğer</option>
        </select><br><br>
        
        <label for="password">Şifre:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="email">E-posta:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="occupation">Meslek:</label><br>
        <input type="text" id="occupation" name="occupation" required><br><br>
        
        <input type="submit" value="Kayıt Ol" style="background-color: #ff9dd3;">

    </form>
</body>
</html>
