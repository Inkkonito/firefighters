<?php include('db.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Analysing french firefighters activities</title> 
</head>
<body>
<?php include('nav.php'); ?>
<hr>
<!-- -->
<!-- Table 1: SDIS list --> 
<!-- -->
    <?php $request_list_sdis = $pdo->query('SELECT departementID, size, name FROM sdis'); ?>
    <table>
        <thead>
            <caption>SDIS list</caption>
            <tr>
                <th>SDIS</th>
                <th>Size</th>
                <th>Name</th>
                <th>Actions</th>
                
            </tr>
        <tbody>
            <?php while($row = $request_list_sdis->fetch()) { ?>
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
<!-- Table 2 : Groupements list --> 
<!-- -->
    <?php $request_list_groupement = $pdo->query('SELECT groupement.id, groupement.sdisID, groupement.name, firehall.town FROM groupement INNER JOIN firehall ON groupement.id = firehall.id'); ?>
     <table class="centered" class="responsive">
        <thead>
            <caption>Groupements list</caption>
            <tr>
                <th>ID</th>
                <th>SDIS</th>
                <th>Name</th>              
                <th>Owner</th>              
            </tr>
        <tbody>
            <?php while($row = $request_list_groupement->fetch()) { ?>
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
<!-- Table 3 : Firehalls list --> 
<!-- -->
    <?php $request_list_firehall = $pdo->query("
        SELECT firehall.id, groupement.name, groupement.sdisID, firehall.size, firehall.town, firehall.cp 
        FROM firehall 
        INNER JOIN groupement ON firehall.id = groupement.id
    "); ?>
    <table>
        <thead>
            <caption>Firehalls list</caption>
            <tr>
                <th>ID</th>
                <th>SDIS</th>              
                <th>Groupement</th>
                <th>Size</th>              
                <th>Town</th>              
                <th>CP</th>              
            </tr>
        <tbody>
            <?php while($row = $request_list_firehall->fetch()) { ?>
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
<!-- Table 4 : Effectifs list --> 
<!-- -->
    <?php $request_list_effectif = $pdo->query("
        SELECT effectif.id, effectif.firstname, effectif.lastname, rank.sectionID, rank.name, firehall.town FROM effectif
        INNER JOIN rank ON rank.id = effectif.rankID
        INNER JOIN firehall ON effectif.firehallID = firehall.id
    "); ?>
    <table>
        <thead>
            <caption>Effectifs list</caption>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Section</th>
                <th>Rank</th>
                <th>Firehall</th>
                
            </tr>
        <tbody>
            <?php while($row = $request_list_effectif->fetch()) { ?>
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
<!-- Table 5 : Ranks list --> 
<!-- -->
    <?php $request_list_ranks = $pdo->query(" 
        SELECT TotalRankID.rankid, TotalRankID.rankname, TotalRankID.ranksectionid, COUNT(TotalRankID.effectifID) AS totalrankid
        FROM 
        (
        SELECT rank.id AS rankid, rank.name AS rankname, rank.sectionid AS ranksectionid, effectif.id AS effectifid 
        FROM rank LEFT OUTER JOIN effectif ON rank.id = effectif.rankID
        ) 
        AS TotalRankID 
        GROUP BY TotalRankID.rankid"); ?>
    <table>
        <thead>
            <caption>Ranks list</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>              
                <th>Section</th>              
                <th>TotalRankID</th>              
            </tr>
        <tbody>
            <?php while($row = $request_list_ranks->fetch()) { ?>
                <tr>
                    <td><?= $row['rankid'] ?></td>
                    <td><?= $row['rankname'] ?></td>                    
                    <td><?= $row['ranksectionid'] ?></td>                    
                    <td><?= $row['totalrankid'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>
<!-- -->
<!-- Table 6 : Vehicles list --> 
<!-- -->
    <?php $request_list_engins = $pdo->query("
        SELECT engin.id, engin_modele.modeleID,firehall.town, engin.matricule FROM engin
        INNER JOIN engin_modele ON engin.id = engin_modele.id
        INNER JOIN firehall ON engin.firehallID = firehall.id
    "); ?>
     <table>
        <thead>
            <caption>Vehicles list</caption>
            <tr>
                <th>ID</th>
                <th>ModeleID</th>
                <th>Firehall</th>              
                <th>Matricule</th>              
            </tr>
        <tbody>
            <?php while($row = $request_list_engins->fetch()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['modeleID'] ?></td>
                    <td><?= $row['town'] ?></td>
                    <td><?= $row['matricule'] ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
