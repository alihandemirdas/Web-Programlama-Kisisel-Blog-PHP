<?php
session_start();
require("connection.php");

if (isset($_GET['id']) && isset($_SESSION["ADMIN"]) && ($_SESSION["ADMIN"] == 1)) {
    $id = $_GET['id'];

    $sorgu_blog_sil = $db->prepare("DELETE FROM deneyimler WHERE ID=:id");
    $sorgu_blog_sil->bindParam(":id", $id);
    $sorgu_blog_sil->execute();

    header("Location: deneyim.php");
    exit();
} 
else if (!isset($_SESSION["ADMIN"]) || ($_SESSION["ADMIN"] == 0)){
    echo "Yetkiniz yok";
}
else {
    echo "Hatalı parametre.";
}
?>