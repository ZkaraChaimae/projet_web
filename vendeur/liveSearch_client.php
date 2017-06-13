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
$cin = $_POST['cin'];
$sql = "select * from personne p, client c
        where p.id_Pers = c.id_pers
        and cin_pers like '%$cin%' ";

$result = mysqli_query($bdd, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output.='<h4>Résultat trouvé :</h4>';
    $output.='<div>
                <table id="affich_client" border=1>
                    <th>Nom</th><th>Prénom</th><th>CIN</th><th>E-mail</th><th>Télephone</th><th></th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $output.='
                    <tr>
                        <td>'.$row["nom_pers"].'</td>
                        <td>'.$row["prenom_pers"].'</td>
                        <td>'.$row["cin_pers"].'</td>
                        <td>'.$row["email_pers"].'</td>
                        <td>'.$row["tele_pers"].'</td>
                        <td><button name="choisir_client" onclick="return clock('.$row["id_client"].')">choisir</button></td>
                    </tr>
        ';
    }
    $output.='</table>
              </div>';
    echo $output;
}
else
{
    echo 'Client non trouvé';
    $output = '';
    echo $output;
}
?>