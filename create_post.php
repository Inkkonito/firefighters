<?php 
include ('db.php');
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$rankID = $_POST['rankID'];
$firehallID = $_POST['firehallID'];

$request = $pdo->prepare('INSERT INTO effectif(lastname, firstname, rankID, firehallID) VALUES(:lastname, :firstname, :rankID, :firehallID)');
$request->execute(array(
	'lastname' => $lastname,
	'firstname' => $firstname,
	'rankID' => $rankID,
	'firehallID' => $firehallID,
	));

echo 'Effectif ajouté !';
header('Location:create.php')
?>

