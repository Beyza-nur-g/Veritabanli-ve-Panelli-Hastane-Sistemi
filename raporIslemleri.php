
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

<?php
include 'baglanti.php';

include 'class.php';

$rapor = new Rapor($baglan);

$raporlar = [];
if(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    $hastaTc = $_GET['hastaTc'];
    $raporlar = $rapor->raporlariGetir($hastaTc);
}
else 
$raporlar = $rapor->raporlariGetir();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Raporlarım</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        img {
            max-width: 100px;
        }
        .message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
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

<h2>Raporlarım</h2>

<!-- TC girme formu -->
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    TC Girin: <input type="text" name="hastaTc" value="<?php echo isset($_GET['hastaTc']) ? $_GET['hastaTc'] : ''; ?>">
    <input type="submit" value="Bul">
</form>

<?php
if (!empty($raporlar)) {
    // Raporları tablo halinde göster
    echo "<table>
    <tr>
    <th>Rapor ID</th>
    <th>Rapor Tarihi</th>
    <th>Rapor İçeriği</th>
    <th>Hasta TC</th>
    <th>Resim</th>
    <th>İşlem</th>
    </tr>";

    foreach ($raporlar as $rapor) {
        echo "<tr>";
        echo "<td>" . $rapor['raporId'] . "</td>";
        echo "<td>" . $rapor['raporTarihi'] . "</td>";
        echo "<td>" . $rapor['raporIcerigi'] . "</td>";
        echo "<td>" . $rapor['hastaTc'] . "</td>";
        echo "<td><img src='" . $rapor['resimURL'] . "' alt='Resim'></td>";
        echo "<td><form method='post' action='admin_r_sil.php' onsubmit='return confirm(\"Bu raporu silmek istediğinizden emin misiniz?\")'>
        <input type='hidden' name='raporId' value='" . $rapor['raporId'] . "'>
        <input type='submit' name='sil' value='Sil'>
        </form></td>";
        echo "</tr>";
    }

    echo "</table>";
} elseif(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    echo "<div class='message'>Girilen TC'ye ait rapor bulunamadı.</div>";
}
?>
<!-- Rapor ekleme formu -->
<h2>Rapor Ekle</h2>
<form action="admin_rapor_ekle.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="date" placeholder="Tarih" name="raporTarihi">
  </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="İçerik" name="raporIcerigi">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Tc" name="hastaTc">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Görüntü URL" name="resimURL">
  </div>

  <button type="submit" class="btn">Rapor Yükle</button>
</form>


</body>
</html>
