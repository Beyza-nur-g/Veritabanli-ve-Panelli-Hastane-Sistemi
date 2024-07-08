<?php
// Gerekli dosyaların dahil edilmesi
include "baglanti.php"; // Veritabanı bağlantısı
include "class.php"; // Randevu sınıfı

// Hasta TC'sini kontrol etmek için POST verisini alınması
if (isset($_POST['hastaTc'])) {
    $hastaTc = $_POST['hastaTc'];
    $randevuTarihi = $_POST['randevuTarihi'];


    // Randevu sınıfının oluşturulması
    $randevu = new Randevu($baglan);

    // Randevu silme işleminin yapılması
    if ($randevu->randevuSil($hastaTc,$randevuTarihi)) {
        echo "Randevu başarıyla silindi.";
        header("Location: randevu.php");
    } else {
        echo "Randevu silinirken bir hata oluştu.";
    }
} else {
    echo "Hasta TC bulunamadı.";
}
?>
