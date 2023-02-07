<?php

include "controllers/conn.php";

$queryDatabases = "SHOW DATABASES";
$res = $conn->query($queryDatabases);

$ativos = 0;
$inativos = 0;

for ($row_no = $res->num_rows; $row_no>0;$row_no--){
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
       
    $rest = substr($row['Database'], 0, 8);    
    
    if($rest=="atecs741"){
        
        $dbs = $row['Database'];            
        $query_status = "SELECT Dev_Ativado FROM $dbs.devices";
        $res_status =  $conn->query($query_status);
        
        for($ii=$res_status->num_rows;$ii>0;$ii--){
        $res_status->data_seek($ii);
        $row_status = $res_status->fetch_assoc();
        
        if ($row_status['Dev_Ativado']=="S"){
            $ativos++;
        } else {
            $inativos++;
        }
    }
}
}
        
echo "
<div id=\"sidebar\">
<div class=\"campo-logout\">
    <form>
        <a class=\"link-logout\" href=\"controllers/logout.php\"><div class=\"div-logout\">Encerrar Sessão</div></a>
    </form>
</div>
<div id=\"totalizador\">
    <h3>Totalizador:</h3><br>
    <p id=\"pAtivos\">Dispositivos Ativos: $ativos</p><br/>
    <p id=\"pInativos\">Dispositivos Inativos: $inativos</p>
</div>
</div>";

?>