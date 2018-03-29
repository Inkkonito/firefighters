<?php 
include ('db.php');
$format = 'Y-m-d H-i-s';
$datetime = date($format);
var_dump($datetime);
$enginID = $_POST['enginID'];   
$effectifID = 1;    
$firehallID = 2;

$sql = "
    INSERT INTO intervention (datetime, firehallID) VALUES (:datetime, :firehallID)
";

$request = $pdo->prepare($sql);
$arr =[
    'datetime' => $datetime,
    'firehallID' => $firehallID,
];
$result = $request->execute($arr);

$sql2 = $pdo->query("SELECT id from intervention WHERE datetime = '{$datetime}' AND firehallID = {$firehallID}");

$row = $sql2->fetch();
$interventionID = $row['id'];
var_dump($interventionID);

$sql3 = $pdo->query("INSERT INTO intervention_effectif (interventionID, enginID, effectifID) VALUES ({$interventionID}, {$enginID}, {$effectifID})");
$sql4 = $pdo->query("SELECT * FROM intervention_effectif WHERE interventionID={$interventionID} AND enginID={$enginID} AND effectifID={$effectifID}");
print_r($sql4->fetch());

// header('Location:new_intervention.php');
