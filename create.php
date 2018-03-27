<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Creating data for french firefighters activities</title>
 </head>
<body>
    <form action="create_post.php" method="post">
        <p>Créer un effectif<br>
        <label for="lastname">Lastname :</label><input type="text" name="lastname" id="lastname"><br>
        <label for="Firstname">Firstname :</label><input type="text" name="firstname" id="firstname"><br>
        <label for="Rank IK">Rank ID :</label><input type="text" name="rankID" id="rankID"><br>
        <label for="Town">Town :</label>
        <select name="firehallID" id="firehallID">
            <?php $request_towns = $pdo->query("SELECT id, town from firehall");
            while($row = $request_towns->fetch()){ var_dump($row); ?>
                <option value="<?= $row['id'] ?>"><?= $row['town'] ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit">
    </form>
    <hr>
    <?php $request_effectif = $pdo->query("
        SELECT effectif.id, effectif.firstname, effectif.lastname, rank.sectionID, rank.name, firehall.town FROM effectif
        INNER JOIN rank ON rank.id = effectif.rankID
        INNER JOIN firehall ON effectif.firehallID = firehall.id
    "); ?>
    <table>
        <thead>
            <caption>Liste des effectifs</caption>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Section Name</th>
                <th>Rank Name</th>
                <th>Town</th>

            </tr>
        <tbody>
            <?php while($row = $request_effectif->fetch()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['firstname'] ?></td>
                    <td><?= $row['lastname'] ?></td>           
                    <td><?= $row['sectionID'] ?></td>           
                    <td><?= $row['name'] ?></td>           
                    <td><?= $row['town'] ?></td>           
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>