<?php
include 'baglanti.php';
include 'class.php';
// Eğer silme işlemi formdan gelmişse ve raporId belirtilmişse
if(isset($_POST['sil']) && isset($_POST['raporId'])) {
    // Rapor sınıfından bir nesne oluşturun
    $rapor = new Rapor($baglan);

    // Silinecek raporun ID'sini alın
    $raporId = $_POST['raporId'];

    // raporuSil fonksiyonunu çağırarak raporu silin
    if($rapor->raporuSil($raporId)) {
        // Silme işlemi başarılı ise, ana sayfaya yönlendirin
        header("Location: raporIslemleri.php");
        exit();
    } else {
        // Silme işlemi başarısız olduysa, hata mesajı gösterin
        echo "Rapor silinirken bir hata oluştu.";
    }
}
?>
