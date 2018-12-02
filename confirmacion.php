<?php
if (isset($_POST['medico'])) {

    setcookie("rut", $_POST["rut"]);
    setcookie("tipo", "medico");
} else if (isset($_POST['paciente'])) {

    setcookie("rut", $_POST["rut"]);
    setcookie("tipo", "paciente");
}
header("Location: /index.php");
die();
?>