<?php

include 'templates/header.php';
$_SESSION['location'] = "Empresas";
include 'templates/menu.php';
include 'templates/title.php';

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

echo "<div id=\"content\">
<div id=\"result\">
<div class=\"tittle-result\">
    <div id=\"tFantasia\">Nome Fantasia</div>
    <div id=\"tRsocial\">Razão Social</div>
    <div id=\"tAtivos\">Ativos</div>
</div>";

include "controllers/conn.php";

$queryDatabases = "SHOW DATABASES";

$res = $conn->query($queryDatabases);

for ($row_no = $res->num_rows; $row_no>0;$row_no--){
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
       
    $rest = substr($row['Database'], 0, 8);    
    
    if($rest=="atecs741"){
        $dbs = $row['Database'];
    
    
        $query_nfantasia = "SELECT Emp_NomeFantasia,Emp_RazaoSocial FROM $dbs.empresa";
        $res_nfantasia =  $conn->query($query_nfantasia);
        $res_nfantasia->data_seek(0);
        $row_status = $res_nfantasia->fetch_assoc();
        $fantasia[] = $row_status['Emp_NomeFantasia'];
        $fantasia2[] = mb_convert_case($row_status['Emp_NomeFantasia'],MB_CASE_TITLE,'UTF-8');
        $razaoSocial[$row_status['Emp_NomeFantasia']] = mb_convert_case($row_status['Emp_RazaoSocial'],MB_CASE_TITLE,'UTF-8');
        $db_save[$row_status['Emp_NomeFantasia']] = $row['Database'];
        
        $query2 = "SELECT COUNT(*) FROM $dbs.devices WHERE Dev_Ativado = \"S\"";
        $res_query2 =  $conn->query($query2);
        $res_query2->data_seek(0);
        $row3 = $res_query2->fetch_row();
        $ativos[$row_status['Emp_NomeFantasia']] = $row3[0];
        
        }
}    
    
sort($fantasia2);
sort($fantasia);

for($a=0;$a<sizeof($fantasia);$a++) {
    echo "                        <div class=\"list-result\">
                            <div class=\"empresa-cell\" id=\"fantasia\">" . "$fantasia2[$a]" ."</div>
                            <div class=\"empresa-cell\" id=\"razao\">" . $razaoSocial[$fantasia[$a]] . "</div>
                            <div class=\"empresa-cell\" id=\"ativos\">" . $ativos[$fantasia[$a]] . "</div>
                            <div class=\"empresa-cell\" id=\"devices\">
                                <form action=\"devices.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"db_save\" value=" . $db_save[$fantasia[$a]] . ">
                                    <input type=\"hidden\" name=\"fantasia\" value=\"$fantasia[$a]\">
                                    <button class=\"viewDevices\" type=\"submit\">Dispositivos</button>
                                </form>                    
                            </div>
                        </div>
";
}

echo "</div></div>";

$conn->close();

//--------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

include 'templates/sidebar.php';
include 'templates/footer.php';