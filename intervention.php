<?php include('db.php');?>
<!DOCTYPE HTML>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Listing interventions</title>
</head>
<body>
<?php include('nav.php'); ?>
<!-- -->
<!-- Table 1 : Interventions list --> 
<!-- -->
    <?php $request_list_intervention = $pdo->query("
  SELECT intervention.id, intervention.date, firehall.town, engin_modele.modeleID, engin.matricule FROM intervention
  INNER JOIN firehall ON intervention.firehallID = firehall.id
  INNER JOIN intervention_effectif ON intervention.id = intervention_effectif.interventionID
  INNER JOIN engin ON intervention_effectif.enginID = engin.id
  INNER JOIN engin_modele ON intervention.id = engin_modele.id
    "); ?>
    <table>
        <thead>
            <caption>Interventions list</caption>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Firehall</th>       
                <th>Modele</th>       
                <th>Matricule</th>       
            </tr>
        <tbody>
            <?php while($donnees = $request_list_intervention->fetch()) { ?>
                <tr>
                    <td><?= $donnees['id'] ?></td>
                    <td><?= $donnees['date'] ?></td>
                    <td><?= $donnees['town'] ?></td>                          
                    <td><?= $donnees['modeleID'] ?></td>                          
                    <td><?= $donnees['matricule'] ?></td>                          
                </tr>
            <?php } ?>
        </tbody>
    </table>
<hr>