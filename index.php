<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Alihan Demirdaş - Computer Engineer | Software Developer</title>
    <style>
        .hakkimdaresim {
            background: url("resim/arkaplan.png");
            width: 100%;
            height: 500px;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-secondary">
    <?php require("menu.php"); ?>

    <div class="mt5"><br></div>
    <div class="container text-center mt-5">
        <img src="resim/arkaplan.png" class="img-fluid rounded-circle mb-3" style="width: 300px;" height="300px" alt="">
        <h1 class="mt-3 text-light">Hakkımda</h1>
        <div class="d-flex justify-content-center">
            <p class="text-center col-6 text-light">
                Merhaba, Necmettin Erbakan Üniversitesi Bilgisayar Mühendisliği bölümü 4.sınıf öğrencisiyim. Web ve mobil uygulama geliştirme alanlarında çalışmalar yapıyorum. 
            </p>
        </div>

        <div class="d-flex justify-content-center text-center">
            <div class="p-5" style="font-size: 30px;">
                <a href="https://www.facebook.com/alihandemirdas/" class="text-light">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
            <div class="p-5" style="font-size: 30px;">
                <a href="https://www.instagram.com/alihn/" class="text-light">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
            <div class="p-5" style="font-size: 30px;">
                <a href="https://www.linkedin.com/in/alihandemirdas/" class="text-light">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
            </div>
            <div class="p-5" style="font-size: 30px;">
                <a href="https://www.github.com/alihandemirdas/" class="text-light">
                    <i class="fa-brands fa-github"></i>
                </a>
            </div>
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

    <?php if (isset($_GET["kayit"]) && $_GET["kayit"] == "basarili") : ?>
        <script>
            alert("Kayıt Başarılı")
        </script>
    <?php endif; ?>
    

</body>

</html>