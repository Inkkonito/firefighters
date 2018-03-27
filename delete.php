<?php
include("db.php");
 
$departementID = $_GET['departementID'];
 
$sql = "DELETE FROM sdis WHERE departementID=:departementID";
$request = $pdo->prepare($sql);
$request->execute(array(':departementID' => $departementID));
 
header("Location:index.php");
?>