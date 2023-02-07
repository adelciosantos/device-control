<?php

include 'templates/header.php';
$_SESSION['location'] = "Página Inicial";
include 'templates/menu.php';
include 'templates/title.php';

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

echo "<div id=\"content\">";
    /* Aqui na tela inicial seria incluido uma dashboard para visualizar a quantidade de dispositivos ativos e inativos,
    entre outras informações. */
echo "</div>";

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------
        
include 'templates/sidebar.php';
include 'templates/footer.php';