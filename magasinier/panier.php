<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/gestion_ventes/index.php');

if(isset($_SESSION['panier']) || isset($_SESSION['nv']))
{
    $total = 0;
    $output.='<h4 id="headTitle">Panier :</h4>';
    $output.='<div>
                <table id="" border=1>
                    <th>Réference</th><th>Désignation</th><th>Quantité</th><th>Prix unitaire</th><th></th>
                ';
    if(isset($_SESSION['panier']))
    {
        // Recuperer les clés du tableau :
        $keys = array_keys($_SESSION['panier']);
        $sql = 'select * from produit where id_produit in ('.implode(',',$keys).')';
        $result = mysqli_query($bdd, $sql);
        // Afficher le panier
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $total += $_SESSION['panier'][$row['id_produit']][0] * $_SESSION['panier'][$row['id_produit']][1];
                $output.='
                            <tr>
                                <td>'.$row["code_produit"].'</td>
                                <td>'.$row["designation"].'</td>
                                <td>'.$_SESSION['panier'][$row['id_produit']][1].'</td>
                                <td>'.$_SESSION['panier'][$row['id_produit']][0].'</td>
                                <td><button onclick="return deleteFromKart('.$row["id_produit"].')"> Supprimer</button></td>
                            </tr>
                ';
            }
        }
    }
    if(isset($_SESSION['nv']))
    {
        // Récuperer les clé du tableau :
        while ($keys = current($_SESSION['nv'])) 
        {
            $this_key = key($_SESSION['nv']);
            $total += $_SESSION['nv'][$this_key][3] * $_SESSION['nv'][$this_key][1];
            $output.='
                    <tr>
                        <td>'.$this_key.'</td>
                        <td>'.$_SESSION['nv'][$this_key][0].'</td>
                        <td>'.$_SESSION['nv'][$this_key][3].'</td>
                        <td>'.$_SESSION['nv'][$this_key][1].'</td>
                        <td><button onclick="return deleteFromKart(\''.$this_key.'\')">Supprimer</button></td>
                    </tr>
                ';
            //Passer au suivant
            next($_SESSION['nv']);
        }
    }
    $output.='</table>
                  </div>';
    echo $output;
    echo "<h5>Total : ".$total." MAD</h5>";
}
?>