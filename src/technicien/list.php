<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des techniciens</title>
</head>
<body>
    <a href="../index.php">Page d'Accueil</a> <a href="create.php">Créer un technicien</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Login</th>
            <th>Commentaire</th>
            <th>Options</th>
        </tr>
        <?php
            $request = $conn->prepare("SELECT id_tech, nom, prenom, login, commentaire FROM utilisateur, technicien WHERE utilisateur.matricule = technicien.matricule");
            $request->execute();
            $rows = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $key => $value) {
                echo("<tr>");
                echo("<td>".$value['nom']."</td>");
                echo("<td>".$value['prenom']."</td>");
                echo("<td>".$value['login']."</td>");
                echo("<td>".$value['commentaire']."</td>");
                echo('<td> <a href="update.php?id='.$value['id_tech'].'">Modifier</a> 
                    <a href="delete.php?id='.$value['id_tech'].'">Supprimer</a></td>');
                echo("</tr>");
            }
        ?>
    </table>
</body>
</html>