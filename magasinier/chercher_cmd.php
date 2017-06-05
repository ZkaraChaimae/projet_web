<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
else header('/var/www/html/gestion_ventes/index.php');
$bon = $_POST['bonCmd'];
// Chercher la commande
$sql = "select * from commande client where num_cmd = '$bon' ";
$cmd = mysqli_query($bdd, $sql);
if($row = mysqli_fetch_assoc($cmd))
{
    // Commande trouvé
    // Chercher le client
    $sql2 = "select * from personne where id_Pers = (
            select id_pers from client where id_client = $row['id_client'])";
    $client = mysqli_query($bdd, $sql2);
    $cli = mysqli_fetch_assoc($client);
    
    // Chercher l'adresse du client
    $req = "select * from addresse where id_pers = $cli['id_Pers']";
    $adresse = mysqli_query($bdd, $req);
    $adrr = mysqli_fetch_assoc($adresse);
    
    // Chercher la ville
    $req2 = "select * from ville where id_ville = $adrr['id_ville']"
    $ville = mysqli_query($bdd, $req2);
    $vil = mysqli_fetch_assoc($ville);
    
    // Chercher les produits
    $sql3 = "select * from produit where id_produit IN (
            select id_produit from ligne cmd client where id_cmdClient = $row['id_cmdClient'])";
    $produits = mysqli_query($bdd, $sql3);
    
    // Chercher le vendeur
    $sql4 = "select *from personne where id_Pers = (
            select id_Pers from employé where id_emp = (
            select id_emp from vendeur where id_vendeur = (
            select id_vendeur from commande client where id_cmdClient = $row['id_cmdClient'])))";
    $vendeur = mysqli_query($bdd, $sql4);
    $ven = mysqli_fetch_assoc($vendeur);
}
else echo "<p id='styleMe'> Aucune commande existante de ce numéro</p>";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <ul>
            <li><a href='verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/gestion_ventes/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href=#>Etablir bon de livraison</a></li>
            <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br>
        
        <table>
            <th>numéro de commande</th><th>date</th><th>vendeur</th>
            <tr>
                <td><?php echo $row['num_cmd']; ?></td>
                <td><?php echo $row['date_cmd']; ?></td>
                <td><?php echo $ven['nom_pers'].' '.$ven['prenom_pers']; ?></td>
            </tr>
        </table>
        
        <table>
            <th>nom</th><th>prenom</th><th>cin</th><th>email</th><th>telephone</th><th>Adresse</th>
            <tr>
                <td><?php echo $cli['nom_pers']; ?></td>
                <td><?php echo $cli['prenom_pers']; ?></td>
                <td><?php echo $cli['cin_pers']; ?></td>
                <td><?php echo $cli['email_pers']; ?></td>
                <td><?php echo $cli['tel_pers']; ?></td>
                <td><?php echo $adrr['adresse']. ' '.$vil['laville']; ?></td>
            </tr>
        </table>
    </body>
</html>