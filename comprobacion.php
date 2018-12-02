<?php
    if(!isset($_COOKIE['rut'])){
        header("Location: /login.php");
        die();
    }
    
?>