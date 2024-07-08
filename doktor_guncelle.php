<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta sınıfını içe aktar
include("class.php");

// Formdan gelen verileri al
$Ad = $_POST["doktorAd"];
$Soyad = $_POST["doktorSoyad"];
$Id = $_POST["doktorId"];
$bolum= $_POST["bolum"];

// Hasta nesnesini oluştur
$doktor = new Doktor($baglan);

// Hasta güncelleme işlemini gerçekleştir
if ($doktor->doktorGuncelle( $Ad, $Soyad,$Id, $bolum)) {
    // Başarıyla güncellendiğinde kullanıcıyı yönlendir
    header("Location: doktorIslemleri.php");
    exit(); // İşlemi sonlandır
} else {
    echo "Hasta güncellenirken bir hata oluştu.";
}
?>
