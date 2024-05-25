<?php
session_start();

// Kullanıcı oturumu açık mı kontrol edelim
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $logged_in = true;
} else {
    $logged_in = false;
}
?>

<!DOCTYPE html>
<html lang="tr">
<script>
    // Kullanıcı girişi yapıldığında alert göster
    <?php if ($logged_in): ?>
        window.onload = function() {
            alert("Giriş yapılmış durumda. Email: <?php echo $user_email; ?>");
        };
    <?php endif; ?>
</script>
<style>
    .carousel {
    margin-top: 250px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100px; /* İstediğiniz yüksekliği ayarlayın */
    }
    .carousel-inner img {
        margin-top: 250px;
      max-width: 200px; /* Fotoğrafların genişliğini ayarlayın */
      max-height: 200px; /* Fotoğrafların yüksekliğini ayarlayın */
      margin: auto;
    }
    .header-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80px; /* Başlık alanının yüksekliğini belirler */
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top:  33px;
    }
    .github-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #333;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        z-index: 1000; /* Butonun diğer elemanların üstünde olmasını sağlar */
    }
    .github-button:hover {
        background-color: #555;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çiçek Kadın</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR8CFkX5LI13QWmDA9zWfhCIp4C3UcI7PT5S89" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar fixed-top navbar navbar-expand-lg navbar-light" style="background-color: #ff9dd3;">

        <a class="navbar-brand" href="#">
            <img src="papatya.png" height="66"><span class="brand-text" ></span> Çiçek Kadın
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link ml-5" href="index.php" title="Anasayfa"><i class="fa-solid fa-house"></i><span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Çiçek İşlemleri
                    </a>
                    <div class="dropdown-menu" style="background-color:#ff9dd3">
                        <a class="dropdown-item" href="cicekbilgileri.php">Çiçek Bilgisi Ekle</a>
                        <a class="dropdown-item" href="tumcicekbilgileri.php">Tüm Çiçek Bilgileri</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="hakkimda.php">Hakkımda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Destek-Bilgi
                    </a>
                    <div class="dropdown-menu" style="background-color: #ff9dd3">
                        <a class="dropdown-item" href="nedenbuproje.php">Neden Bu Proje?</a>
                        <a class="dropdown-item" href="nasılkullanilir.php">Nasıl Kullanılır?</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="profile.php">Ben Kimim?</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="iletisim.php">İletişim</a>
                </li>

            </ul>
        </div>
        <?php if ($logged_in): ?>
          
            <div class="d-flex ml-auto">
                <button type="button" class="btn btn-dark" onclick="window.location.href = 'logout.php';">Çıkış Yap</button>
            </div>
        <?php else: ?>
            
            <div class="d-flex ml-auto">
                <button type="button" class="btn btn-light" onclick="window.location.href = 'giris.php';">Oturum Aç</button>
                <button type="button" class="btn btn-dark ml-2" onclick="window.location.href = 'form.php';">Kaydol</button>
            </div>
        <?php endif; ?>
    </nav>
<br><br><br><br>
<div class="header-container">
    <h3>Çiçek Kadın</h3>
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="we_can_do_it.png" class="d-block w-100" alt="">
    </div>
    <div class="carousel-item">
      <img src="girisimcikadin.png" class="d-block w-100" alt="">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>

  <button class="github-button" onclick="window.location.href='https://github.com/sidikafirat/Cicek-Kadin-BootStrap-ile-Web-Tabanli-Uygulama'">
        <i class="fab fa-github"></i> GitHub
    </button>
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>


