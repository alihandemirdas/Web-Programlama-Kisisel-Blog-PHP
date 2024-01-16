<?php
$hakkimda_active = "";
$blog_active = "";
$deneyim_active = "";
$ziyaret_active = "";
$current_page = basename($_SERVER['PHP_SELF']);

if ($current_page == 'index.php' || $current_page == 'hakkimda.php') {
    $hakkimda_active = "active";
} elseif ($current_page == 'blog.php') {
    $blog_active = "active";
} elseif ($current_page == 'deneyim.php') {
    $deneyim_active = "active";
} elseif ($current_page == 'ziyaret.php') {
    $ziyaret_active = "active";
}
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="./">
            <img src="./resim/web-logo.png" alt="Logo" height="30">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $hakkimda_active; ?>" href="./">Hakkımda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $blog_active; ?>" aria-current="page" href="blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $deneyim_active; ?>" href="deneyim.php">Deneyim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $ziyaret_active; ?>" href="ziyaret.php">Ziyaretçi Defteri</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <?php if (!isset($_SESSION["ADMIN"])) : ?>
                    <a class="btn m-1" style="background-color:#65B741" href="giris.php">Giriş Yap</a>
                    <a class="btn m-1" style="background-color:#FFF5C2" href="kayit.php">Kayıt Ol</a>
                <?php else : ?>
                    <img src="./resim/<?php echo $_SESSION["PROFIL_RESMI"]; ?>" alt="Profil Resmi" style="width: 30px; height: 30px; object-fit: cover;" class="rounded me-2 mt-1">
                    <a class="btn btn-danger" href="cikis.php">Çıkış Yap</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</nav>
