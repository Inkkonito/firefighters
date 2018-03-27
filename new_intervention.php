<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create a new intervention</title>
 </head>
<body>
    <ul>Navigation :
        <li><a href="index.php">Index</a></li>
    </ul>
    <form action="create_post.php" method="post">
        <div>
            <p>Create a new intervention<br>
            <label for="lastname">Date:</label><br>
            
            <label for="firemen_requested">Firemen requested :</label>
            <?php $request_firemen_requested = $pdo->query("SELECT id, lastname from effectif");
            while($row = $request_firemen_requested->fetch()){ ?>
            <input type="checkbox" id="firemen_requested" value="<?= $row['id'] ?>"><?= $row['lastname'] ?> <?php } ?>
            <br>
            <label for="engins_requested">Engins requested :</label>
            <?php $request_engins_requested = $pdo->query("SELECT engin.id, engin.matricule, engin_modele.name, firehall.town FROM engin INNER JOIN engin_modele ON engin.id = engin_modele.id INNER JOIN firehall ON engin.id = firehall.id");
            while($row = $request_engins_requested->fetch()){ ?>
            <input type="radio" id="engins_requested" value="<?= $row['id'] ?>"><?= $row['matricule'] ?>(<?= $row['name']  ?> - <?= $row['town']  ?>)
            <?php } ?>
            <br>
            <input type="submit">
        </div> 
    </form>
</body>
</html>