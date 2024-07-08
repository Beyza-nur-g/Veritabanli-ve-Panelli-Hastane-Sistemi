
<!-- menü -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .menu {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }
        .menu a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
        }
        .menu a:hover {
            background-color: #555;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="doktorIslemleri.php">Doktorlar</a>
        <a href="hastaIslemleri.php">Hastalar</a>
        <a href="sonuclar.php">Sonuçlar</a>
    </div>
    <div class="container">
        <!-- İçerik buraya gelecek -->
    </div>
</body>
</html>
<!-- menü son -->


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  /* Tablo stilini güncelle */
table {
  width: 100%;
  border-collapse: collapse; /* Kenar boşluklarını kaldırır */
}

/* Tablo başlıkları için stil */
th {
  background-color: #f2f2f2; /* Arka plan rengi */
  color: #333; /* Metin rengi */
  font-weight: bold; /* Kalın font */
  padding: 8px; /* İç kenar boşluğu */
}

/* Tablo hücreleri için stil */
td {
  padding: 8px; /* İç kenar boşluğu */
  text-align: left; /* Metin hizalaması */
}

/* Alternatif satırlar için farklı bir arka plan rengi */
tr:nth-child(even) {
  background-color: #f2f2f2;
}

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: #4caf50;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>


<!-- Doktor güncelleme formu -->
<h2>Doktor Bilgisi Güncelle</h2>
<form action="doktor_g.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Doktor ID" name="doktorId">
  </div>

  <button type="submit" class="btn">Bilgileri Getir</button>
</form>

<?php
include("baglanti.php");
// Doktor bilgisi güncelleme formu işlemleri
if(isset($_POST['doktorId'])) {
    $doktor_id = $_POST['doktorId'];
    
    // Güvenlik için veri temizleme (SQL injection saldırılarına karşı)
    $doktor_id = mysqli_real_escape_string($baglan, $doktor_id);
    
    // Doktor bilgisini getirme sorgusu
    $doktor_sorgu = "SELECT * FROM doktorlar WHERE doktorId='$doktor_id'";
    $doktor_result = mysqli_query($baglan, $doktor_sorgu);
    
    if(mysqli_num_rows($doktor_result) > 0) {
        // Doktor bilgilerini formda gösterme
        $row = mysqli_fetch_assoc($doktor_result);
?>
        <h2>Doktor Bilgileri Güncelle</h2>
        <form action="doktor_guncelle.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['doktorId']; ?>">
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Ad" name="doktorAd" value="<?php echo $row['doktorAd']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Soyad" name="doktorSoyad" value="<?php echo $row['doktorSoyad']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="ID" name="doktorId" value="<?php echo $row['doktorId']; ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Uzmanlık Alanı" name="bolum" value="<?php echo $row['bolum']; ?>">
            </div>

            <button type="submit" class="btn">Bilgileri Güncelle</button>
        </form>
<?php
    } else {
        echo "Doktor bulunamadı.";
    }
}
?>

</body>
</html>
