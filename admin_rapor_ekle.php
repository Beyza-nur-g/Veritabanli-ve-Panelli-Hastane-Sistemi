<?php
include 'class.php';
include 'baglanti.php';

// POST isteğini kontrol etmek için
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $raporTarihi = $_POST["raporTarihi"];
    $raporIcerigi = $_POST["raporIcerigi"];
    $hastaTc = $_POST["hastaTc"];
    $resimURL = $_POST["resimURL"]; 
    

   
    // Rapor nesnesi oluştur
    $rapor = new Rapor($baglan);


    // Hasta ekle ve sonucu kontrol et
if ($rapor->raporKaydet( $raporTarihi, $raporIcerigi, $hastaTc,$resimURL)) {
    echo "Hasta başarıyla eklendi.";
    header("Location: raporIslemleri.php");
} else {
    echo "Hasta eklenirken bir hata oluştu.";
}
}
?>