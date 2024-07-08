<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");
include ( "class.php");
$doktor = new Doktor($baglan);

// Formdan gelen veriyi al
$id = $_POST['doktorId'];
 
// Sorguyu çalıştır ve sonucu kontrol et
if($doktor ->doktorSil($id) ) {
    // Doktor başarıyla silindi, admin.php sayfasına yönlendir
    header("Location: doktorIslemleri.php");
    exit();
} else {
    echo "Hata: " . $sql . "<br>" . mysqli_error($baglan);
}

// Veritabanı bağlantısını kapat
mysqli_close($baglan);
?>
