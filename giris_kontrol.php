<?php
session_start();
require("connection.php");
$kullanici_adi = $_POST["kullanici_adi"];
$parola = $_POST["parola"];
if ($kullanici_adi != "" && $parola != "") {
    $sorgu = $db->prepare("SELECT * FROM KULLANICILAR WHERE KULLANICI_ADI=:ad");
    $sorgu->bindParam(":ad", $kullanici_adi);
    $sorgu->execute();
    $kullanici = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    if ($kullanici[0]["PAROLA"] == $parola && $kullanici[0]["KULLANICI_ADI"] == $kullanici_adi) {

        if($kullanici[0]["ADMINN"] == 1){
            $_SESSION["ADMIN"] = 1;
            $_SESSION["KULLANICI"] = $kullanici[0]["KULLANICI_ADI"];
            $_SESSION["AD_SOYAD"] = $kullanici[0]["AD_SOYAD"];
            $_SESSION["PROFIL_RESMI"] = $kullanici[0]["PROFIL_RESMI"];
            header("Location:index.php?giris=basarili");
        }
        else{
            $_SESSION["ADMIN"] = 0;
            $_SESSION["KULLANICI"] = $kullanici[0]["KULLANICI_ADI"];
            $_SESSION["AD_SOYAD"] = $kullanici[0]["AD_SOYAD"];
            $_SESSION["PROFIL_RESMI"] = $kullanici[0]["PROFIL_RESMI"];
            header("Location:index.php?giris=basarili");
        }
    } else {
        header("Location:index.php?giris=basarisiz");
    }
}
