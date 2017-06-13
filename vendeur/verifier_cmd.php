<!DOCTYPE html>
<html>
    <head>
        <title>Vérifier stock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style_vendeur.css">
        <script src="jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <ul>
            <li><a href='/gestion_ventes/vendeur/cmd.php'>Passer une commande</a></li>
            <li><a href='verifier_cmd.php'>Vérifier état d'une commande</a></li>
            <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br><br>
        <div id="container">
            <h4>Chercher une commande</h4>
            <input type="text" id="searchTxt" name="searchTxt" placeholder="N° commande">
            <div id="result"></div>
        </div>
        <script>
            $(document).ready(function(){
               $('#searchTxt').keyup(function(){
                   var txt = $(this).val();
                   if(txt != '')
                    {
                        // Afficher le tableau
                        $('#result').css("display","block");
                        $('#result').html('');
                        $.ajax({
                            url:"liveSearch_cmd.php",
                            method:"post",
                            data:{idc:txt},
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
        </script>
    </body>
</html>