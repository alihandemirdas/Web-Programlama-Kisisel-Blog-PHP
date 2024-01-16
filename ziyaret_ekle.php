<?php
session_start();
require("connection.php");

if (!isset($_SESSION["ADMIN"])) {
    header("Location:ziyaret.php");
}

$ad = $_GET["ad"];
$sorgu = $db->prepare("SELECT ID FROM kullanicilar WHERE AD_SOYAD = :ad_soyad");
$sorgu->bindParam(":ad_soyad", $ad);
$sorgu->execute();

$sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

if ($sonuc) {
    $id = $sonuc['ID'];
} else {
    echo "Kullanıcı bulunamadı.";
}

if (isset($_POST["submitted"])) {
    print_r($_POST);
    $mesaj = $_POST["MESAJ"];
    $sorgu = $db->prepare("INSERT INTO `ziyaretciler`( `KULLANICI_ID`, `MESAJ`) VALUES (:ziyaretci_ad,:mesaj)");
    $sorgu->bindParam(":ziyaretci_ad", $id);
    $sorgu->bindParam(":mesaj", $mesaj);
    $sorgu->execute();
    header("Location:ziyaret.php");
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Mesaj Bırakma Sayfası</title>
</head>

<body class="bg-secondary">
    <?php
    require("menu.php");
    ?>
    <div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
        <div class="w-50">
            <h1 class="display-1 text-center mb-5">Mesaj Bırak</h1>
            <form action="" method="POST">
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input id="ziyaretci_adi" name="ZIYARETCI_AD" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Ad Soyad</label>
                        </div>
                    </div>
                </div> -->
                <div class="input-group my-2">
                    <div class="form-floating">
                        <textarea name="MESAJ" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Mesaj</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="ziyaret.php" class="btn btn-danger me-2">İptal Et</a>
                    <button type="submit" name="submitted" value="1" class="btn" style="background-color:#FFF5C2">Gönder</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>