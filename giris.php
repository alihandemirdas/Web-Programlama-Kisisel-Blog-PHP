<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Giriş Sayfası</title>
</head>

<body class="bg-secondary">
    <?php require("menu.php"); ?>
    <div class="container d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div class="bg-dark border-dark shadow rounded p-4 text-center col-6">
            <h1 class="mb-3 display-1 text-light">Giriş Yap</h1>
            <form action="giris_kontrol.php" method="POST">
                <div class="form-floating mb-3">
                    <input name="kullanici_adi" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Kullanıcı adı:</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="parola" type="password" class="form-control rounded-0 rounded-top" id="sifre" placeholder="name@example.com">
                    <label for="sifre">Parola:</label>
                    <div id="gizle" class="btn btn-light w-100 rounded-0 rounded-bottom">Parolayı Göster</div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100 mt-2 ">Giriş Yap</button>
                </div>

            </form>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $("#gizle").click(function() {
                if ($("#sifre").attr("type") == "password") {
                    $("#sifre").attr("type", "text");
                    $("#gizle").text("Parolayı Gizle");
                } else {
                    $("#sifre").attr("type", "password");
                    $("#gizle").text("Parolayı Göster");
                }
            });
        });
    </script>
</body>

</html>