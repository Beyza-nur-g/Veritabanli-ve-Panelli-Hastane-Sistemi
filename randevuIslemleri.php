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

$randevu = new Randevu($baglan);

$randevular = [];
if(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    $hastaTc = $_GET['hastaTc'];
    $randevular = $randevu->randevulariGetirByTc($hastaTc);
}
else 
$randevular = $randevu->randevulariGetir();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Randevular</title>
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

<h2>Randevular</h2>

<!-- TC girme formu -->
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    TC Girin: <input type="text" name="hastaTc" value="<?php echo isset($_GET['hastaTc']) ? $_GET['hastaTc'] : ''; ?>">
    <input type="submit" value="Bul">
</form>

<?php
if (!empty($randevular)) {
    // Raporları tablo halinde göster
    echo "<table>
    <tr>
    <th>Randevu ID</th>
    <th>Randevu Tarihi</th>
    <th>Doktor ID</th>
    <th>Hasta TC</th>
    </tr>";

    foreach ($randevular as $ra) {
        echo "<tr>";
        echo "<td>" . $ra['randevuId'] . "</td>";
        echo "<td>" . $ra['randevuTarihi'] . "</td>";
        echo "<td>" . $ra['doktorId'] . "</td>";
        echo "<td>" . $ra['hastaTc'] . "</td>";
        echo "<td><form method='post' action='admin_u_sil.php' onsubmit='return confirm(\"Bu raporu silmek istediğinizden emin misiniz?\")'>
        <input type='hidden' name='randevuId' value='" . $ra['randevuId'] . "'>
        <input type='submit' name='sil' value='Sil'>
        </form></td>";
        echo "</tr>";
    }

    echo "</table>";
} elseif(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    echo "<div class='message'>Girilen TC'ye ait randevu bulunamadı.</div>";
}
?>
<!-- Randevu ekleme formu -->
<h2>Randevu Ekle</h2>
<form action="admin_u_ekle.php" method="post">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="date" placeholder="Tarih" name="randevuTarihi">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Hasta TC" name="hastaTc">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Doktor ID" name="doktorId">
  </div>

  <button type="submit" class="btn" name="submit">Randevu ekle</button>
</form>


</body>
</html>
