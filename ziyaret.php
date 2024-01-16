<?php
session_start();
require("connection.php");
$sorgu = $db->prepare("SELECT ziyaretciler.*, kullanicilar.AD_SOYAD AS ZIYARET_AD_SOYAD, kullanicilar.PROFIL_RESMI
                      FROM ziyaretciler 
                      LEFT JOIN kullanicilar ON ziyaretciler.KULLANICI_ID = kullanicilar.ID");
$sorgu->execute();
$ziyaretler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Ziyaretçi Defteri Sayfası</title>
</head>

<body class="bg-secondary">
    <?php require("menu.php"); ?>

    <?php if (!isset($_SESSION["ADMIN"])) : ?>

        <div class="container shadow bg-dark rounded border-dark mt-5 p-3 mb-5">
            <h3 class="text-light mb-1">Ziyaretçi Defteri</h3>
            <hr class="hr" style="color: white"></hr>
            <div class="card bg-dark bg-gradient text-light border-0 p-4 my-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3>
                                    Bu sayfayı görüntüleyebilmek ve yorum yapabilmek için giriş yapmanız gerekmektedir.
                                </h3>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    <?php else : ?>
        <div class="d-flex justify-content-center mb-3">
            <a href="ziyaret_ekle.php?ad=<?php echo $_SESSION["AD_SOYAD"]; ?>" class="btn" style="background-color:#FFF5C2">
                Mesaj Bırak
            </a>
        </div>

        <div class="container shadow bg-dark rounded border-dark mt-2 p-4 mb-5">
                <h3 class="text-light">Ziyaretçi Defteri</h3>
                <hr class="hr" style="color: white"></hr>
                <?php foreach ($ziyaretler as $ziyaret) : ?>
                    <div class="card bg-dark bg-gradient text-light border-0 p-4 my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <img class="img-fluid rounded" src="./resim/<?php echo $ziyaret["PROFIL_RESMI"]; ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                    <h3>
                                            <?php echo $ziyaret["ZIYARET_AD_SOYAD"]; ?>
                                        </h3>
                                        <p class="text-break">
                                            <?php echo $ziyaret["MESAJ"]; ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <?php
                                $tarih = date("d.m.Y - h:i", strtotime($ziyaret["TARIH"]));
                                ?>
                                <span><?php echo $tarih; ?></span>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
        </div>
    <?php endif; ?>

    
</body>

</html>