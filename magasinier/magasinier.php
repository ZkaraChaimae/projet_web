<?php
    // Démarrer la session
    session_start();
    
    echo "Bienvenue employé numéro : ".$_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
        <li><a href=#>Vérifier stock</a></li>
        <li><a href='/gestion_ventes/magasinier/alimenter.php'>Alimenter stock</a></li>
        <li><a href=#>Etablir bon de livraison</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>
 
