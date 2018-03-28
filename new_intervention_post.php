<?php 
include ('db.php');

define ('MYSQL_DATE_FORMAT', 'Y-m-d');

$date = $_POST['date'];
$firehallID = $_POST['firehallID'];

$request = $pdo->prepare('INSERT INTO intervention(date, firehallID) VALUES(:date, :firehallID)');

$request->execute(array(
	'date' => $date,
	'firehallID' => $firehallID,
    ));

header('Location:new_intervention.php');

?>