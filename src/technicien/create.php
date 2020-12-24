<?php require_once("../database.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un technicien</title>
</head>
<body>
    <a href="list.php">Liste des techniciens</a>
    <br><br>
    <form action="create.php" method="post">
        Utilisateur<select name="utilisateur">
            <?php
                $request = $conn->prepare("SELECT matricule, nom, prenom, login FROM utilisateur WHERE matricule NOT IN (SELECT matricule FROM technicien)");
                $request->execute();
                $rows = $request->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $key => $value) {
                    echo('<option value="'.$value['matricule'].'">'.$value['nom'].' '.$value['prenom'].'</option>');
                }
            ?>
        </select><br>

        Commentaire: <input type="text" name="commentaire"><br>
        <input type="submit" value="Valider">
    </form>
    
    <?php
        if (isset($_POST['utilisateur']) and isset($_POST['commentaire'])) {
            $request = $conn->prepare("INSERT INTO technicien(matricule, commentaire) values (:mat, :comment)");

            $data = array(
                'mat'=>$_POST["utilisateur"],
                'comment'=>$_POST["commentaire"]
            );

            $request->execute($data);

            if($request->rowCount()!=0){
                echo("L'technicien est créé");
            }
        }
    ?>
</body>
</html>