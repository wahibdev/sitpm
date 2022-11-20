<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shop2mar_gs_pause', 'shop2mar_admin_pause', '5!Kd2K=GCzf&');
    $pdo->exec("set names utf8");
   }
   catch (PDOException $e) {
    echo "<p>Erreur: ".$e->getMessage() ;
    die() ;
   }
?>
