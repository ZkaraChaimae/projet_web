<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
else header('Location:/gestion_ventes/index.php');

//Afficher tout les produits présents dans le stock
$sql = "select * from produit ";
$result = mysqli_query($bdd, $sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <ul>
            <li><a href='verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/gestion_ventes/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/gestion_ventes/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br>
        <table border=1 onchange="fun">
            <th>code produit</th><th>designation</th><th>prix d'achat</th><th>prix de ventes</th><th>quantité stock</th><th>seuil</th>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['code_produit'];?></td>
                <td><?php echo $row['designation'];?></td>
                <td><?php echo $row['prix_achat'];?></td>
                <td><?php echo $row['prix_vente'];?></td>
                <td id="colorMe"><?php echo $row['qte_stock'];?></td>
                <td><?php echo $row['seuil'];?></td>
                <script >
                    /*var x ="<?php echo $row['qte_stock']; ?>";
                    var y="<?php echo $row['seuil']; ?>";
                    alert ("x "+x+" y "+y);
                    if(x<=y)
                        document.getElementById("colorMe").style.backgroundColor = "#FF9595";
                    else 
                        document.getElementById("colorMe").style.backgroundColor = "white";*/
                </script>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
