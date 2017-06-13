<?php
// This is a live search using ajax

// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'v')
    header('Location:/gestion_ventes/index.php');
//variable qui affiche le resultat
$output = '';
//Afficher le client 
$id = $_POST['idc'];
$sql = "select * from commande_client c, etre_detat E, etat_cmd Et
        where c.id_cmdClient = E.id_cmdclient
        and E.id_etat = Et.id_etat
        and c.id_cmdClient like '%$id%' ";

$result = mysqli_query($bdd, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output.='<h4>Commande trouvée :</h4>';
    $output.='<div>
                <table id="affich_cmd" border=1>
                    <th>N°Cmd</th><th>Date</th><th>Etat</th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $output.='
                    <tr>
                        <td>'.$row["id_cmdClient"].'</td>
                        <td>'.$row["date_cmd"].'</td>
                        <td>'.$row["libelle"].'</td>
                    </tr>
        ';
    }
    $output.='</table>
              </div>';
    echo $output;
}
else
{
    echo 'Commande non trouvé';
    $output = '';
    echo $output;
}
?>