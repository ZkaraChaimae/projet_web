<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
else header('Location:/projet_web/index.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <ul>
            <li><a href='/projet_web/magasinier/verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/projet_web/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/projet_web/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/projet_web/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br>
        <form method="POST" action="chercher_cmd.php">
            <table border=1>
                <tr>
                    <td>Taper ici le bon de commande</td>
                    <td><input type="text" name="bonCmd" id="bonCmd"></td>
                </tr>
                <tr>
                    <td colspan=2><button>Chercher</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>
