<?php
session_start();
require("connection.php");

if ($_SESSION["ADMIN"] != 1) {
    header("Location: deneyim.php");
}

$id = $_GET["id"];

$sorgu = $db->prepare("SELECT d.*, s.SIRKET_AD FROM deneyimler d LEFT JOIN sirketler s ON d.SIRKET_ID = s.ID WHERE d.ID = :id");
$sorgu->bindParam(":id", $id);
$sorgu->execute();
$deneyim = $sorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["submitted"])) {
    $deneyim_ad = $_POST["DENEYIM_AD"];

    $sorgu_sirket = $db->prepare("SELECT * FROM sirketler WHERE SIRKET_AD = :deneyim_ad");
    $sorgu_sirket->bindParam(":deneyim_ad", $deneyim_ad);
    $sorgu_sirket->execute();
    $sirket = $sorgu_sirket->fetch(PDO::FETCH_ASSOC);

    if (!$sirket) {
        $sorgu_ekle = $db->prepare("INSERT INTO sirketler (SIRKET_AD) VALUES (:deneyim_ad)");
        $sorgu_ekle->bindParam(":deneyim_ad", $deneyim_ad);
        $sorgu_ekle->execute();

        $sirket_id = $db->lastInsertId();
    } else {
        $sirket_id = $sirket["ID"];
    }

    $deneyim_icerik = $_POST["DENEYIM_ICERIK"];
    $bas_yil = $_POST["BAS_TARIH"];
    $bit_yil = $_POST["BIT_TARIH"];

    $id = $_GET["id"];

    $sorgu = $db->prepare("UPDATE `deneyimler` SET `SIRKET_ID`=:sirket_id, `DENEYIM_ICERIK`=:deneyim_icerik, `BASLANGIC_TARIHI`=:bas_yil, `BITIS_TARIHI`=:bit_yil WHERE `ID`=:id");

    $sorgu->bindParam(":id", $id);
    $sorgu->bindParam(":sirket_id", $sirket_id);
    $sorgu->bindParam(":deneyim_icerik", $deneyim_icerik);
    $sorgu->bindParam(":bas_yil", $bas_yil);
    $sorgu->bindParam(":bit_yil", $bit_yil);

    $sorgu->execute();

    header("Location: deneyim.php");
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
    <title>Deneyim Güncelleme Sayfası</title>
</head>

<body class="bg-secondary">
    <?php
    require("menu.php");
    ?>
    <div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
        <div class="w-50">
            <h1 class="display-1 text-center mb-5">Deneyim Güncelle</h1>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input id="deneyim_adi" name="DENEYIM_AD" type="text" class="form-control" placeholder="name@example.com" value="<?php echo $deneyim['SIRKET_AD']; ?>">
                            <label for="floatingInput">Deneyim</label>
                        </div>
                    </div>
                </div>
                <div class="input-group my-2">
                    <div class="form-floating">
                        <textarea name="DENEYIM_ICERIK" class="form-control" placeholder="Leave a comment here" style="height: 100px"><?php echo $deneyim['DENEYIM_ICERIK']; ?></textarea>
                        <label for="floatingTextarea2">Açıklama</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input id="bas_tarih" name="BAS_TARIH" type="text" class="form-control" placeholder="Örnek: 2012" value="<?php echo $deneyim['BASLANGIC_TARIHI']; ?>">
                            <label for="floatingInput">Başlangıç Tarihi</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input id="bit_tarih" name="BIT_TARIH" type="text" class="form-control" placeholder="Örnek: 2012" value="<?php echo $deneyim['BITIS_TARIHI']; ?>">
                            <label for="floatingInput">Bitiş Tarihi</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="deneyim.php" class="btn btn-danger me-2">İptal Et</a>
                    <button type="submit" name="submitted" value="1" class="btn" style="background-color:#FFF5C2">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>