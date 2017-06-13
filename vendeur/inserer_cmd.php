<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');
/////////////////////////////////////////////////

if(isset($_SESSION['panier']) && isset($_SESSION['currentClient']))
{
    $datestring = date('Y-m-d');
    // Ajouter la commande
    $client = $_SESSION['currentClient'];
    $employe = $_SESSION['username'];
    // Chercher le vendeur:
    $sqlVendeur = "select id_vendeur from vendeur where id_emp = ".$employe." limit 1";
    $resultat = mysqli_query($bdd,$sqlVendeur);
    $rowV = mysqli_fetch_assoc($resultat);
    $vendeur = $rowV['id_vendeur'];
    
    
    // Inserer la commande
    $sql = "insert into commande_client(date_cmd,id_vendeur,id_client)
            values('$datestring',$vendeur,$client)";
    mysqli_query($bdd, $sql);
    $idCmd = mysqli_insert_id($bdd);//Id de la commande
    
    
    // Inserer etat :
    $sqlEtat = "insert into etat_cmd(libelle,date) values ('En cours','$datestring')";
    echo $sqlEtat;echo '<br>';
    mysqli_query($bdd, $sqlEtat);
    $idEtat = mysqli_insert_id($bdd);//Id de l'etat:
    
    
    $sqlEtre = "insert into etre_detat values($idEtat,$idCmd)";
    mysqli_query($bdd, $sqlEtre);
    
    
    
    // Inserer lignes de commande :
    // Recuperer les clés du tableau :
    $keys = array_keys($_SESSION['panier']);
    $sql2 = 'select * from produit where id_produit in ('.implode(',',$keys).')';
    $result = mysqli_query($bdd, $sql2);
    // Afficher le panier
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $var = $_SESSION['panier'][$row['id_produit']];
            $prix = $row['prix_vente'];
            $produit = $row['id_produit'];
            $sql_lc = 'insert into lc_client(qte_commande, prix_vente_produit, id_cmdClient,id_produit) 
                        values('.$var.','.$prix.','.$idCmd.','.$produit.')';
            mysqli_query($bdd, $sql_lc);
            echo $sql_lc;
            echo '<br>';
        }
    }
    // Supprimer le panier et le client:
    unset($_SESSION['panier']);
    unset($_SESSION['currentClient']);
}
?>