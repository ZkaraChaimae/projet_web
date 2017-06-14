<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/gestion_ventes/index.php');

//////////////////////////////////////////////
//Chercher le fournisseur :
$sql = "select * from fournisseur
        where id_fournisseur = ".$_SESSION['currentFournisseur'];

$result = mysqli_query($bdd,$sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style_vendeur.css">
        <script src="jquery-3.2.1.min.js"></script>
        <style>
            #headTitle{
                display: none;
            }
        </style>
    </head>
    <body>
        <ul>
            <li><a href='/gestion_ventes/magasinier_/verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/gestion_ventes/magasinier_/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/gestion_ventes/magasinier_/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br>
        <div id="container">
            <!-- Afficher le tableau -->
            <div id="toPrint">
                <h5>Fournisseur : </h5>
                <table border=1>
                    <tr>
                        <td>Nom :</td>
                        <td><?php echo $row['nom']; ?></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Télephone :</td>
                        <td><?php echo $row['tele']; ?></td>
                    </tr>
                </table>
                <h5>Produits :</h5>
                <?php include('panier.php'); ?>
            </div>
            <button onclick="return ajouter_lc()">Passer la commande</button>
        </div>
        <div id="Commande"></div>
        <script>
            function ajouter_lc()
            {
                // Imprimer le fichier :
                var divContents = $("#toPrint").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write(divContents);
                printWindow.document.close();
                printWindow.print();
                $.ajax({
                        url:"inserer_cmd.php",
                        data:{},
                        dataType:"text",
                        success:function(data)
                        {
                            $('#Commande').html(data);
                            $(location).attr('href','magasinier.php');
                        }
                    });
                return false;
            }
        </script>
    </body>
</html>