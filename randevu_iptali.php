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
    <title>Randevu Sil</title>
    <style>
        /* Form styles */
 html {
    height: 100%;
    margin: 0;
    align-items: center;
    background-color: #f0f0f0;
}

.container {
    text-align: center;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}

input[type="text"] {
    width: 300px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color:#4caf50;
    color: white;
    cursor: pointer;
}

button:hover {
    background-color: #007bff;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Randevu Sil</h2>
        <form action="randevu_sil.php" method="post">
            <input type="text" name="hastaTc" placeholder="Hasta TC Giriniz" required>
            
            <input type="text" name="randevuTarihi" placeholder="Randevu Tarihinizi Giriniz" required>

            <button type="submit">Randevuyu Sil</button>
        </form>
    </div>
</body>
</html>
