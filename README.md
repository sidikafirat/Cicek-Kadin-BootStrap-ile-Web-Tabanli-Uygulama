# Cicek Kadin Projesi

>Bu proje, BootStrap kütüphanesiyle tasarladığım bir web tabanlı uygulamadır. Çiçek dükkanı olan kadın girişimcilerin kullanabileceği bir platformdur. Kayıt olma esnasında sadece kadın cinsiyetine sahip kişilerin üye olabileceği ve kendi çiçek dükkanlarının stok bilgilerini tutabileceği bir projedir.
## Nasıl Çalışır?

> SQL kodlarım ile gerekli tabloları oluşturduktan sonra yazdığım PHP kodları ile gerekli bilgileri veritabanından alıp yazdırdım, gerektiğinde de veri tabanından sildim. 

## Kullanım
* Öncelikle web siteme http://95.130.171.20/~st21360859044 adresinden ulaşabilirsiniz. 
* Sitenin sağ üst köşesinden 'Oturum Aç' butonuna tıklayarak sisteme giriş yapabilirsiniz. Eğer üyeliğiniz yoksa 'Kaydol' butonundan kaydolup sonrasında giriş yapabilirsiniz.
* Menü Kısmından 'Çiçek İşlemleri' kısmından çiçek bilgisi ekleyebilirsiniz.
* Eklediğiniz tüm çiçekleri 'Tüm Çiçek Bilgileri' kısmından görüntüleyebilirsiniz.
* Aynı zamanda 'Tüm Çiçek Bilgileri' kısmından çiçek bilgilerini güncelleyebilir veyahut silebilirsiniz.
* Hakkımda kısmından kim olduğuma dair bilgilerim yer almaktadır.
* Destek-Bilgi kısmında bulunan 'Neden Bu Proje?' , 'Nasıl Kullanılır?' ve ' Ben Kimim?' kısmı vardır.
* Ben kimim kısmından kullanıcı kendi profil bilgilerini görüntüleyebilir.
* İletişim kısmında Linkedin ve Github linkim bulunmaktadır.
* Sağ alt köşede bulunan 'Github' butonundan siteme ait kodların bulunduğu github profilime ulaşabilirsiniz.
## SQL Kodlarım
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `occupation` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) );

  CREATE TABLE `flowers` (
  `flower_id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `flower_name` VARCHAR(45) NOT NULL,
  `stock` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`flower_id`),
  INDEX `fk_flowers_users_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_flowers_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

## Ekran Görüntüleri
>Anasayfam <br>
![Ekran görüntüsü 2024-05-25 184127](https://github.com/sidikafirat/Cicek-Kadin-BootStrap-ile-Web-Tabanli-Uygulama/assets/121318380/052eabf1-8f04-4d11-8766-cfd8c5f59105)

<br><br>
>Çiçek Bilgisi Ekleme<br>
![Ekran görüntüsü 2024-05-25 184452](https://github.com/sidikafirat/Cicek-Kadin-BootStrap-ile-Web-Tabanli-Uygulama/assets/121318380/c258388d-3aed-4e76-ad8d-e61a864f5663)


## Kullanılan Diller
* PHP
* SQL
* HTML
* CSS
* JavaScript

