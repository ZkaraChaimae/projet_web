<?php
// This is a live search using ajax

// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/gestion_ventes/index.php');
//variable qui affiche le resultat
$output = '';
//Afficher le client 
$nom = $_POST['nom'];
$sql = "select * from fournisseur
        where nom like '%$nom%' ";

$result = mysqli_query($bdd, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output.='<h4>Résultat trouvé :</h4>';
    $output.='<div>
                <table id="affich_fournisseur" border=1>
                    <th>Nom</th><th>E-mail</th><th>Télephone</th><th>Commentaires</th><th></th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $output.='
                    <tr>
                        <td>'.$row["nom"].'</td>
                        <td>'.$row["email"].'</td>
                        <td>'.$row["tele"].'</td>
                        <td>'.$row["commentaires"].'</td>
                        <td><button name="choisir_fournisseur" onclick="return clock('.$row["id_fournisseur"].')">Choisir</button></td>
                    </tr>
                    ';
    }
    $output.='</table>
              </div>';
    echo $output;
}
else
{
    echo 'Fournisseur non trouvé';
    $output = '';
    echo $output;
}
?>