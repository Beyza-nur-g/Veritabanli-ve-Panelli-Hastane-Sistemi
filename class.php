<?php

// Veritabanı bağlantısını içe aktar
include("baglanti.php");

class Doktor {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function bolumleriGetir() {
        $bolumler = array();
    
        $sql = "SELECT DISTINCT bolum FROM doktorlar";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bolumler[] = $row["bolum"];
            }
        }
    
        return $bolumler;
    }
    
    public function doktorAdSoyadGetir($bolum) {
        $doktorlar = array();
    
        $sql = "SELECT doktorAd, doktorSoyad FROM doktorlar WHERE bolum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $bolum);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doktorlar[] = $row["doktorAd"] . " " . $row["doktorSoyad"];
            }
        }
    
        return $doktorlar;
    }
    public function doktorIdGetir($bolum, $doktorAd, $doktorSoyad) {
        $sql = "SELECT doktorId FROM doktorlar WHERE bolum = ? AND doktorAd = ? AND doktorSoyad = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $bolum, $doktorAd, $doktorSoyad);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["doktorId"];
        } else {
            return null; // Doktor bulunamadıysa null değeri döndürülebilir veya hata işlenebilir
        }
    }
    public function doktorlariGetir() {
        $doktorlar = array();

        $sql = "SELECT * FROM doktorlar";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doktorlar[] = $row;
            }
        }

        return $doktorlar;
    }

    public function doktorEkle($doktorAd, $doktorSoyad,$doktorId, $bolum) {
        $sql = "INSERT INTO doktorlar (doktorAd, doktorSoyad,doktorId, bolum) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis",$doktorAd, $doktorSoyad,$doktorId, $bolum );

        if ($stmt->execute()) {
            return true; // Başarıyla eklendi
        } else {
            return false; // Ekleme başarısız oldu
        }
    }

    public function doktorSil($doktorId) {

        $sql_randevular = "DELETE FROM randevular WHERE doktorId = ?";
        $stmt_randevular = $this->conn->prepare($sql_randevular);
        $stmt_randevular->bind_param("i", $doktorId);
        $stmt_randevular->execute();

        $sql = "DELETE FROM doktorlar WHERE doktorId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $doktorId);

        if ($stmt->execute()) {
            return true; // Başarıyla silindi
        } else {
            return false; // Silme başarısız oldu
        }
    }
    public function doktorGuncelle($doktorAd, $doktorSoyad,$doktorId, $bolum) {
        $sql = "UPDATE doktorlar SET doktorAd = ?, doktorSoyad = ?, doktorId = ?, bolum = ? WHERE doktorId= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisi", $doktorAd, $doktorSoyad, $doktorId, $bolum, $doktorId);



        if ($stmt->execute()) {
            return true; // Başarıyla güncellendi
        } else {
            return false; // Güncelleme başarısız oldu
        }
    }
    
}

class Hasta {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function hastaEkle($hastaAd, $hastaSoyad, $hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres) {
        $sql = "INSERT INTO hastaBilgileri (hastaAd, hastaSoyad, hastaTc, dogumTarihi, cinsiyet, telefon, adres) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssissis", $hastaAd, $hastaSoyad, $hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres);

        if ($stmt->execute()) {
            return true; // Başarıyla eklendi
        } else {
            return false; // Ekleme başarısız oldu
        }
    }

    public function hastaSil($hastaTc) {
        $sql_randevular = "DELETE FROM randevular WHERE hastaTc = ?";
        $stmt_randevular = $this->conn->prepare($sql_randevular);
        $stmt_randevular->bind_param("i", $hastaTc);
        $stmt_randevular->execute();

        $sql_raporlar = "DELETE FROM raporlar WHERE hastaTc = ?";
        $stmt_raporlar = $this->conn->prepare($sql_raporlar);
        $stmt_raporlar->bind_param("i", $hastaTc);
        $stmt_raporlar->execute();

        $sql = "DELETE FROM hastaBilgileri WHERE hastaTc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $hastaTc);

        if ($stmt->execute()) {
            return true; // Başarıyla silindi
        } else {
            return false; // Silme başarısız oldu
        }
    }

    public function hastaGuncelle($hastaAd, $hastaSoyad, $hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres) {
        $sql = "UPDATE hastaBilgileri SET hastaAd = ?, hastaSoyad = ?, hastaTc = ?, dogumTarihi = ?, cinsiyet = ?, telefon = ?, adres = ? WHERE hastaTc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssissisi", $hastaAd, $hastaSoyad, $hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres, $hastaTc);


        if ($stmt->execute()) {
            return true; // Başarıyla güncellendi
        } else {
            return false; // Güncelleme başarısız oldu
        }
    }
    public function hastaVarMi($hastaTc) {
        $sql = "SELECT COUNT(*) as count FROM hastaBilgileri WHERE hastaTc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $hastaTc);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        $count = $row['count'];
    
        return $count > 0; // true ise hasta var, false ise hasta yok
    }
    public function hastalariGetir() {
        $hatalar = array();

        $sql = "SELECT * FROM hastaBilgileri";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hastalar[] = $row;
            }
        }

        return $hastalar;
    }
    
}

class Randevu {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function randevuKaydet( $randevuTarihi ,$hastaTc, $doktorId) {
        $sql = "INSERT INTO randevular ( randevuTarihi,hastaTc,doktorId) VALUES ( ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $randevuTarihi,$hastaTc, $doktorId );

        if ($stmt->execute()) {
            return true; // Başarıyla eklendi
        } else {
            return false; // Ekleme başarısız oldu
        }
    }

    public function randevulariGetir() {
        $randevular = array();

        $sql = "SELECT * FROM randevular";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $randevular[] = $row;
            }
        }

        return $randevular;
    }
    public function randevulariGetirByTc($hastaTc) {
        $randevular = array();
    
        $sql = "SELECT * FROM randevular WHERE hastaTc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $hastaTc);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $randevular[] = $row;
            }
        }
    
        return $randevular;
    }

    public function randevuSil($hastaTc,$randevuTarihi) {
        $sql = "DELETE FROM randevular WHERE hastaTc = ? AND randevuTarihi = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $hastaTc,$randevuTarihi);

        if ($stmt->execute()) {
            return true; // Başarıyla silindi
        } else {
            return false; // Silme başarısız oldu
        }
    }
    public function randevuSilId($id) {
        $sql = "DELETE FROM randevular WHERE randevuId = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Başarıyla silindi
        } else {
            return false; // Silme başarısız oldu
        }
    }
}


class Rapor {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function raporKaydetJson($raporTarihi, $raporIcerigi, $hastaTc, $resimURL) {
        // New code to save to JSON file
        $reportData = [
            'raporTarihi' => $raporTarihi,
            'raporIcerigi' => $raporIcerigi,
            'hastaTc' => $hastaTc,
            'resimURL' => $resimURL
        ];

        $jsonFile = 'raporlar.json';
        if (file_exists($jsonFile)) {
            $jsonData = json_decode(file_get_contents($jsonFile), true);
        } else {
            $jsonData = [];
        }

        $jsonData[] = $reportData;
        file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));

        return true;
    }
    public function raporKaydet($raporTarihi, $raporIcerigi, $hastaTc, $resimURL) {
        $sql = "INSERT INTO raporlar (raporTarihi, raporIcerigi, hastaTc, resimURL) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $raporTarihi, $raporIcerigi, $hastaTc, $resimURL);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function raporlariGetir($hastaTc = null) {
        $sql = "SELECT * FROM raporlar";
        if ($hastaTc) {
            $sql .= " WHERE hastaTc = '$hastaTc'";
        }
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function raporuSil($raporId) {
        $sql = "DELETE FROM raporlar WHERE raporId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $raporId);
    
        try {
            if ($stmt->execute()) {
                return true; // Başarıyla silindi
            } else {
                return false; // Silme başarısız oldu
            }
        } catch (Exception $e) {
            echo "Hata: " . $e->getMessage();
            return false; // Silme başarısız oldu
        }
    }
}
class Kullanici 
{
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function kullaniciSorgu($usrnm, $psw) {
        $usrnm = $this->conn->real_escape_string($usrnm);
        $psw = $this->conn->real_escape_string($psw);

        $sql = "SELECT * FROM kullanicilar WHERE kullaniciId='$usrnm' AND sifre='$psw'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return true; // Kullanıcı doğrulandı
        } else {
            return false; // Kullanıcı doğrulanamadı
        }
    }
}
?>

