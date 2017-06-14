<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');

$cmd = $_POST['idCmd'];
$addr = $_POST['adresse'];
$ville= $_POST['ville'];

// Chercher le client pour modifier l'adresse :
$sqlSearch = "select id_pers from client where id_client = (
                select id_client from commande_client where id_cmdClient = ".$cmd.")";
$result = mysqli_query($bdd,$sqlSearch);
$ligne = mysqli_fetch_array($result);
$client = $ligne['id_pers'];

// Modifier l'adresse :
$sqlUpdtAddr = 'update addresse set adresse = "'.$addr.'", id_ville = '.$ville.' where id_pers = '.$client;
mysqli_query($bdd,$sqlUpdtAddr);

// Ajouter etat livré :
$datestring = date('Y-m-d');
$sqlEtat = "insert into etat_cmd(libelle, date) values('Livre','$datestring')";
mysqli_query($bdd,$sqlEtat);
echo $sqlEtat;
$idEtat = mysqli_insert_id($bdd);//Id de l'etat:

// Inserer l'etat dans l'association :
$sqlEtre = "insert into etre_detat values(".$idEtat.",".$cmd.")";
mysqli_query($bdd,$sqlEtre);
?>