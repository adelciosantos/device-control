<?php

    include 'templates/header.php';
    include 'templates/menu.php';
    include 'templates/title.php';
    
//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

    echo "<div id=\"content\">
            <div id=\"result\">";

    include "controllers/conn.php";
    
    //$codEnt = $_POST['codEnt'];
    //$status = $_POST['status'];
    //$db_save = $_POST['db_save'];
    //$fantasia = $_POST['fantasia'];
    //$entregador = $_POST['entregador'];
    
    $codEnt = filter_input(INPUT_POST, 'codEnt');
    $status = filter_input(INPUT_POST, 'status');
    $db_save = filter_input(INPUT_POST, 'db_save');
    $fantasia = filter_input(INPUT_POST, 'fantasia');
    $entregador = filter_input(INPUT_POST, 'entregador');    

    $query = "update " .$db_save. ".devices
    set Dev_Ativado = '" .$status. "'
    where Dev_CodEntregador = " .$codEnt. "";

    $res = $conn->query($query);

    $conn->close();

    if($status == 'S'){
        echo "<p id=\"result-msg\">Dispositivo ATIVADO com sucesso para $entregador.</p>";
    } else {
        echo "<p id=\"result-msg\">Dispositivo de $entregador DESATIVADO com sucesso!</p>";
    }
    
    echo "
        <form action=\"devices.php\" method=\"POST\">
            <button type=\"submit\" id=\"botaoVoltar\"><img src=\"templates\img\icons\back-button.png\"></button>
            <input type=\"hidden\" name=\"db_save\" value=\"$db_save\">
            <input type=\"hidden\" name=\"fantasia\" value=\"$fantasia\">
        </form>";
//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------
    
    echo "</div>
    </div>";

    include 'templates/sidebar.php';
    include 'templates/footer.php';