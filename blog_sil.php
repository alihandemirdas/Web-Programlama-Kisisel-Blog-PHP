<?php
session_start();
require("connection.php");

if (isset($_GET['id']) && isset($_SESSION["ADMIN"]) && ($_SESSION["ADMIN"] == 1)) {
    $id = $_GET['id'];

    $sorgu_blog_sil = $db->prepare("DELETE FROM bloglar WHERE BLOG_ID=:id");
    $sorgu_blog_sil->bindParam(":id", $id);
    $sorgu_blog_sil->execute();

    $sorgu_yorum_sil = $db->prepare("DELETE FROM yorumlar WHERE BLOG_ID=:id");
    $sorgu_yorum_sil->bindParam(":id", $id);
    $sorgu_yorum_sil->execute();

    header("Location: blog.php");
    exit();
} 
else if (!isset($_SESSION["ADMIN"]) || ($_SESSION["ADMIN"] == 0)){
    echo "Yetkiniz yok";
}

else {
    echo "Hatalı parametre.";
}
?>