<?php
include("baglanti.php");
include("class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Form verilerini al
    $hastaTc = $_POST["hastaTc"];
    $doktorId = $_POST["doktorId"]; 
    $randevuTarihi = $_POST["randevuTarihi"];
    
    // Randevu sınıfını oluştur
    $randevu = new Randevu($baglan);

    // Randevuyu kaydet ve sonucu kontrol et
    if ($randevu->randevuKaydet($randevuTarihi,$hastaTc, $doktorId)) {
        echo "Randevu başarıyla kaydedildi.";
        header("Location: randevuIslemleri.php");
    } else {
        echo "Randevu kaydedilirken bir hata oluştu.";
    }
}
else echo "Randevu kaydedilirken bir hata oluştu.";
?>