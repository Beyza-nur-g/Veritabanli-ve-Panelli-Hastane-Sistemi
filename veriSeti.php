<?php

include("class.php");
include("baglanti.php");


// Sınıf nesnelerini oluşturun
$doktorNesnesi = new Doktor($baglan);
$hastaNesnesi = new Hasta($baglan);
$randevuNesnesi = new Randevu($baglan);
$raporNesnesi = new Rapor($baglan);

// Randevular tablosundaki tüm verileri sil
$sorguRandevular = "DELETE FROM randevular";
$baglan->query($sorguRandevular);

// Raporlar tablosundaki tüm verileri sil
$sorguRaporlar = "DELETE FROM raporlar";
$baglan->query($sorguRaporlar);

// Doktorlar tablosundaki tüm verileri sil
$sorguDoktorlar = "DELETE FROM doktorlar";
$baglan->query($sorguDoktorlar);

// Hastalar tablosundaki tüm verileri sil
$sorguHastalar = "DELETE FROM hastaBilgileri";
$baglan->query($sorguHastalar);


// Doktorları ekle
for ($i = 1; $i <= 100; $i++) {
    $doktorId = $i;
    $bolumler = ["Kardiyoloji", "Nöroloji", "Ortopedi", "Dermatoloji"];
    $bolumIndex = rand(0, count($bolumler) - 1);
    $bolum = $bolumler[$bolumIndex];

    $doktorNesnesi->doktorEkle("Doktor".$i, "Soyad".$i, $doktorId, $bolum);
}

// Hastaları ekle
for ($i = 1; $i <= 100; $i++) {
    $hastaTc = rand(1000000, 9999999);
    $telefon = "05".rand(10000000, 99999999);

    $hastaNesnesi->hastaEkle("Hasta".$i, "Soyad".$i, $hastaTc, "1980-01-01", "Erkek", $telefon, "Adres".$i);
}
// Hastaları ve doktorları al
$tumHastalar = $hastaNesnesi->hastalariGetir();
$tumDoktorlar = $doktorNesnesi->doktorlariGetir();

// Randevuları ekle
foreach ($tumDoktorlar as $doktor) {
    // Doktorun bölümündeki hastalardan birini rastgele seç
    $randevuHasta = $tumHastalar[array_rand($tumHastalar)];

    // Rastgele bir tarih belirle (2023-06-01 ile 2023-06-30 arasında)
    $randevuTarih = date("Y-m-d", strtotime("2023-06-01 +".rand(0, 29)." days"))." 12:00:00";

    // Randevuyu kaydet
    $randevuNesnesi->randevuKaydet($randevuTarih, $randevuHasta["hastaTc"], $doktor["doktorId"]);

    // Hastanın raporunu ekle
    $raporTarih = date("Y-m-d", strtotime($randevuTarih." +1 day"));
    $raporIcerik = "Hasta ".$doktor["bolum"]." bölümündeki doktora başvurdu.";
    $raporNesnesi->raporKaydet($raporTarih, $raporIcerik, $randevuHasta["hastaTc"], "url");
}

$_SESSION['veri_seti_eklendi'] = false;
echo "Veriler başarıyla eklendi.";

?>