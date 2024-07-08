# Veritabanli-ve-Panelli-Hastane-Sistemi
 Projemde sql veritabanıyla oluşturulmuş tablolar ve bu tablolar ilişkileriyle oluşturulmuş kısımlar mevcuttur. Web sayfasında hasta kayıt sonrasında TC ile hastanın bütün işlemleri gerçekleştirilebilmektedir. Aynı zamanda bir admin paneli de bulunmaktadır. Admin panelinde doktor ve hasta işlemlerine dair her kısım yapılabilmektedir.


Projemi veritabına geçi¸s sırasında PHP dilini kullanarak
yazdım. Gerekli kısımlarda açmak gerekirse dinamik bir web
sayfası olması için javaScript dilinden de faydalandım. Veritabanı uygulması olarak phpMyAdmin kullanım için ise
XAMPP kullandım.Projede web sayfasına ilk giri¸ste anasayfa
bizi kar¸sılamaktadır. Yapılacak her i¸slem ba¸sında ve sonrasında
sistem bizi anasayfaya yönlendirmektedir.Her seferinde hasta
kayıt olmasına ve giri¸s yapmasına gerek yoktur. Hasta bir kez
kayıt yaptıktan sonra Tc ile randevu alma ,silme , güncelleme
ve rapor yükleme ve görüntüleme i¸slemlerini yapabilmektedir.
daha öncesinde bir kayıt bulunmuyor ise hasta kayıt i¸slemi
yapmalıdır. Hasta daha sonra isterse kaydını silebilir ve güncelleyebilir. Admin sayfasına geçmek için adminin kullanıcı
adı ve ¸sifresini girmesi gerekir. Dogrulama i¸slemi yapıldı ˘ gında ˘
hasta ile benzer i¸sleri yapilmektedir .Hastadan farklı olarak
doktor i¸slemlerini de yapabilmektedir.


III. YÖNTEM
Anasayfadan hastanın her sayfaya geçi¸s izni vardır . ˙I¸slem
yapabilmesi için Tc sinin kayıt olması yeterlidir. Randevu
˙I¸slemlerinde randevu alma, randevu silme ve randevu görüntüleme i¸slemleri bulunmaktadır.Randevu silme ve randevu
görüntüleme i¸slemleri için hastanın Tc girmesi yeterlidir. Randevu almak için Tc sini , randevu tarihini , randevu almak
istedigi bölümü ve randevu almak istedi ˘ gi doktoru seçmesi ˘
gerekmektedir. Burada web sayfası dinamik çalı¸smaktadır.
Doktor bölümü seçildiginde doktor listesi güncellenir ve o ˘
bölüme ait doktor isimleri listeye aktarılır.Bu i¸slem dinamik
olarak gerçekle¸sir ve kullanıcın bir güncelleme yapmasına
gerek kalmaz. Aynı i¸slem benzerlikleri rapor içinde vardır.
Rapor yükleme ve rapor görüntüleme olarak iki kısma ayrılır.
Rapor yükleme sırasında hasta Tc si , rapor tarihi , rapor içerigi˘
ve resim urlsi alnır ve kaydedilir. Rapor görüntüleme de ise
bir tc girme yerini bulunur o kısıma TC girildiginde var olan ˘
raporlar listelenir. Kullanıcı eger isterse tabloda bulunan raporu ˘
silebilmektedir. Bu kısımda dinamik olarak çalı¸sıp kullanıcının
ekstra bir yenileme yapmasına gerek yoktur. Bu kısımda
daha önce resimURL kısmına eklenmi¸s url bir lik olarak
bulunmaktadır ve açılabilmektedir. Burada bulunan bütün rapor
bilgileri veritabanındaki raporlar tablosundan ayrı olarak bir
json dosyaya da kaydedilmektedir.Raporlar istenildiginde bu ˘
kısımdan da bakılabilmektedir.Panel kısmında ise öncellikle
giri¸s için form doldurmak gerekir . Bu form kullanıcı ismini
ve ¸sifreyi almaktadır Kontrolü ise kullanıcılar tablosundan
yapar.Admin bu sayfada doktor i¸slemleri , hasta i¸slemleri ,
rapor i¸slemleri ve randevu i¸slemleri yapabilmektedir.Doktor
i¸slem sayfasında var olan bütün doktor bilgileri tablo olarak
listelenir. Sayfanın devamında ise doktor ekle , sil ve güncelle
olarak kısımlar bulunur . Güncelleme i¸slemi için istenen ID
ye göre yeni sayfada bilgiler girili olarak yeni form açılır
admin buradan istedigi bilgiyi güncelleyip kaydedebilir.Aynı ˘
i¸slemler hasta , randevu ve rapor içinde geçerlidir . Yapılan
her i¸slem ilgili tablonun sorgusu yapılarak yapılır . Bu sorgular
ise gerekli classların içinde olup fonksiyonlar yardımı ile nesne
yönelik bir web sayfası ortaya çıkmı¸stır .

A. FONKS˙IYONLAR
Var olan bütün fonksiyonlar classların içindedir. Fonksiyonlara eri¸sim için class.php sayfasını kullanacagımız sayfaya ˘
include etmek gerekmekte.Bu sayfa Kullanici , Rapor ,Randevu , Hasta ve Doktor olmak üzere be¸s tane classtan olu¸smaktadır. Kullanici classında kullaniciSorgu fonksiyonu bulunmaktadır. Bu fonksiyon veritabında kullanicalar tablosundaki kullanıcı adı ve ¸sifereyi kar¸sıla¸stırma yapar ve eger de ˘ gerler do ˘ gru ˘
ise true döndürür. Rapor classının içinde raporSil , raporKaydet
, raporKaydetJson , raporlariGetir fonksiyonları bulunur . BU
fonksiyonlarda sogu yapar ve sorgulara göre gerekli i¸slemleri
gerçkel¸stirir. raporKaydetJson rapor bilgilerini bir json dosyaya
kaydetme fonksiyonudur. Randevu calssının içinde randevuSil
, randevularıGetirByTc ( bu fonksiyon filtreleme i¸slemi için
kullanılmakta) randevulariGetir ve randevukaydet fonksiyonları bulunur .Hasta classının içinde silme ,ekleme , güncelleme fonksiyonlarının yanında hasta varlıgını kontrol etmek ˘
amacıyla hastaVarMi fonksiyonu da bulunur .Doktor classının
içinde ekleme silme güncelleme fonksiyonları bulunur . Bu
fonksiyonlara ek olarak doktorAdSoyadgetir fonksiyonu ile
seçilen bolüme göre ad soyad getirme fonksiyonu ; doktorIdGetir ile bolum , ad ve soyada göre ıd getirme fonksiyonu
bulunmaktadır . BolumleriGetir fonksiyonu da tablodan var
olan bütün bölümleri getirmeye yarayan fonksiyondur.


IV. DENEYSEL SONUÇLAR
Farklı a¸samalar ile çalı¸sarak bunları ortak bir veritabında
birle¸stirerek bir web sayfayası ortaya çıkarttım . Dinamik
çalı¸smayı ögrendim . Gerekli ara¸stırmalarla daha iyi bir web ˘
sayfasının gereklerini uygulamaya çalı¸smayı ögrendim. ˘


V. SONUÇ
Nesne yönelik kurallarına uyarak veritabanına ait sorguların çogu classların içindeki fonksiyonlara eri¸silerek veriraba- ˘
nına kaydetme , silme ve güncelleme i¸slemlerini yapan bir web
sayfası tasarlanmı¸stır . ˙Iki kısımdan olu¸san web sayfasında hastanın kullanabilecegi ve gerekli i¸slemlerini tamamlayabilece ˘ gi˘
bir kısım bulunur . Diger kısım ise adminin kullanıcı adı ve ˘
¸sifresiyle giri¸s yaptıgı sayfdaki her kısmı de ˘ gi¸stirme güncel- ˘
leme ekleme ve çıkarma yapabildigi kısımdır . Web sayfanın ˘
bazı kısımları dinamik olarak çalı¸sarak seçme i¸slemine göre
güncelleme gerektirmeden bilgileri ekrana getirebilmektedir .
