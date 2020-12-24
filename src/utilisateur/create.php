<?php require_once("../database.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
</head>
<body>
    <a href="list.php">Liste des utilisateurs</a>
    <br><br>
    <form action="create.php" method="post">
        Nom: <input type="text" name="nom"><br>
        Prenom: <input type="text" name="prenom"><br>
        Login: <input type="text" name="login"><br>
        Mot de passe: <input type="password" name="mdp"><br>
        <input type="submit" value="Valider">
    </form>
    
    <?php
        if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['login']) and isset($_POST['mdp'])) {
            $request = $conn->prepare("INSERT INTO utilisateur(nom, prenom, login, mdp) values (:lastname, :firstname, :username, :password)");

            $data = array(
                'lastname'=>$_POST["nom"],
                'firstname'=>$_POST["prenom"],
                'username'=>$_POST["login"],
                'password'=>$_POST["mdp"]
            );

            $request->execute($data);

            if($request->rowCount()!=0){
                echo("L'utilisateur ".$_POST["nom"]." ".$_POST["prenom"]." est créé");
            }
        }
    ?>
</body>
</html>