<?php
    // Démarrer la session
    session_start();
    
    echo "Bienvenue employé numéro : ".$_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<body>
    <ul>
        <li><a href=#>Etablir facture</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
</body>
</html>
 
