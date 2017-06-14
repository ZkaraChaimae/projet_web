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
$sql = "select P.id_Pers,P.nom_pers,P.prenom_pers, C.id_client,cmd.date_cmd,cmd.id_cmdClient from
        commande_client cmd, client C, personne P
        where cmd.id_client = C.id_client
        and C.id_pers = P.id_Pers
        and cmd.id_cmdClient like '%$mot%'
        and cmd.id_cmdClient not in(
                    select id_cmdclient 
                    from etre_detat E1, etat_cmd E2
                    where E1.id_etat = E2.id_etat
                    and libelle = 'Livre')";

$result = mysqli_query($bdd, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output.='<h4>Commande trouvée :</h4>';
    $output.='<div>
                <table id="affich_cmd" border=1>
                    <th>N° commande</th><th>Date</th><th>Client</th><th>Adresse</th><th></th><th></th>
                ';
    
    while($row = mysqli_fetch_array($result))
    {
        $personne = $row["id_Pers"];
        $sqlAdd = "select * from addresse where id_pers = ".$personne;
        $addr = mysqli_query($bdd, $sqlAdd);
        $adresse = mysqli_fetch_array($addr);
        
        $sqlVille = 'select * from ville';
        $V = mysqli_query($bdd, $sqlVille);
        
        $output.='
                    <tr>
                        <td>'.$row["id_cmdClient"].'</td>
                        <td>'.$row["date_cmd"].'</td>
                        <td>'.$row["nom_pers"].' '.$row["prenom_pers"].'</td>
                        <td><textarea id="A'.$row["id_cmdClient"].'" type="text" placeholder="Adresse">'.$adresse['adresse'].'</textarea></td>
                        <td>
                            <select id="ville'.$row["id_cmdClient"].'" >
                                <option value="">Selectionner</option>';
        while($ville  = mysqli_fetch_array($V))   
        {
            $output.='<option value="'.$ville["id_ville"].'">'.$ville["laville"].'</option>';
        }
        $output.='</select>
                        </td>
                        <td><button onclick="return livrer('.$row["id_cmdClient"].')">Livrer</button></td>
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
}

?>