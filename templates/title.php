<?php

if(isset($_SESSION['location'])){
    $location = $_SESSION['location'];
}

echo "<div id=\"title\">
<p>$location</p>
</div>
";
?>