<?php
    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('Location:/projet_web/index.php');
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
            <li><a href='/projet_web/magasinier/verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/projet_web/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/projet_web/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/projet_web/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>
 
