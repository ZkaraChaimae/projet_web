<?php
    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('/var/www/html/gestion_ventes/index.php');
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
        <li><a href='verifier_stock.php'>Vérifier stock</a></li>
        <li><a href='/gestion_ventes/magasinier/alimenter.php'>Alimenter stock</a></li>
        <li><a href='/gestion_ventes/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>
 
