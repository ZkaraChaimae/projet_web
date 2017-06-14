<?php
    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('Location:/gestion_ventes/index.php');
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
        <li><a href='/gestion_ventes/magasinier_/verifier_stock.php'>Vérifier stock</a></li>
        <li><a href='/gestion_ventes/magasinier_/alimenter.php'>Alimenter stock</a></li>
        <li><a href='/gestion_ventes/magasinier_/bon_livraison.php'>Etablir bon de livraison</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>
 
