<?php
session_start();
require("connection.php");
if ($_SESSION["ADMIN"] != 1) {
    header("Location:blog.php");
}

if (isset($_POST["submitted"])) {
    print_r($_POST);
    $blog_ad = $_POST["BLOG_AD"];
    $blog_icerik = $_POST["BLOG_ICERIK"];
    $blog_yazar = $_SESSION["AD_SOYAD"];
    $sorgu = $db->prepare("INSERT INTO `bloglar`( `BLOG_AD`, `BLOG_ICERIK`, `BLOG_YAZAR`) VALUES (:blog_ad,:blog_icerik,:yazar)");
    $sorgu->bindParam(":blog_ad", $blog_ad);
    $sorgu->bindParam(":blog_icerik", $blog_icerik);
    $sorgu->bindParam(":yazar", $blog_yazar);
    $sorgu->execute();
    header("Location:blog.php");
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
    <title>Blog Ekleme Sayfası</title>
</head>

<body class="bg-secondary">
    <?php
    require("menu.php");
    ?>
    <div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
        <div class="w-50">
            <h1 class="display-1 text-center mb-5">Blog Ekle</h1>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input id="blog_adi" name="BLOG_AD" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Blog Başlığı</label>
                        </div>
                    </div>
                </div>
                <div class="input-group my-2">
                    <div class="form-floating">
                        <textarea name="BLOG_ICERIK" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Blog İçeriği</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="blog.php" class="btn btn-danger me-2">İptal Et</a>
                    <button type="submit" name="submitted" value="1" class="btn" style="background-color:#FFF5C2">Gönder</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>