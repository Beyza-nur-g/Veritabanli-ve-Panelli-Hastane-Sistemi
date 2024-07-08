<!-- navBar -->
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
      <a href="hasta_guncelle.php">kayıt güncelle</a>
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
<?php
include("baglanti.php");
include("class.php");

$hasta = new Hasta($baglan);
$rapor = new Rapor($baglan);

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hastaTc = $_POST["hastaTc"];
    $raporTarihi = $_POST["raporTarihi"];
    $raporIcerigi = $_POST["raporIcerigi"];
    $resimURL = $_POST["resimURL"];

    if ($hasta->hastaVarMi($hastaTc)) {
        if ($rapor->raporKaydet($raporTarihi, $raporIcerigi, $hastaTc, $resimURL)) {
            $successMessage = 'Rapor başarıyla kaydedildi.';

            // Raporu JSON dosyasına da kaydet
            $rapor->raporKaydetJson($raporTarihi, $raporIcerigi, $hastaTc, $resimURL);

            header("Location: index.php");
            exit();
        } else {
            $errorMessage = 'Rapor kaydedilemedi.';
        }
    } else {
        $errorMessage = 'Hasta bulunamadı.';
    }
}

$baglan->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Rapor Ekleme Formu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            width: 100%;
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
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
        .error {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Rapor Ekleme Formu</h2>
    <?php if ($successMessage): ?>
        <p class="message"><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <p class="error"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Rapor Tarihi: <input type="date" name="raporTarihi" required><br>
        Rapor İçeriği: <textarea name="raporIcerigi" required></textarea><br>
        Hasta TC: <input type="text" name="hastaTc" required><br>
        Resim URL: <input type="text" name="resimURL" required><br>
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
