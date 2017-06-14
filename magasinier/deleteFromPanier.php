<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');
/////////////////////////////////////////////////
$produit = $_POST['idP'];

if(isset($_SESSION['panier'][$produit]))
    unset($_SESSION['panier'][$produit]);
else if(isset($_SESSION['nv'][$produit]))
    unset($_SESSION['nv'][$produit]);
include('panier.php');
?>