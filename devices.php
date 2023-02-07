<?php

include 'templates/header.php';
$_SESSION['location'] = mb_convert_case(filter_input(INPUT_POST, 'fantasia'), MB_CASE_TITLE, 'UTF-8');
include 'templates/menu.php';
include 'templates/title.php';
    
//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------    

echo "<div id=\"content\">
<div id=\"result\">
    <div class=\"tittle-result\">
        <div id=\"tEntregador\">Entregador</div>
        <div id=\"tVersaoApp\">Versão App</div>
        <div id=\"tUltLogin\">Último Login</div>
        <div id=\"tAtivo\">Status</div>
    </div>";


include "controllers/conn.php";

$db_save = filter_input(INPUT_POST, 'db_save');
$fantasia = filter_input(INPUT_POST, 'fantasia');

$queryDevices = "SELECT Dev_CodEntregador,Ent_Nome,Dev_VersaoApp,Dev_UltimoLogin,Dev_Ativado FROM " .$db_save. ".devices AS dev INNER JOIN ".$db_save.".entregadores AS ent
ON ent.Ent_Codigo = Dev_CodEntregador ORDER BY Ent_Nome";

$res = $conn->query($queryDevices);

for ($row_no = $res->num_rows; $row_no>0;$row_no--){
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();   

    $codEnt = $row['Dev_CodEntregador'];
    $nomeEnt = mb_convert_case($row['Ent_Nome'], MB_CASE_TITLE,'UTF-8');
    $appVersao = $row['Dev_VersaoApp'];
    $ultLogin = date('d/m/Y - H:i',  strtotime($row['Dev_UltimoLogin']));
    $devAtivo = ($row['Dev_Ativado']=='S') ? "Ativo" : "Não Ativo";


echo "<div class=\"list-result\">
<div class=\"device-cell\" id=\"nomeEnt\">" . $nomeEnt . "</div>
<div class=\"device-cell\" id=\"appVersao\">" . $appVersao . "</div>
<div class=\"device-cell\" id=\"ultLogin\">" . $ultLogin . "</div>
<div class=\"device-cell\" id=\"devAtivo\">" . $devAtivo . "</div>
<div class=\"device-cell\" id=\"deviceInfo\">
<form action=\"verDevice.php\" method=\"POST\">
        <input type=\"hidden\" name=\"db_save\" value=" .$db_save. ">
        <input type=\"hidden\" name=\"fantasia\" value=\"$fantasia\">
        <input type=\"hidden\" name=\"codEnt\" value=\"$codEnt\">
        <input type=\"hidden\" name=\"nomeEnt\" value=\"$nomeEnt\">
    <button class=\"viewDevices\" type=\"submit\">Ver</button>
</form>                    
</div>
</div>";}

echo "
<form action=\"empresas.php\" method=\"POST\">
    <button type=\"submit\" id=\"botaoVoltar\"><img src=\"templates\img\icons\back-button.png\"></button>
</form>";


$conn->close();

echo "</div></div>";

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

include 'templates/sidebar.php';
include 'templates/footer.php';