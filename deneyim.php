<?php
session_start();
require("connection.php");

$sorgu = $db->prepare("SELECT deneyimler.*, sirketler.SIRKET_AD 
                      FROM deneyimler 
                      INNER JOIN sirketler ON deneyimler.SIRKET_ID = sirketler.ID");
$sorgu->execute();
$deneyimler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/deneyim.css">
    <title>Deneyim Sayfası</title>
</head>

<body class="bg-secondary">
    <?php require("menu.php") ?>

    <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == 1) : ?>
        <div class="d-flex justify-content-center">
            <a href="deneyim_ekle.php" class="btn" style="background-color:#FFF5C2">
                Deneyim Ekle
            </a>
        </div>
    <?php endif; ?>

    <section class="mt-5" id="resume">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-15px-tb">
                    <div class="resume-box bg-dark text-light">
                        <ul>
                            <?php foreach ($deneyimler as $deneyim) : ?>
                                <div class="row p-4">
                                    <div class="col-10">
                                        <li>
                                            <div class="icon">
                                                <i class="fas fa-user-graduate" style="color: black;"></i>
                                            </div>
                                            <span class="time"><?php echo $deneyim["BASLANGIC_TARIHI"]; ?> - <?php echo $deneyim["BITIS_TARIHI"]; ?></span>
                                            <h5 style="color: #52a6ff;"><?php echo $deneyim["SIRKET_AD"]; ?></h5>
                                            <p><?php echo $deneyim["DENEYIM_ICERIK"]; ?></p>
                                        </li>
                                    </div>
                                    <div class="col-2">
                                        <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == 1) : ?>
                                            <div class="d-flex justify-content-end">
                                                <a href="deneyim_sil.php?id=<?php echo $deneyim["ID"]; ?>" class="btn btn-danger me-1">
                                                    Sil
                                                </a>
                                                <a href="deneyim_guncelle.php?id=<?php echo $deneyim["ID"]; ?>" class="btn" style="background-color:#FFF5C2">
                                                    Güncelle
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>