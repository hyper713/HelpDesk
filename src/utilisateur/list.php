<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <a href="../index.php">Page d'Accueil</a> <a href="create.php">Créer un utilisateur</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Login</th>
            <th>Options</th>
        </tr>
        <?php
            $request = $conn->prepare("SELECT matricule, nom, prenom, login FROM utilisateur");
            $request->execute();
            $rows = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $key => $value) {
                echo("<tr>");
                echo("<td>".$value['nom']."</td>");
                echo("<td>".$value['prenom']."</td>");
                echo("<td>".$value['login']."</td>");
                echo('<td> <a href="update.php?mat='.$value['matricule'].'">Modifier</a> 
                    <a href="delete.php?mat='.$value['matricule'].'">Supprimer</a></td>');
                echo("</tr>");
            }
        ?>
    </table>
</body>
</html>