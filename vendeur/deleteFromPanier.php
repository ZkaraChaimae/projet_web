<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');


// Recuperer l'identifiant du produit;
$idp = $_POST['idP'];
// Supprimer la ligne correspondante:
unset($_SESSION['panier'][$idp]);
// Afficher le tableau:
include('panier.php');
?>