<?php
session_start();
require("connection.php");
$id = $_GET["id"];
$sorgu = $db->prepare("SELECT * FROM bloglar WHERE BLOG_ID=:id");
$sorgu->bindParam(":id", $id);
$sorgu->execute();
$blog = $sorgu->fetch(PDO::FETCH_ASSOC);

$sorgu_yorum = $db->prepare("SELECT yorumlar.*, kullanicilar.PROFIL_RESMI, kullanicilar.AD_SOYAD
                              FROM yorumlar 
                              LEFT JOIN kullanicilar ON yorumlar.YORUM_AD = kullanicilar.AD_SOYAD
                              WHERE BLOG_ID=:blog_id
                              ORDER BY yorumlar.TARIH DESC");
$sorgu_yorum->bindParam(":blog_id", $id);
$sorgu_yorum->execute();
$yorumlar = $sorgu_yorum->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Blog Detay Sayfası</title>
</head>

<body class="bg-secondary">
    <?php require("menu.php"); ?>

    <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == 1) : ?>
        <div class="d-flex justify-content-center ">
            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $blog['BLOG_ID']; ?>)" class="btn btn-danger me-2">
                Sil
            </a>
            <a href="blog_guncelle.php?id=<?php echo $blog['BLOG_ID']; ?>" class="btn" style="background-color:#FFF5C2">
                Güncelle
            </a>
        </div>
    <?php endif; ?>

    <div class="container border-dark text-light shadow rounded bg-dark p-3 mt-5">
        <h1 class="display-3 text-center mb-2 mt-3">
            <?php echo $blog["BLOG_AD"]; ?>
        </h1>
        <hr class="hr" />
        <p class="mt-4 mb-5">
            <?php echo $blog["BLOG_ICERIK"]; ?>
        </p>
        <hr class="hr" />
        <div class="d-flex justify-content-between">
            <div>
                <span class="fw-bold">Yazar:</span> <?php echo $blog["BLOG_YAZAR"]; ?>
            </div>
            <div>
                <span class="fw-bold">Blog Tarihi:</span>
                <?php
                $tarih = date("d.m.Y - h:i", strtotime($blog["BLOG_TARIH"]));
                ?>
                <span><?php echo $tarih; ?></span>
            </div>

        </div>

    </div>

    <div class="container shadow bg-dark rounded text-dark mt-5 p-4">
        <h3 class="text-light mb-3">Yorumlar</h3>
        <?php foreach ($yorumlar as $yorum) : ?>
            <div class="card bg-light text-dark border-0 mt-3 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <img class="img-fluid rounded" src="./resim/<?php echo $yorum["PROFIL_RESMI"]; ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                            <h3>
                                <?php echo $yorum["YORUM_AD"]; ?>
                            </h3>
                            <hr>
                            <p class="text-break">
                                <?php echo $yorum["YORUM"]; ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <?php
                        $tarih = date("d.m.Y - h:i", strtotime($yorum["TARIH"]));
                        ?>
                        <span><?php echo $tarih; ?></span>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!isset($_SESSION["ADMIN"])) : ?>

        <div class="container shadow bg-dark rounded mt-2 p-0 text-light border-dark mb-5 mt-3 p-4">
            <span class="">Yorum yapmak için giriş yapmanız gerekmektedir.</span>
        </div>

    <?php else : ?>

        <form action="yorum_ekle.php" method="POST">
            <div class="container shadow bg-dark rounded mt-2 p-0 text-light border-dark mb-5 mt-3">

                <div class="p-5">
                    <div>
                        <h3 class="text-light">Yorum Yap</h3>
                        
                        <div>
                            <span class="fw-bold"><?php echo $_SESSION["AD_SOYAD"] ?></span>
                            <span class=""> olarak yorum yapıyorsunuz.</span>
                        </div>
                        <div class="input-group my-2">
                            <textarea class="form-control" name="yorum" id="" cols="30" rows="3" placeholder="Yorum"></textarea>
                        </div>

                    </div>
                </div>

                <div>
                    <input type="hidden" name="adsoyad" value="<?php echo $_SESSION["AD_SOYAD"] ?>">
                    <button type="submit" name="blog_id" value="<?php echo $blog["BLOG_ID"] ?>" class="btn w-100 rounded-0 rounded-bottom" style="background-color:#FFF5C2">Yorum Ekle</button>
                </div>
            </div>

        </form>
    
    <?php endif; ?>
    <script>
        function confirmDelete(blogID) {
            var r = confirm("Bu blogu silmek istediğinizden emin misiniz?");
            if (r == true) {
                window.location.href = "blog_sil.php?id=" + blogID;
            }
        }
    </script>
</body>

</html>