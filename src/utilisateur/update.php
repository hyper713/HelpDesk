<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>
<body>
    <a href="list.php">Liste des utilisateurs</a>
    <br><br>
    <form action="update.php" method="post">
        <?php
            if (isset($_GET['mat'])) {
                $request = $conn->prepare("SELECT matricule, nom, prenom, login, mdp FROM utilisateur WHERE matricule = :mat");
                $request->execute(array('mat' => $_GET['mat']));
                $utilisateur = $request->fetch(PDO::FETCH_ASSOC);
                echo('Nom: <input type="text" name="nom" value="'.$utilisateur['nom'].'"><br>');
                echo('Prenom: <input type="text" name="prenom" value="'.$utilisateur['prenom'].'"><br>');
                echo('Login: <input type="text" name="login" value="'.$utilisateur['login'].'"><br>');
                echo('Mot de passe: <input type="password" name="mdp" value="'.$utilisateur['mdp'].'"><br>');
                echo('<input type="hidden" name="mat" value="'.$_GET['mat'].'">');

                echo('<input type="submit" value="Valider">');
            }
        ?>
    </form>
    <?php
        if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['login']) and isset($_POST['mdp'])) {
            $request = $conn->prepare("UPDATE utilisateur SET nom = :lastname, prenom = :firstname, login = :username, mdp = :password WHERE matricule = :mat");

            $data = array(
                'lastname'=>$_POST["nom"],
                'firstname'=>$_POST["prenom"],
                'username'=>$_POST["login"],
                'password'=>$_POST["mdp"],
                'mat'=>$_POST["mat"]
            );

            $request->execute($data);

            if($request->rowCount()!=0){
                echo("L'utilisateur ".$_POST["nom"]." ".$_POST["prenom"]." est modifié");
            }
        }
    ?>
</body>
</html>