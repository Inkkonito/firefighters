<?php include('db.php');?>
<!DOCTYPE HTML>
<html>
<head>
   <title>Create a new intervention</title>
 </head>
<body>
<?php include('nav.php'); ?>
    <form action="new_intervention_post.php" method="post">
        <div>
            <p>Create a new intervention<br>
            <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="2010-10-10"><br>
            <label for="firehallID">FirehallID requested :</label>
                <?php $request_list_firehallID = $pdo->query("SELECT id FROM firehall");
                while($row = $request_list_firehallID->fetch()){ ?>
                <input type="radio" id="firehallID" value="<?= $row['id'] ?>"><?= $row['id'] ?><?php } ?>
                <br>
            <input type="submit">
        </div> 
    </form>
</body>
</html>