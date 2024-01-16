<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require("connection.php");

$yeni_kullanici_adi = $_POST["kullanici_adi"];
$yeni_parola = $_POST["parola"];
$yeni_ad_soyad = $_POST["ad_soyad"];

if ($yeni_kullanici_adi != "" && $yeni_parola != "" && $yeni_ad_soyad != "") 
{
    $kontrol_sorgu = $db->prepare("SELECT COUNT(*) FROM KULLANICILAR WHERE KULLANICI_ADI = :ad");
    $kontrol_sorgu->bindParam(":ad", $yeni_kullanici_adi);
    $kontrol_sorgu->execute();
    $kullanici_sayisi = $kontrol_sorgu->fetchColumn();

    if ($kullanici_sayisi == 0) {
        if (isset($_FILES["profil_resmi"])) {
            $profil_resmi = $_FILES["profil_resmi"];
            $upload_dir = "resim/";
            $allowed_types = array("jpg", "jpeg", "png", "gif");

            $file_info = pathinfo($profil_resmi["name"]);
            $file_extension = strtolower($file_info["extension"]);

            if (in_array($file_extension, $allowed_types)) {
                if ($profil_resmi["size"] <= 2 * 1024 * 1024) {

                    $new_filename = $yeni_kullanici_adi . "." . $file_extension;
                    $upload_path = $upload_dir . $new_filename;
                    move_uploaded_file($profil_resmi["tmp_name"], $upload_path);

                    $ekle_sorgu = $db->prepare("INSERT INTO KULLANICILAR (KULLANICI_ADI, PAROLA, AD_SOYAD, PROFIL_RESMI, ADMINN) VALUES (:ad, :parola, :adsoyad, :profil_resmi, 0)");
                    $ekle_sorgu->bindParam(":ad", $yeni_kullanici_adi);
                    $ekle_sorgu->bindParam(":parola", $yeni_parola);
                    $ekle_sorgu->bindParam(":adsoyad", $yeni_ad_soyad);
                    $ekle_sorgu->bindParam(":profil_resmi", $new_filename);
                    $ekle_sorgu->execute();

                    $_SESSION["ADMIN"] = 0;
                    $_SESSION["KULLANICI"] = $yeni_kullanici_adi;
                    $_SESSION["AD_SOYAD"] = $yeni_ad_soyad;
                    $_SESSION["PROFIL_RESMI"] = $new_filename;

                    header("Location:index.php?kayit=basarili");
                } else {
                    header("Location:kayit.php?kayit=basarisiz&hata=dosya_boyutu");
                }
            } else {
                header("Location:kayit.php?kayit=basarisiz&hata=gecersiz_tur");
            }
        } else {
            header("Location:kayit.php?kayit=basarisiz&hata=profil_resmi_secilmedi");
        }
    } else {
        header("Location:kayit.php?kayit=basarisiz&hata=kullanici_ad_zaten_var");
    }
} else {
    header("Location:kayit.php?kayit=basarisiz&hata=eksik_bilgi");
}
?>