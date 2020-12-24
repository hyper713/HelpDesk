<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une demande</title>
</head>
<body>
    <a href="list.php">Liste des demandes</a>
    <br><br>
    <form action="create.php" method="post">
        Demandeur:<select name="utilisateur">
            <?php
                $request = $conn->prepare("SELECT matricule, nom, prenom, login FROM utilisateur");
                $request->execute();
                $rows = $request->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $key => $value) {
                    echo('<option value="'.$value['matricule'].'">'.$value['nom'].' '.$value['prenom'].'</option>');
                }
            ?>
        </select><br>

        Categorie: <select name="categorie">
            <option value=materiel>Materiel</option>
            <option value=logiciel>Logiciel</option>
        </select><br>
        Titre: <input type="text" name="titre"><br>
        Description: <textarea name="description" rows=3 cols=80></textarea><br>
        Priorite: <select name=priorite>
            <option value=urgente>Urgente</option>
            <option value=moyenne>Moyenne</option>
            <option value=basse>Basse</option>
        </select><br>
        <input type="submit" value="Valider">
    </form>

    <?php
        if (isset($_POST['utilisateur']) and isset($_POST['categorie']) and isset($_POST['titre']) and isset($_POST['description']) and isset($_POST['priorite'])) {
            $request = $conn->prepare("INSERT INTO demande(titre, description, categorie, priorite, etat, matricule, date_dmd) VALUES (:title, :desc, :cat, :priority, 'en attente', :user, :date)");

            $data = array(
                'user'=>$_POST["utilisateur"],
                'cat'=>$_POST["categorie"],
                'title'=>$_POST["titre"],
                'desc'=>$_POST["description"],
                'priority'=>$_POST["priorite"],
                'date'=>date("Y-m-d")
            );

            $request->execute($data);

            if($request->rowCount()!=0){
                echo("La demande est créé");
            }
        }
    ?>
</body>
</html>