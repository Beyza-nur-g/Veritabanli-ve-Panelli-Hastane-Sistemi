<?php
include("baglanti.php"); // Veritabanı bağlantısını içe aktar
include("class.php"); // Randevu sınıfını içe aktar

// Hasta TC'sini al
if(isset($_POST['hastaTc'])) {
    $hastaTc = $_POST['hastaTc'];
} else {
    $hastaTc = ""; // Varsayılan olarak boş bir değer ata
}

// Randevu nesnesini oluştur
$randevu = new Randevu($baglan);

// Eğer hasta TC'si gönderilmişse, sadece o hastaya ait randevuları al
if (!empty($hastaTc)) {
    $gecmisRandevular = $randevu->randevulariGetirByTc($hastaTc);
} else {
    $gecmisRandevular = array(); // Boş bir dizi oluştur
}
?>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geçmiş Randevular</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
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
    <h2>Geçmiş Randevular</h2>
    <form method="post">
        <input type="text" name="hastaTc" placeholder="Hasta TC girin">
        <button type="submit">Randevuları Getir</button>
    </form>
    <div class="container">
    <br>
    <?php if (!empty($gecmisRandevular)) { ?>
        <table>
            <tr>
                <th>Randevu ID</th>
                <th>Randevu Tarihi</th>
                <th>Hasta TC</th>
                <th>Doktor ID</th>
            </tr>
            <?php foreach ($gecmisRandevular as $randevu) { ?>
                <tr>
                    <td><?php echo $randevu['randevuId']; ?></td>
                    <td><?php echo $randevu['randevuTarihi']; ?></td>
                    <td><?php echo $randevu['hastaTc']; ?></td>
                    <td><?php echo $randevu['doktorId']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Belirtilen TC'ye ait randevu bulunamadı.</p>
    <?php } ?>
</body>
</html>
