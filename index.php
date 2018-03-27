<?php include('db.php');?>
<!DOCTYPE HTML>
<html>
<head>
<title>Analysing french firefighters activities</title>
</head>
<body>
    <p>
    <ul>Navigation :
        <li><a href="create.php">Create a fireman</a></li>
        <li><a href="intervention.php">Liste des interventions</a></li>
    </ul>
    </p>
<hr>
<!-- -->
<!-- 1er tableau : Liste des sdis --> 
<!-- -->
    <?php $request_sdis = $pdo->query('SELECT departementID, size, name FROM sdis'); ?>
    <table>
        <thead>
            <caption>Liste des SDIS</caption>
            <tr>
                <th>SDIS</th>
                <th>Size</th>
                <th>Name</th>
                
            </tr>
        <tbody>
            <?php while($row = $request_sdis->fetch()) { ?>
                <tr>
                    <td><?= $row['departementID'] ?></td>
                    <td><?= $row['size'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><a href="edit.php?departementID=<?= $row['departementID'] ?>">Edit</a> | <a href="delete.php?departementID=<?= $row['departementID'] ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>
<!-- -->
<!-- 2ème tableau : Liste des groupements --> 
<!-- -->
    <?php $request_groupement = $pdo->query('SELECT groupement.id, groupement.sdisID, groupement.name, firehall.town FROM groupement INNER JOIN firehall ON groupement.id = firehall.id'); ?>
     <table>
        <thead>
            <caption>Liste des groupements</caption>
            <tr>
                <th>ID</th>
                <th>SDIS</th>
                <th>Name</th>              
                <th>Owner</th>              
            </tr>
        <tbody>
            <?php while($row = $request_groupement->fetch()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['sdisID'] ?></td>
                    <td><?= $row['name'] ?></td>                    
                    <td><?= $row['town'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>
<!-- -->
<!-- 3ème tableau : Liste des casernes --> 
<!-- -->
    <?php $request_firehall = $pdo->query("
        SELECT firehall.id, groupement.name, groupement.sdisID, firehall.size, firehall.town, firehall.cp 
        FROM firehall 
        INNER JOIN groupement ON firehall.id = groupement.id
    "); ?>
    <table>
        <thead>
            <caption>Liste des casernes</caption>
            <tr>
                <th>ID</th>
                <th>SDIS</th>              
                <th>Groupement</th>
                <th>Size</th>              
                <th>Town</th>              
                <th>CP</th>              
            </tr>
        <tbody>
            <?php while($row = $request_firehall->fetch()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['sdisID'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['size'] ?></td>                    
                    <td><?= $row['town'] ?></td>                    
                    <td><?= $row['cp'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>
<!-- -->
<!-- 4ème tableau : Liste des effectifs --> 
<!-- -->
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
                <th>Section</th>
                <th>Rank</th>
                <th>Firehall</th>
                
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
<hr>
<!-- -->
<!-- 5ème tableau : Liste des grades --> 
<!-- -->
    <?php $request_ranks = $pdo->query(" 
        SELECT TotalRankID.rankid, TotalRankID.rankname, TotalRankID.ranksectionid, COUNT(TotalRankID.effectifID) AS nbr
        FROM (SELECT rank.id AS rankid, rank.name AS rankname, rank.sectionid AS ranksectionid, effectif.id AS effectifid FROM rank LEFT OUTER JOIN effectif ON rank.id = effectif.rankID) AS TotalRankID GROUP BY TotalRankID.rankid"); ?>
    <table>
        <thead>
            <caption>Liste des grades</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>              
                <th>Section</th>              
                <th>Total</th>              
            </tr>
        <tbody>
            <?php while($row = $request_ranks->fetch()) { ?>
                <tr>
                    <td><?= $row['rankid'] ?></td>
                    <td><?= $row['rankname'] ?></td>                    
                    <td><?= $row['ranksectionid'] ?></td>                    
                    <td><?= $row['nbr'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>
<!-- -->
<!-- 6ème tableau : Liste des engins --> 
<!-- -->
    <?php $request_engins = $pdo->query("
        SELECT engin.id, engin_modele.familyID, engin_modele.name,firehall.town, engin.matricule FROM engin
        INNER JOIN engin_modele ON engin.id = engin_modele.id
        INNER JOIN firehall ON engin.firehallID = firehall.id
    "); ?>
     <table>
        <thead>
            <caption>Liste des engins</caption>
            <tr>
                <th>ID</th>
                <th>Family</th>
                <th>Vehicle</th>
                <th>Firehall</th>              
                <th>Matricule</th>              
            </tr>
        <tbody>
            <?php while($row = $request_engins->fetch()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['familyID'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['town'] ?></td>
                    <td><?= $row['matricule'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
