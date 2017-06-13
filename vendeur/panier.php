<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');



if(isset($_SESSION['panier']))
{
    // Recuperer les clés du tableau :
    $keys = array_keys($_SESSION['panier']);
    $sql = 'select * from produit where id_produit in ('.implode(',',$keys).')';
    $result = mysqli_query($bdd, $sql);
    // Afficher le panier
    if(mysqli_num_rows($result) > 0)
    {
        $total = 0;
        $output.='<h4 id="headTitle">Panier :</h4>';
        $output.='<div>
                    <table id="" border=1>
                        <th>Réference</th><th>Désignation</th><th>Prix</th><th>Quantité</th><th></th>
                    ';
        while($row = mysqli_fetch_array($result))
        {
            $total += $row["prix_vente"] * $_SESSION['panier'][$row['id_produit']];
            $output.='
                        <tr>
                            <td>'.$row["code_produit"].'</td>
                            <td>'.$row["designation"].'</td>
                            <td>'.$row["prix_vente"].'</td>
                            <td>'.$_SESSION['panier'][$row['id_produit']].'</td>
                            <td><button onclick="return deleteFromKart('.$row["id_produit"].')" >Supprimer</button></td>
                        </tr>
            ';
        }
        $output.='</table>
                  </div>';
        echo $output;
        echo "<h5>Total : ".$total." MAD</h5>";
    }
}

?>