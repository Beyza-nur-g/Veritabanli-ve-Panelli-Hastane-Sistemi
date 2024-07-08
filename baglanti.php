<?php
$vt_sunucu = "localhost";
$vt_kullanici= "root";
$vt_sifre = "";
$vt_adi = "hastane";

$baglan = mysqli_connect($vt_sunucu,$vt_kullanici,$vt_sifre,$vt_adi);
if(!$baglan)
{
    die("veri tabanına bağlanamadı ".mysqli_connet_error());
}
?>