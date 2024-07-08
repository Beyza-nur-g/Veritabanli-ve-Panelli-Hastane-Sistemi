<?php
// Gerekli dosyaların dahil edilmesi
include "baglanti.php"; // Veritabanı bağlantısı
include "class.php"; // Randevu sınıfı

// Hasta TC'sini kontrol etmek için POST verisini alınması
if(isset($_POST['sil']) && isset($_POST['randevuId'])) {


    $id = $_POST['randevuId'];
    // Randevu sınıfının oluşturulması
    $randevu = new Randevu($baglan);

    // Randevu silme işleminin yapılması
    if ($randevu->randevuSilId($id)) {
        echo "Randevu başarıyla silindi.";
        header("Location: randevuIslemleri.php");
    } else {
        echo "Randevu silinirken bir hata oluştu.";
    }
} else {
    echo "Hasta TC bulunamadı.";
}
?>
