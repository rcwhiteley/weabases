<body>
<div id='cssmenu'>
    <ul>
        <li id="perfil"><a href='/index.php'>Paciente</a></li>
        <li id="atenciones"><a href='/atenciones.php'>Atenciones</a></li>
        <?php
            if($_COOKIE["tipo"] == "paciente"){
                echo'
                <li id="recetas"><a href="/receta.php">Recetas</a></li>
                <li id="licencias"><a href="/licencias.php">Licencias</a></li>';
            }
        ?>
        
        <li id="logout"><a href='/logout.php'>Cerrar sesión</a></li>
    </ul>
    
</div>
<?php

include 'comprobacion.php';
?>