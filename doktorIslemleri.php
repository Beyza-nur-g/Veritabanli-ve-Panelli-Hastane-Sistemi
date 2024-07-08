
<!-- menü -->

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
  background-color:#4caf50;
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

<?php
include("baglanti.php");

// Doktorları listeleme
$doktorlar_sql = "SELECT * FROM doktorlar";
$doktorlar_result = mysqli_query($baglan, $doktorlar_sql);

if(mysqli_num_rows($doktorlar_result) > 0) {
    // Tablo başlıkları
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Ad</th><th>Soyad</th><th>Uzmanlık Alanı</th></tr>";
    
    // Verileri tablo halinde yazdırma
    while($row = mysqli_fetch_assoc($doktorlar_result)) {
        echo "<tr>";
        echo "<td>".$row['doktorId']."</td>";
        echo "<td>".$row['doktorAd']."</td>";
        echo "<td>".$row['doktorSoyad']."</td>";
        echo "<td>".$row['bolum']."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Doktor bulunamadı.";
}
?>

<!-- Doktor ekleme formu -->
<h2>Doktor Ekle</h2>
<form action="doktor_ekle.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="ID" name="doktorId">
  </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Ad" name="doktorAd">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Soyad" name="doktorSoyad">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Uzmanlık Alanı" name="bolum">
  </div>

  <button type="submit" class="btn">Doktor Ekle</button>
</form>

<!-- Doktor silme formu -->
<h2>Doktor Sil</h2>
<form action="doktor_sil.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="ID" name="doktorId">
  </div>

  <button type="submit" class="btn">Doktor Sil</button>
</form>

<!-- Doktor güncelleme formu -->
<h2>Doktor Bilgisi Güncelle</h2>
<form action="doktor_g.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Doktor ID" name="doktorId">
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
