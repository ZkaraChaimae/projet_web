<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');
//variable qui affiche le resultat
$output = '';
//Afficher le client 
$mot = $_POST['search'];
//Req sql
$sql = "select * from produit p, categorie c
        where p.id_categ = c.id_categorie 
        and intitule like '%$mot%' 
        or code_produit like '%$mot%'
        or designation like '%$mot%'";

$result = mysqli_query($bdd, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output.='<h4>Produits trouvés :</h4>';
    $output.='<div>
                <table id="affich_prod" border=1>
                    <th>Réference</th><th>designation</th><th>prix</th><th>Quantité disponible</th><th>Catégorie</th><th>Quantité</th><th></th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $output.='
                    <tr>
                        <td>'.$row["code_produit"].'</td>
                        <td>'.$row["designation"].'</td>
                        <td>'.$row["prix_vente"].'</td>
                        <td>'.$row["qte_stock"].'</td>
                        <td>'.$row["intitule"].'</td>
                        <td><input id="'.$row["id_produit"].'" type="number" min="1" max="'.$row["qte_stock"].'"></td>
                        <td><button name="ajouter_produit" onclick="return ajouter_produit('.$row["id_produit"].')">Ajouter</button></td>
                    </tr>
        ';
    }
    $output.='</table>
              </div>';
    echo $output;
}
else
{
    echo 'Produit non trouvé';
    $output = '';
    echo $output;
}

?>