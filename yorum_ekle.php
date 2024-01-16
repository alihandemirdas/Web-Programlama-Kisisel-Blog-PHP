<?php 
    require("connection.php");
    print_r($_POST);
    $ad = $_POST["adsoyad"];
    $yorum = $_POST["yorum"];
    $blog_id = $_POST["blog_id"];
    $sorgu = $db->prepare("INSERT INTO yorumlar (BLOG_ID,YORUM_AD,YORUM) VALUES (:id,:ad,:yorum)");
    $sorgu->bindParam(":id",$blog_id);
    $sorgu->bindParam(":ad",$ad);
    $sorgu->bindParam(":yorum",$yorum);
    $sorgu->execute();
    header("Location:blog_detay.php?id=$blog_id");
?>