<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
else header('Location:/projet_web/index.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <ul>
            <li><a href='/projet_web/magasinier/verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/projet_web/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/projet_web/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/projet_web/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br>
        <div id="containSearch">
            <input type="text" id="searchTxt" name="searchTxt" placeholder="N° commande">
            <div id="result"></div>
        </div>
        <script>
            $(document).ready(function(){
               $('#searchTxt').keyup(function(){
                   var txt = $(this).val();
                   if(txt != '')
                    {
                        // Afficher le tableau du résultat :
                        $('#result').css("display","block");
                        $('#result').html('');
                        $.ajax({
                            url:"afficher_cmd.php",
                            method:"post",
                            data:{search:txt},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#result').html(data);
                            }
                        });
                    }
                   else
                    {
                        // Ne pas afficher le tableau
                        $('#result').css("display","none");
                    }
               });
            });
            
            function livrer(cmd)
            {
                var addr = $("#A"+cmd).val();
                var ville = $("#ville"+cmd).val();
                if(addr == ''|| ville =='')
                    alert("Veuillez donner une adresse valide !");
                else
                {
                    $.ajax({
                            url:"livrer.php",
                            method:"post",
                            data:{idCmd:cmd,adresse:addr,ville:ville},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#result').html(data);
                            }
                        });
                }
            }
        </script>
    </body>
</html>
