<h1>Comptador de visites</h1>


<?php

include("dbconnect.php");


$sql = "UPDATE m8 SET visites=visites+1 WHERE id=1";
$conn->query($sql) === TRUE;


$sql = "SELECT visites FROM m8 WHERE id=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "Visites de la web: " . $row['visites'];

?>