
<!-- navbar -->
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
        <a href="index.php"><- Çıkış</a>
        <a href="doktorIslemleri.php">Doktorlar</a>
        <a href="hastaIslemleri.php">Hastalar</a>
        <a href="raporIslemleri.php">Raporlar</a>
        <a href="randevuIslemleri.php">Randevular</a>
        
    </div>
    <div class="container">
    </div>
</body>
</html>
<!-- navbar -->


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
  background: #4caf50;
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
  border: 2px solid #4caf50;
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
/* Yeni stil */
.form-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
.form-container > div {
  width: 30%;
}
</style>
</head>
<body>

<?php
include("baglanti.php");

// Hastaları listeleme
$hastalar_sql = "SELECT * FROM hastaBilgileri";
$hastalar_result = mysqli_query($baglan, $hastalar_sql);

if(mysqli_num_rows($hastalar_result) > 0) {
    // Tablo başlıkları
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Ad</th><th>Soyad</th><th>Doğum Tarihi</th><th>Cinsiyet</th><th>Telefon</th><th>Adres</th></tr>";
    
    // Verileri tablo halinde yazdırma
    while($row = mysqli_fetch_assoc($hastalar_result)) {
        echo "<tr>";
        echo "<td>".$row['hastaTc']."</td>";
        echo "<td>".$row['hastaAd']."</td>";
        echo "<td>".$row['hastaSoyad']."</td>";
        echo "<td>".$row['dogumTarihi']."</td>";
        echo "<td>".$row['cinsiyet']."</td>";
        echo "<td>".$row['telefon']."</td>";
        echo "<td>".$row['adres']."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Hasta bulunamadı.";
}
?>

<!-- Hasta ekleme formu -->
<h2>Hasta Ekle</h2>
<form action="admin_hasta_ekle.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="TC" name="hastaTc">
  </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Ad" name="hastaAd">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Soyad" name="hastaSoyad">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Doğum Tarihi" name="dogumTarihi">
  </div>
  
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Cinsiyet" name="cinsiyet">
  </div>
  
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Telefon" name="telefon">
  </div>
  
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Adres" name="adres">
  </div>

  <button type="submit" class="btn">Hasta Ekle</button>
</form>

<!-- Hasta silme formu -->
<h2>Hasta Sil</h2>
<form action="admin_h_sil.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="TC" name="hastaTc">
  </div>

  <button type="submit" class="btn">Hasta Sil</button>
</form>

<!-- Hasta güncelleme formu -->
<h2>Hasta Bilgisi Güncelle</h2>
<form action="admin_hasta_g.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder=" Tc" name="hastaTc">
  </div>

  <button type="submit" class="btn">Bilgileri Getir</button>
</form>

<script>
// Form submit edildiğinde sayfayı yenile
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', () => {
    location.reload();
  });
});
</script>

</body>
</html>
