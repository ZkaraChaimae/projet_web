<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');

$var1 = $_POST['nom'];
$var2 = $_POST['email'];
$var3 = $_POST['tele'];
$var4 = $_POST['comms'];

// Insertion
$sql = "INSERT INTO fournisseur (nom,email,tele,commentaires) 
        VALUES ('$var1', '$var2', '$var3','$var4')";
if (mysqli_query($bdd, $sql)) 
{
    // récuperer l'id de la personne
    $idF = mysqli_insert_id($bdd);
    echo "<h5>Fournisseur ajouté !";
    echo "<input id='idfourniss' type='hidden' value='$idF'>";
}
else
    echo "<br>Error: " . "<br>" . mysqli_error($bdd);

if($idF != $_SESSION['currentFournisseur'])
{
    $_SESSION['currentFournisseur'] = $idF;
    unset($_SESSION['panier']);
    unset($_SESSION['nv']);
}
?>