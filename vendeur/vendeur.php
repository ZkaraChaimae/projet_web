<?php
    // Connexion avec la base de donnée
    $bdd = mysqli_connect('localhost','root','root','gestionVentes');

    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'v')
            echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('Location:/gestion_ventes/index.php');
    //#f794a6
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
        <li><a href='/gestion_ventes/vendeur/cmd.php'>Passer une commande</a></li>
        <li><a href='verifier_cmd.php'>Vérifier état d'une commande</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>