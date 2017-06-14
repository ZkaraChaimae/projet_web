<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');
/////////////////////////////////////////////////
// Récuper les données :
$ref = $_POST['ref'];
$des = $_POST['des'];
$achat = $_POST['achat'];
$vente = $_POST['vente'];
$qte = $_POST['qte'];
$seuil = $_POST['seuil'];
$cat = $_POST['cat'];

// Recuperer le fournisseur :
$fournisseur = $_POST['fournisseur'];

// Creer une variable session pour le fournisseur:
$_SESSION['currentFournisseur'] = $fournisseur;

// Créer la variable de session : 
if(!isset($_SESSION['nv']))
    $_SESSION['nv'] = array();
// Ajouter la quantité :
if(isset($_SESSION['nv'][$ref]))
{
    // Modifier le prix d'achat et le prix de vente
    $_SESSION['nv'][$ref][1] = $achat;
    $var = $_SESSION['nv'][$ref][3] + $qte;
    $_SESSION['nv'][$ref][3] = $var;
}
else
{
    // Inserer les variables :
    $_SESSION['nv'][$ref][0] = $des;
    $_SESSION['nv'][$ref][1] = $achat;
    $_SESSION['nv'][$ref][2] = $vente;
    $_SESSION['nv'][$ref][3] = $qte;
    $_SESSION['nv'][$ref][4] = $seuil;
    $_SESSION['nv'][$ref][5] = $cat;
}
// Afficher le tableau:
include('panier.php');
?>