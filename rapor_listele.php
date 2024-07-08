<?php
include 'baglanti.php';

include 'class.php';

$rapor = new Rapor($baglan);

$raporlar = [];
if(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    $hastaTc = $_GET['hastaTc'];
    $raporlar = $rapor->raporlariGetir($hastaTc);
}


?><!-- navBar -->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Anasayfa</a>
  <div class="dropdown">
    <button class="dropbtn">Randevu İşlemleri
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="randevu_al.php">randevu al</a>
      <a href="randevu_iptali.php">randevu sil</a>
      <a href="gecmis_randevu.php">randevu görüntüle</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Lab Sonuçları 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="rapor_olustur.php">Rapor Yükle</a>
      <a href="rapor_listele.php">Rapor Görüntüle</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Hasta İşlemleri 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="hasta_kayit.php">Kayıt ol</a>
      <a href="hasta_sil.php">kayıt sil</a>
      <a href="hasta_guncelle.php">hayıt Güncelle</a>
    </div>
  </div> 
  <a class="admin" href="panel_admin.php">Admin Girişi</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>
<!-- navBar -->

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
        input[type="submit"] {
            width: 5%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        input[type="sub"] {
            width: 10%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 3s;
            text-align : center;
        }
        input[type="sub"]:hover {
            background-color: #45a049;
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
        echo "<td><a href='" . $rapor['resimURL'] . "' download><img src='" . $rapor['resimURL'] . "' alt='Resim'></a></td>";
        echo "<td><form method='post' action='r_sil.php' onsubmit='return confirm(\"Bu raporu silmek istediğinizden emin misiniz?\")'>
        <input type='hidden' name='raporId' value='" . $rapor['raporId'] . "'>
        <input type='sub' name='sil' value='Sil'>
        </form></td>";
        echo "</tr>";

    }

    echo "</table>";
} elseif(isset($_GET['hastaTc']) && !empty($_GET['hastaTc'])) {
    echo "<div class='message'>Girilen TC'ye ait rapor bulunamadı.</div>";
}
?>
</body>
</html>
