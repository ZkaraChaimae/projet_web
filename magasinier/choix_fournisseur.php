<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');

$var1 = $_POST['fou'];
if($var1 != $_SESSION['currentFournisseur'])
{
    $_SESSION['currentFournisseur'] = $var1;
    unset($_SESSION['panier']);
    unset($_SESSION['nv']);
}
?>