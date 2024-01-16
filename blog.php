<?php
session_start();
require("connection.php");
$sorgu = $db->prepare("SELECT * FROM bloglar ORDER BY BLOG_TARIH DESC");
$sorgu->execute();
$bloglar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

$blog_renk = "dark";

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/deneyim.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Blog Sayfası</title>
</head>

<body class="bg-secondary">
    <?php require("menu.php"); ?>
    <div class="container">
        <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == 1) : ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="blog_ekle.php" class="btn" style="background-color:#FFF5C2">
                    Blog Ekle
                </a>
            </div>
        <?php endif; ?>
        <div class="row mt-5">
            <?php foreach ($bloglar as $blog) : ?>
                <div class="col-lg-12 my-3">
                    <div class="mx-3 shadow">
                        <div class="card bg-<?php echo $blog_renk; ?> text-light p-5 border-0 rounded-0 rounded-top">
                            <div class="text-start">
                                <h1>
                                    <?php echo $blog["BLOG_AD"]; ?>
                                </h1>
                                <div class="d-flex justify-content-between">
                                    <div class="fw-semibold">Yazar : <?php echo $blog["BLOG_YAZAR"]; ?></div>
                                    <div class="fw-semibold">
                                        <?php
                                        $tarih = date("d.m.Y - h:i", strtotime($blog["BLOG_TARIH"]));
                                        ?>
                                        <?php echo $tarih ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="blog_detay.php?id=<?php echo $blog["BLOG_ID"] ?>" class="btn rounded-0 rounded-bottom w-100" style="background-color:#FFF5C2">Detaylı Oku</a>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>
        </div>

    </div>
    <?php if (isset($_GET["giris"]) && $_GET["giris"] == "basarili") : ?>
        <script>
            alert("Giriş Başarılı")
        </script>
    <?php elseif (isset($_GET["giris"]) && $_GET["giris"] == "basarisiz") : ?>
        <script>
            alert("Giriş Başarısız")
        </script>
    <?php endif; ?>
</body>

</html>