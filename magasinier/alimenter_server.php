<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
else header('Location:/gestion_ventes/index.php');

$idmagas = $_SESSION['username'];
// Phase de fournisseur
$CHF = $_POST['choix_fournisseur'];
if($CHF == 'choisir')
{
    $idF = $_POST['f_existant'];
    $sql = "select * from fournisseur where id_fournisseur = $idF ";
    $fournisseur = mysqli_query($bdd, $sql);
    $rowF = mysqli_fetch_assoc($fournisseur);
}

else if( $CHF == 'saisir')
{
    $var1 = $_POST['nom'];
    $var2 = $_POST['email'];
    $var3 = $_POST['tele'];
    $var4 = $_POST['comms'];
    $sql = "INSERT INTO fournisseur (nom, email, tele,commentaires) 
        VALUES ('$var1', '$var2', '$var3','$var4')";
    if (mysqli_query($bdd, $sql)) {
        echo "New record created successfully";
    } else {
        echo "<br>Error: " . "<br>" . mysqli_error($bdd);
    }
    $idF = mysqli_insert_id($bdd);
}

// Phase de produit
$CHP = $_POST['choix_produit'];
//echo "chp ".$CHP;
$qte = $_POST['qte'];
if($CHP == 'choisir')
{
    $idP = $_POST['p_existant'];
    $var3 = $_POST['prixAchat2'];
    $sql = "select * from produit where id_produit = $idP ";
    $produit = mysqli_query($bdd, $sql);
    $rowP = mysqli_fetch_assoc($produit);
    $new = $rowP['qte_stock']+$qte;
    // UPDATE
    echo "update <br>";
    $req_upd = "update produit set qte_stock = $new where id_produit = $idP";
    echo $req_upd;
    //$upd = mysqli_query($bdd, $req_upd);
    if (mysqli_query($bdd, $req_upd)) {
        echo "New record created successfully";
    } else {
        echo "<br>Error: " . "<br>" . mysqli_error($bdd);
    }
}
else if( $CHP == 'saisir')
{
    $var1 = $_POST['codeP'];
    $var2 = $_POST['designation'];
    $var3 = $_POST['prixAchat'];
    $var4 = $_POST['prixVente'];
    $var5 = $_POST['seuil'];
    $var6 = $_POST['cat'];
    echo "<br>codeP ".$var1;
    echo "<br>design ".$var2;
    echo "<br>prixA ".$var3;
    echo "<br>prixV ".$var4;
    echo "<br>seuil ".$var5;
    echo "<br>cate ".$var6;
    echo "<br>qte ".$qte;
    
    $sql = "INSERT INTO produit (code_produit, designation, prix_achat,prix_vente,qte_stock,seuil,id_categ) 
        VALUES ('$var1', '$var2', $var3,$var4,$qte,$var5,$var6)";
    
    if (mysqli_query($bdd, $sql)) {
        echo "New record created successfully";
    } else {
        echo "<br>Error: " . "<br>" . mysqli_error($bdd);
    }
    $idP = mysqli_insert_id($bdd);
}

// Inserer commande:
$datestring = date('Y-m-d');
$sql3 = "INSERT INTO cmd_fournisseur (date_cmd, id_mag, id_fournisseur) 
        VALUES ('$datestring', $idmagas, $idF)";
if (mysqli_query($bdd, $sql3)) {
    echo "New record created successfully";
} else {
    echo "<br>Error: " .$sql. "<br>" . mysqli_error($bdd);
}
$idcmd = mysqli_insert_id($bdd);


// Inserer une ligne de commande :
$sql4 = "INSERT INTO lc_fournisseur (qte, prix_achat, id_prod,id_cf) 
        VALUES ('$qte', $var3, $idP,$idcmd)";
if (mysqli_query($bdd, $sql4)) {
    echo "New record created successfully";
} else {
    echo "<br>Error: " .$sql. "<br>" . mysqli_error($bdd);
}
$idcmd = mysqli_insert_id($bdd);

header('location:magasinier.php');
?>
