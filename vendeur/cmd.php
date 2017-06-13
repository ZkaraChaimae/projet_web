<?php
    // Connexion avec la base de donnée
    $bdd = new PDO('mysql:host=localhost;dbname=gestionVentes;charset=utf8','root','root');

    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'v')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('Location:/gestion_ventes/index.php');
?>
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
            <h4>Ancien client ?</h4>
            <input type="text" id="searchTxt" name="searchTxt" placeholder="cin">
            <div id="result"></div>
        </div>
        <br>
        <div id="container2">
            <div><button id="saisi">Saisir un nouveau client</button></div>
            <div><button id="choix">Chercher un ancien client</button></div>
            <div id="tableau" >
                <table >
                    <tr>
                        <td>Nom</td>
                        <td>: <input type="text" id="nom"></td>
                    </tr>
                    <tr>
                        <td>Prénom</td>
                        <td>: <input type="text" id="prenom"></td>
                    </tr>
                    <tr>
                        <td>CIN</td>
                        <td>: <input type="text" id="cin"></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>: <input type="email" id="email"></td>
                    </tr>
                    <tr>
                        <td>Télephone</td>
                        <td>: <input type="tel" id="tele"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><center><button id="inserer">Ajouter</button></center></td>
                    </tr>
                </table>
                <div id="bsala"></div>
            </div>
        </div>
        <br>
        <div id="container3">
            <h4>Commander des produits </h4>
            <input type="text" id="searchPdt" name="searchPdt" placeholder="Réf, Désignation, Catégorie">
            <div id="resultProd"></div>
            <div id="Kart">
                
            </div>
            <div>
                <a href='afficher_panier.php'><input type='submit' value='Panier' /></a>
            </div>
        </div>
        
        <script>
            var client;
            
            $(document).ready(function(){
               $('#searchTxt').keyup(function(){
                   var txt = $(this).val();
                   if(txt != '')
                    {
                        // Afficher le tableau
                        $('#result').css("display","block");
                        $('#result').html('');
                        $.ajax({
                            url:"liveSearch_client.php",
                            method:"post",
                            data:{cin:txt},
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
                //Cliquer sur le bouton de la saisit
                $('#saisi').click(function(){
                    $('#container').css("display","none");
                    $('#saisi').css("display","none");
                    $('#tableau').css("display","block");
                    $('#choix').css("display","block");
                });
                //Cliquer sur le bouton pour chercher un client
                $('#choix').click(function(){
                    $('#container').css("display","block");
                    $('#saisi').css("display","block");
                    $('#choix').css("display","none");
                    $('#tableau').css("display","none");
                });
                //Inserer le nouveau client dans la base de données
                $('#inserer').click(function(){
                    var nom = $('#nom').val();
                    var prenom = $('#prenom').val();
                    var cin = $('#cin').val();
                    var email = $('#email').val();
                    var tele = $('#tele').val();
                    $.ajax({
                            url:"ajout_client.php",
                            method:"post",
                            data:{nom:nom,prenom:prenom,cin:cin,mail:email,tel:tele},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#bsala').html(data);
                                //Vider les champs
                                $('#nom').val('');
                                $('#prenom').val('');
                                $('#cin').val('');
                                $('#email').val('');
                                $('#tele').val('');
                                // Récuperer l'identifiant du client
                                client = $('#idclient').val();
                                phase_produit();
                            }
                        }); 
                });
                $('#searchPdt').keyup(function(){
                   var txt = $(this).val();
                   if(txt != '')
                    {
                        // Afficher le tableau
                        $('#resultProd').css("display","block");
                        $('#resultProd').html('');
                        $.ajax({
                            url:"liveSearch_produit.php",
                            method:"post",
                            data:{search:txt},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#resultProd').html(data);
                            }
                        }); 
                    }
                   else
                    {
                        // Ne pas afficher le tableau
                        $('#resultProd').css("display","none");
                    }
               });
                
                //Ajouter dans le tableau de commande:
                $("[name='test']").click(function(){
                    alert(); 
                });
            });
            
            function phase_produit()
            {
                $('#container').css("display","none");
                $('#container2').css("display","none");
                $('#container3').css("display","block");
                // Afficher le panier:
                $.ajax({
                        url:"panier.php",
                        data:{},
                        dataType:"text",
                        success:function(data)
                        {
                            $('#Kart').html(data);
                        }
                    });
            }
            
            function clock(x)
            {
                // Recuperation du client choisit
                client = x;
                phase_produit();
                return false;
            }
            // Ajout de ligne de commande
            function ajouter_produit(id)
            {
                var qte = $("#"+id).val();
                if(qte <= 0)
                    alert("Veuillez donner une quantité valide !");
                else
                {
                    $.ajax({
                            url:"ajouter_panier.php",
                            method:"post",
                            data:{idP:id,quantite:qte,idc:client},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#Kart').html(data);
                            }
                        });
                }
            }
            // Supprimer du panier :
            function deleteFromKart(id)
            {
                $.ajax({
                        url:"deleteFromPanier.php",
                        method:"post",
                        data:{idP:id},
                        dataType:"text",
                        success:function(data)
                        {
                            $('#Kart').html(data);
                        }
                    });
            }
        </script>
    </body>