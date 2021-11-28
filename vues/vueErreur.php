<html>
<head><title>Erreur</title>
</head>

<body>

<h1>ERREUR !!!!!</h1>
<?php
if (isset($Vueerreur)) {
    foreach ($Vueerreur as $value){
        echo $value;
    }
}
?>



</body> </html>