<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');

$idp = $_POST['idP'];
$qte = $_POST['quantite'];
$client = $_POST['idc'];
// Creer une variable session pour le client:
$_SESSION['currentClient'] = $client;

// Creer le panier
if(!isset($_SESSION['panier']))
    $_SESSION['panier'] = array();
// Ajouter la quantité :
if(isset($_SESSION['panier'][$idp]))
{
    $sql1 = 'select * from produit where id_produit = '.$idp;
    $resultat = mysqli_query($bdd, $sql1);
    $okok = mysqli_fetch_assoc($resultat);
    $var = $_SESSION['panier'][$idp] + $qte;
    if($var <= $okok['qte_stock'])
        $_SESSION['panier'][$idp] = $var;
    else
            echo "
            <script type=\"text/javascript\">
            alert('Quantité indisponible!');
            </script>
            ";
}
else
{
    $_SESSION['panier'][$idp] = $qte;
}

// Afficher le tableau:
include('panier.php');
?>