<?php 
$cookie_name = 'pontikis_net_php_cookie';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie("rut", '', time() - 3600);
header("Location: /login.php");
        die();
?>