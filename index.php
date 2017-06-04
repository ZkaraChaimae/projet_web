<?php
    // Connexion avec la base de donnée
    $bdd = new PDO('mysql:host=localhost;dbname=gestionVentes;charset=utf8','root','root');
    
    // Démarrer la session
    session_start();
    
    //Si un utilisateur est deja connecté
    if(isset($_SESSION['username']))
    {
        if($_SESSION['user_type'] === 'c')
            header('Location: /gestion_ventes/caissier/caissier.php');
        else if($_SESSION['user_type'] === 'm')
            header('Location: /gestion_ventes/magasinier/magasinier.php');
        else if($_SESSION['user_type'] === 'v')
            header('Location: /gestion_ventes/vendeur/vendeur.php');
    }
    //Récupération des données
    if(isset($_POST['connexion']))
    {
        echo "auth <br>";
        $username = $_POST['login'];
        $psd = $_POST['psd'];
        // Récuperation des données
        $reponse = $bdd->query("select * from employé where login = '$username' and passwd = '$psd'");
        if($donnees = $reponse->fetch())
        {
            // Ouvrir une session pour l'utilisateur en question
            $_SESSION['username'] = $donnees['id_emp'];
            $_SESSION['user_type'] = $donnees['type'];
            
            if($donnees['type'] === 'c')
                header('Location: /gestion_ventes/caissier/caissier.php');
            else if($donnees['type'] === 'm')
                header('Location: /gestion_ventes/magasinier/magasinier.php');
            else if($donnees['type'] === 'v')
                header('Location: /gestion_ventes/vendeur/vendeur.php');
        }
        else
            echo "<p id=\"erreur\">Login ou mot de passe incorrecte !<p><br>";
    }
    
?>
<!DOCTYPE html>
<html>
<body>
    <table border="1">
    <form id="auth" action="index.php" method="POST">
        <tr>
            <td>Login : </td>
            <td><input type="text" name="login" required/></td>
        </tr>
        <tr>
            <td>Mot de passe : </td>
            <td><input type="password" name="psd" required/></td>
        </tr>
        <tr>
            <td colspan=2><center><button name="connexion">Se connecter</button></center></td>
        </tr>
    </form>
    </table>
</body>
</html>
