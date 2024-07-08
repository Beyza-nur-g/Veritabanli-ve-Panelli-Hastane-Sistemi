<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu Al</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select, input, button {
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">

<h2>Hasta Bilgisi Güncelle</h2>
<form action="admin_hasta_g.php" method="post">
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder=" Tc" name="hastaTc">
    </div>

    <button type="submit" class="btn">Bilgileri Getir</button>
</form>

<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta bilgisi güncelleme formu işlemleri
if(isset($_POST['hastaTc'])) {
    $hasta_id = $_POST['hastaTc'];
    
    // Güvenlik için veri temizleme (SQL injection saldırılarına karşı)
    $hasta_id = mysqli_real_escape_string($baglan, $hasta_id);
    
    // Hasta bilgisini getirme sorgusu
    $hasta_sorgu = "SELECT * FROM hastaBilgileri WHERE hastaTc='$hasta_id'";
    $hasta_result = mysqli_query($baglan, $hasta_sorgu);
    
    if(mysqli_num_rows($hasta_result) > 0) {
        // Hasta bilgilerini formda gösterme
        $row = mysqli_fetch_assoc($hasta_result);
?>
        <h2>Hasta Bilgileri Güncelle</h2>
        <form action="admin_h_guncelle.php" method="post">
            <input type="hidden" name="hastaTc" value="<?php echo $row['hastaTc']; ?>">

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Ad" name="hastaAd" value="<?php echo $row['hastaAd']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Soyad" name="hastaSoyad" value="<?php echo $row['hastaSoyad']; ?>">
            </div>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="TC" name="hastaTc" value="<?php echo $row['hastaTc']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Doğum Tarihi" name="dogumTarihi" value="<?php echo $row['dogumTarihi']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Cinsiyet" name="cinsiyet" value="<?php echo $row['cinsiyet']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Telefon" name="telefon" value="<?php echo $row['telefon']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Adres" name="adres" value="<?php echo $row['adres']; ?>">
            </div>

            <button type="submit" class="btn">Bilgileri Güncelle</button>
        </form>
<?php
    } else {
        echo "Hasta bulunamadı.";
    }
}
?>
</div>
    
</body>
</html>
