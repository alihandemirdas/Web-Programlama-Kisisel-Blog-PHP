<?php 
    try{
        $db = new PDO("mysql:host=localhost:8111;dbname=blog_sitesi;charset=utf8","root","12345678");
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

?>
