<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un technicien</title>
</head>
<body>
    <a href="list.php">Liste des techniciens</a>
    <br><br>
    <form action="update.php" method="post">
            <?php
                if (isset($_GET['id'])) {
                    $request = $conn->prepare("SELECT id_tech, commentaire, matricule FROM technicien WHERE id_tech = :id");
                    $request->execute(array('id' => $_GET['id']));
                    $technicien = $request->fetch(PDO::FETCH_ASSOC);

                    $request = $conn->prepare("SELECT matricule, nom, prenom FROM utilisateur");
                    $request->execute(array('id' => $_GET['id']));
                    $utilisateurs = $request->fetchAll(PDO::FETCH_ASSOC);

                    echo('Utilisateur: <select name="utilisateur">');
    
                    foreach ($utilisateurs as $key => $value) {
                        echo('<option value="'.$value['matricule'].'"');
                        if ($value['matricule'] == $technicien['matricule']) {
                            echo('selected');
                        }
                        echo('>'.$value['nom'].' '.$value['prenom'].'</option>');
                    }

                    echo('</select><br>');
                    echo('Commentaire: <input type="text" name="commentaire" value="'.$technicien['commentaire'].'"><br>');

                    echo('<input type="submit" value="Valider">');
                }               
            ?>
    </form>

    <?php
        if (isset($_POST['utilisateur']) and isset($_POST['commentaire'])) {
            $request = $conn->prepare("UPDATE technicien SET matricule = :mat, commentaire = :comment");

            $data = array(
                'mat'=>$_POST["utilisateur"],
                'comment'=>$_POST["commentaire"]
            );

            $request->execute($data);

            if($request->rowCount()!=0){
                echo("L'technicien est modifié");
            }
        }
    ?>
</body>
</html>