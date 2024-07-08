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
    <title>Yeni Randevu Al</title>
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
        <h2>Yeni Randevu Al</h2>
        <form method="post" action="randevu_kayit.php" id="randevuForm">
            <div class="input-container">
                <label for="hastaTc">Hasta TC:</label>
                <input type="text" id="hastaTc" name="hastaTc" required>
            </div>
            <div class="input-container">
                <label for="bolum">Bölüm:</label>
                <select id="bolum" name="bolum" required onchange="getDoktorlar(this.value)">
                    <option value="">Bölüm Seçiniz</option>
                    <?php
                        include("baglanti.php");
                        $bolumler_sql = "SELECT DISTINCT bolum FROM doktorlar";
                        $bolumler_result = mysqli_query($baglan, $bolumler_sql);
        
                        if(mysqli_num_rows($bolumler_result) > 0) {
                            while($row = mysqli_fetch_assoc($bolumler_result)) {
                                echo "<option value='".$row['bolum']."'>".$row['bolum']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="input-container" id="doktorSecim">
                <!--  dinamik -->
            </div>
            <div class="input-container">
                <label for="randevuTarihi">Randevu Tarihi:</label>
                <input type="date" id="randevuTarihi" name="randevuTarihi" required>
            </div>
            <button type="submit" name="submit">Randevu Al</button>
        </form>
    </div>

    <script>
        // Doktorları bölüme göre getirme fonksiyonu
        function getDoktorlar(bolum) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("doktorSecim").innerHTML = this.responseText;
                }
            };
            xhr.open("GET", "doktor_randevu.php?bolum=" + bolum, true);
            xhr.send();
        }
    </script>
</body>
</html>
