<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/projet_web/index.php');
//variable qui affiche le resultat
$output = '';
//Afficher le produit
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
                    <th>Réference</th><th>designation</th><th>Quantité disponible</th><th>Seuil</th><th>Catégorie</th><th></th><th></th><th></th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $output.='
                    <tr>
                        <td>'.$row["code_produit"].'</td>
                        <td>'.$row["designation"].'</td>
                        <td>'.$row["qte_stock"].'</td>
                        <td>'.$row["intitule"].'</td>
                        <td>'.$row["seuil"].'</td>
                        <td><input id="p'.$row["id_produit"].'" type="number" min="0" placeholder="prix dachat"></td>
                        <td><input id="q'.$row["id_produit"].'" type="number" min="0" placeholder="Quantité"></td>
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