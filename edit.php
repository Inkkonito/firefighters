<?php
include_once("db.php");

if(isset($_POST['update']))
{	
	$departementID = $_POST['departementID'];
	$size=$_POST['size'];
	$name=$_POST['name'];

	if(empty($size) || empty($name)) {	
			
		if(empty($size)) {
			echo "<font color='red'>Size field is empty.</font><br/>";
		}
		
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
				
	} else {	
		$sql = "UPDATE sdis SET size=:size, name=:name WHERE departementID=:departementID";
		$request = $pdo->prepare($sql);				
		$request->bindparam(':departementID', $departementID);
		$request->bindparam(':size', $size);
		$request->bindparam(':name', $name);
		$request->execute();
		
	   header("Location: index.php");
	}
}
?>
<?php

$departementID = $_GET['departementID'];

$sql = "SELECT * FROM sdis WHERE departementID=:departementID";
$request = $pdo->prepare($sql);
$request->execute(array(':departementID' => $departementID));

while($row = $request->fetch(PDO::FETCH_ASSOC))
{
	$size = $row['size'];
	$name = $row['name'];
}
?>
<html>
<head> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>	
	<title>Edit Data</title>
</head>

<body>
<?php include('nav.php'); ?>
<form method="post" action="edit.php">
    <input type="text" id="size" name="size" value="<?php echo $size; ?>">
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <input type="submit" name="update" value="Update">
</form>
</body>
</html>
