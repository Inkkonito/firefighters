<?php include('db.php');?>
<!DOCTYPE HTML>
<html>
<head>
<title>Listing interventions</title>
</head>
<body>
    <ul>Navigation :
        <li><a href="index.php">Index</a></li>
        <li><a href="new_intervention.php">New intervention</a></li>
    </ul>
<!-- -->
<!-- 1er tableau : Liste des interventions --> 
<!-- -->
    <?php $request_list_intervention = $pdo->query("
    SELECT intervention.id, intervention.date, firehall.town, intervention.family, effectif.lastname, engin_modele.name, engin.matricule FROM intervention
    INNER JOIN firehall ON intervention.id = firehall.id
    INNER JOIN intervention_effectif ON intervention.id = intervention_effectif.interventionID
    INNER JOIN effectif ON intervention.id = effectif.id
    INNER JOIN engin ON intervention.id = engin.id
    INNER JOIN engin_modele ON intervention.id = engin_modele.id
    "); ?>
    <table>
        <thead>
            <caption>Liste des interventions</caption>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Caserne</th>
                <th>Type</th>
                <th>Fireman</th>
                <th>Vehicle</th>
                <th>Matricule</th>
                
            </tr>
        <tbody>
            <?php while($donnees = $request_list_intervention->fetch()) { ?>
                <tr>
                    <td><?= $donnees['id'] ?></td>
                    <td><?= $donnees['date'] ?></td>
                    <td><?= $donnees['town'] ?></td>
                    <td><?= $donnees['family'] ?></td>
                    <td><?= $donnees['lastname'] ?></td>
                    <td><?= $donnees['name'] ?></td>
                    <td><?= $donnees['matricule'] ?></td>
                           
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>