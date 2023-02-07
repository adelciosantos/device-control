<?php

include 'templates/header.php';
$_SESSION['location'] = mb_convert_case(filter_input(INPUT_POST, 'fantasia'), MB_CASE_TITLE, 'UTF-8') . " > " . filter_input(INPUT_POST, 'nomeEnt');
include 'templates/menu.php';
include 'templates/title.php';

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

include "controllers/conn.php";
    
echo "<div id=\"content\">
<div id=\"result\">";

$db_save = filter_input(INPUT_POST, 'db_save');
$fantasia = filter_input(INPUT_POST, 'fantasia');
$codEnt = filter_input(INPUT_POST, 'codEnt');

$queryDevices = "select * from " .$db_save. ".entregadores as ent
inner join " .$db_save. ".devices as dev
on ent.Ent_Codigo = dev.Dev_CodEntregador
where Ent_Codigo = $codEnt";

$res = $conn->query($queryDevices);
$dados = $res->fetch_assoc();

    $devNomeEnt = mb_convert_case($dados['Ent_Nome'], MB_CASE_TITLE,'UTF-8');
    $devUUID = $dados['Dev_UUID'];
    $devSerial = $dados['Dev_Serial'];
    $devAtivacao = date('d/m/Y',  strtotime($dados['Dev_DataAtivacao']));
    $devPlataforma = $dados['Dev_Plataforma'];
    $devVersaoOS = $dados['Dev_VersaoOS'];
    $devModelo = $dados['Dev_Modelo'];
    $devMarca = $dados['Dev_Marca'];
    $devVersaoApp = $dados['Dev_VersaoApp'];
    $devUltLogin = date('d/m/Y - H:i',  strtotime($dados['Dev_UltimoLogin']));
    $devAtivo = ($dados['Dev_Ativado']=='S') ? "Ativo" : "Não Ativo";
    $devColor = ($dados['Dev_Ativado']=='S') ? "#CA6048" : "#42FF51";
    
    
    $conn->close();

    
echo "                    <fieldset class=\"dadosDevice\">
                        <div id=\"grupo1\">
                            <div id=\"campoEntregador\">
                                <label for=\"entregador\">Entregador:</label>
                                <input name=\"entregador\" id=\"entregador\" type=\"text\" readonly=\"true\" value=\"$devNomeEnt\"><br>
                            </div>
                            <div id=\"campoAtivacao\">
                                <label for=\"ativacao\">Data de Ativação:</label>
                                <input name=\"ativacao\" id=\"ativacao\" type=\"text\" readonly=\"true\" value=\"$devAtivacao\"><br>
                            </div>
                        </div>
                        <div id=\"grupo2\">
                            <div id=\"campoUUID\">
                                <label for=\"uuid\">UUID:</label>
                                <input name=\"uuid\" id=\"uuid\" type=\"text\" readonly=\"true\" value=\"$devUUID\"><br>
                            </div>
                            <div id=\"campoUltLogin\">
                                <label for=\"ultLogin\">Online pela última vez em:</label>
                                <input name=\"ultLogin\" id=\"ultLogin\" type=\"text\" readonly=\"true\" value=\"$devUltLogin\"><br>
                            </div>
                        </div>
                        <div id=\"grupo3\">
                            <div id=\"campoPlat\">
                                <label for=\"plat\">Plataforma:</label>
                                <input name=\"plat\" id=\"plat\" type=\"text\" readonly=\"true\" value=\"$devPlataforma - $devVersaoOS\"><br>
                            </div>
                            <div id=\"campoModelo\">
                                <label for=\"devModelo\">Marca e Modelo:</label>
                                <input name=\"devModelo\" id=\"devModelo\" type=\"text\" readonly=\"true\" value=\"$devMarca - $devModelo\"><br>
                            </div>
                        </div>
                        <div id=\"grupo4\">
                            <div id=\"campoApp\">
                                <label for=\"app\">Versão App:</label>
                                <input name=\"app\" id=\"app\" type=\"text\" readonly=\"true\" value=\"$devVersaoApp\"><br>
                            </div>
                            <div id=\"campoStatus\">
                                <label for=\"status\">Liberação:</label>
                                <form action=\"altera_status.php\" method=\"post\">
                                    <input type=\"hidden\" name=\"codEnt\" value=\"$codEnt\">
                                    <input type=\"hidden\" name=\"entregador\" value=\"$devNomeEnt\">
                                    <input type=\"hidden\" name=\"db_save\" value=\"$db_save\">
                                    <input type=\"hidden\" name=\"fantasia\" value=\"$fantasia\">
                                    <select name=\"status\" class=\"select-status\"><style>.select-status{background: $devColor;}</style>
                                        <option class=\"op_ativo\" value=\"S\" "; if($dados['Dev_Ativado']=='S'){echo "selected=\"selected\"";} echo ">Ativado</option>";
                                    echo "<option class=\"op_inativo\" value=\"N\"";  if($dados['Dev_Ativado']=='N'){echo "selected=\"selected\"";} echo ">Não Ativado</option>";
                           echo "   </select><br>
                            </div>
                            <div id=\"grupo5\">
                                    <button type=\"submit\" id=\"botaoAltera\">Enviar</button>
                                </form>
                                <form action=\"devices.php\" method=\"POST\">
                                    <button type=\"submit\" id=\"botaoVoltar\"><img src=\"templates\img\icons\back-button.png\"></button>
                                    <input type=\"hidden\" name=\"db_save\" value=\"$db_save\">
                                    <input type=\"hidden\" name=\"fantasia\" value=\"$fantasia\">
                                </form>
                            </div>
                        </div>
                    </fieldset>";
                    
echo "</div>
</div>";

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------
 
include 'templates/sidebar.php';
include 'templates/footer.php';