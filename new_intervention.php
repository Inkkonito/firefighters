<?php include('db.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
   <title>Create a new intervention</title>
 </head>
<body>
<?php 
include('nav.php'); ?>
    <form action="new_intervention_post.php" method="post">
            <p>
                <label for="date">Date:</label>
                <input type="date" name="datetime" id="date" value="2010-10-10 10:10:10">
            </p>
            <p>
                <label for="firehallID">Engin requested :</label>
                <select name="firehallID" id="firehallID">
                    <?php $request_list_engin_matricule = $pdo->query("SELECT firehall.id, firehall.town from firehall");
                    while($row = $request_list_engin_matricule->fetch()){ ?>
                        <option value="<?= $row['id'] ?>"><?= $row['town'] ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <input type="hidden" name="interventionID" value="">
                <input type="submit">
            </p> 
    </form>
</body>
</html>