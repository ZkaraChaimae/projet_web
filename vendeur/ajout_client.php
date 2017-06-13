<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');

$var1 = $_POST['nom'];
$var2 = $_POST['prenom'];
$var3 = $_POST['cin'];
$var4 = $_POST['mail'];
$var5 = $_POST['tel'];

// Insertion
$sql = "INSERT INTO personne (nom_pers,prenom_pers,cin_pers,tele_pers, email_pers) 
        VALUES ('$var1', '$var2', '$var3','$var5','$var4')";
if (mysqli_query($bdd, $sql)) 
{
    // récuperer l'id de la personne
    $idC = mysqli_insert_id($bdd);
    //L'inserer dans la table client
    $sql = "INSERT INTO client(id_pers) values($idC)";
    if (mysqli_query($bdd, $sql)) {
        // récuperer l'id du client
        $idC = mysqli_insert_id($bdd);
        echo "<h5>Client ajouté !";
        echo "<input id='idclient' type='hidden' value='$idC'>";
    } else {
        echo "<br>Error: " . "<br>" . mysqli_error($bdd);
    }
} else {
    echo "<br>Error: " . "<br>" . mysqli_error($bdd);
}

?>