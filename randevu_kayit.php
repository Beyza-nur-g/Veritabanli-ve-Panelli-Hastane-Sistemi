<?php
include("baglanti.php");
include("class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $hastaTc = $_POST["hastaTc"];
    $hasta = new Hasta($baglan);

    // Hasta TC'sinin varlığını kontrol et
    if ($hasta->hastaVarMi($hastaTc)) {
        // Form verilerini al
        $bolum = $_POST["bolum"];
        $doktorAdSoyad = $_POST["doktorAd"]; // Bu değer formda seçildiğinde doktorAd ve doktorSoyad olarak ayrılmış olacak
        $randevuTarihi = $_POST["randevuTarihi"];
        
        // Doktor ID'sini al
        $doktorAdSoyadDizi = explode(" ", $doktorAdSoyad);
        $doktorAd = $doktorAdSoyadDizi[0];
        $doktorSoyad = $doktorAdSoyadDizi[1];
        
        $doktor = new Doktor($baglan);
        $doktorId = $doktor->doktorIdGetir($bolum, $doktorAd, $doktorSoyad);

        // Randevu sınıfını oluştur
        $randevu = new Randevu($baglan);

        // Randevuyu kaydet ve sonucu kontrol et
        if ($randevu->randevuKaydet($randevuTarihi,$hastaTc, $doktorId)) {
            echo "Randevu başarıyla kaydedildi.";
            header("Location: index.php");
        } else {
            echo "Randevu kaydedilirken bir hata oluştu.";
        }
    } else {
        // Hasta bulunamadıysa uyarı mesajı ver
        echo '<p class="message">Hasta bulunamadı. Lütfen geçerli bir hasta TC giriniz.</p>';
    }
}
?>
