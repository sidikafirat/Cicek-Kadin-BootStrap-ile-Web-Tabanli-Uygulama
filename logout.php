<?php
session_start();

// Oturum değişkenlerini sonlandır
session_unset();
session_destroy();

// Ana sayfaya yönlendir
header("Location: index.php");
exit();
?>
