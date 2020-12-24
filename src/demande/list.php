<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des demandes (En attente)</title>
</head>
<body>
    <a href="../index.php">Page d'Accueil</a> <a href="create.php">Créer une demande</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Demandeur</th>
            <th>Categorie</th>
            <th>Priorite</th>
            <th>Date demande</th>
            <th>Options</th>
        </tr>
        <?php
            $request = $conn->prepare("SELECT nom, prenom, id_dmd, categorie, priorite, date_dmd FROM utilisateur, demande WHERE utilisateur.matricule = demande.matricule AND etat='en attente'");
            $request->execute();
            $rows = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $key => $value) {
                echo("<tr>");
                echo("<td>".$value['nom'].' '.$value['prenom']."</td>");
                echo("<td>".$value['categorie']."</td>");
                echo("<td>".$value['priorite']."</td>");
                echo("<td>".$value['date_dmd']."</td>");
                echo('<td> <a href="update.php?id='.$value['id_dmd'].'">Modifier</a> 
                    <a href="delete.php?id='.$value['id_dmd'].'">Supprimer</a></td>');
                echo("</tr>");
            }
        ?>
    </table>
</body>
</html>