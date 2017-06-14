<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');

$idp = $_POST['idP'];
$qte = $_POST['quantite'];
$prix = $_POST['prix'];
$fournisseur = $_POST['fournisseur'];

// Creer une variable session pour le fournisseur:
// Si c'est pas le même fournisseur, supprimer l'ancien panier :
if($fournisseur != $_SESSION['currentFournisseur'])
{
    $_SESSION['currentFournisseur'] = $fournisseur;
    unset($_SESSION['panier']);
}

// Creer le panier
if(!isset($_SESSION['panier']))
    $_SESSION['panier'] = array();
// Ajouter la quantité :
if(isset($_SESSION['panier'][$idp]))
{
    $_SESSION['panier'][$idp][0] = $prix;
    $var = $_SESSION['panier'][$idp][1] + $qte;
    $_SESSION['panier'][$idp][1] = $var;
}
else
{
    $_SESSION['panier'][$idp][0] = $prix;
    $_SESSION['panier'][$idp][1] = $qte;
}
// Afficher le tableau:
include('panier.php');
?>