<?php
    // Connexion avec la base de donnée
    $bdd = new PDO('mysql:host=localhost;dbname=gestionVentes;charset=utf8','root','root');

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
        <link rel="stylesheet" type="text/css" href="style_vendeur.css">
        <script src="jquery-3.2.1.min.js"></script>
        <style>
            #tableau,#choix,#container3
            {
                display: none;
            }
        </style>
    </head>
    <body>
        <ul>
            <li><a href='/projet_web/magasinier/verifier_stock.php'>Vérifier stock</a></li>
            <li><a href='/projet_web/magasinier/alimenter.php'>Alimenter stock</a></li>
            <li><a href='/projet_web/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
            <li><a href='/projet_web/deconnexion.php'>Se déconnecter</a></li>
        </ul>
        <br><br><br>
        <div id="container">
            <h4>Ancien fournisseur ?</h4>
            <input type="text" id="searchTxt" name="searchTxt" placeholder="nom">
            <div id="result"></div>
        </div>
        <br>
        <div id="container2">
            <div><button id="saisi">Saisir un nouveau fournisseur</button></div>
            <div><button id="choix">Chercher un ancien fournisseur</button></div>
            <div id="tableau" >
                <table >
                    <tr>
                        <td>Nom</td>
                        <td>: <input type="text" id="nom"></td>
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
                        <td>Commentaires</td>
                        <td>: <input type="text" id="comms"></td>
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
            <h5>Chercher un produit</h5>
            <div id="subContain1">
                <div id="liveSearch">
                    <input type="text" id="searchPdt" name="searchPdt" placeholder="Réf, Désignation, Catégorie">
                    <div id="resultProd"></div>
                </div>
            </div>
            <div id="subContain2">
                <h5>Saisir un nouveau produit</h5>
                <div id="tableauP" >
                    <table >
                        <tr>
                            <td>Réference</td>
                            <td>: <input type="text" min="1" id="ref"></td>
                        </tr>
                        <tr>
                            <td>Désignation</td>
                            <td>: <input type="text" min="1" id="des"></td>
                        </tr>
                        <tr>
                            <td>Prix achat</td>
                            <td>: <input type="number" min="1" id="achat"></td>
                        </tr>
                        <tr>
                            <td>Prix vente</td>
                            <td>: <input type="number" min="1" id="vente"></td>
                        </tr>
                        <tr>
                            <td>Quantité</td>
                            <td>: <input type="number" min="1" id="qte"></td>
                        </tr>
                        <tr>
                            <td>Seuil</td>
                            <td>: <input type="number" min="0" id="seuil"></td>
                        </tr>
                        <tr>
                            <td>Catégorie</td>
                            <td>: <input type="text" id="cat"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><center><button id="insererP" >Ajouter produit</button></center></td>
                        </tr>
                    </table>
                    <div id="bsala"></div>
                </div>
            </div>
            <div id="Kart"></div>
            <div>
                <a href='afficher_panier.php'><input type='submit' value='Panier' /></a>
            </div>
        </div>
        
        <script>
            var fournisseur;
            
            $(document).ready(function(){
               $('#searchTxt').keyup(function(){
                   var txt = $(this).val();
                   if(txt != '')
                    {
                        // Afficher le tableau du résultat
                        $('#result').css("display","block");
                        $('#result').html('');
                        $.ajax({
                            url:"liveSearch_fournisseur.php",
                            method:"post",
                            data:{nom:txt},
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
                //Cliquer sur le bouton de la saisi
                $('#saisi').click(function(){
                    $('#container').css("display","none");
                    $('#saisi').css("display","none");
                    $('#tableau').css("display","block");
                    $('#choix').css("display","block");
                });
                //Cliquer sur le bouton pour chercher un fournisseur
                $('#choix').click(function(){
                    $('#container').css("display","block");
                    $('#saisi').css("display","block");
                    $('#choix').css("display","none");
                    $('#tableau').css("display","none");
                });
                //Inserer le nouveau fournisseur dans la base de données
                $('#inserer').click(function(){
                    var nom = $('#nom').val();
                    var email = $('#email').val();
                    var tele = $('#tele').val();
                    var comms = $('#comms').val();
                    $.ajax({
                            url:"ajout_fournisseur.php",
                            method:"post",
                            data:{nom:nom,email:email,tele:tele,comms:comms},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#bsala').html(data);
                                //Vider les champs
                                $('#nom').val('');
                                $('#email').val('');
                                $('#tele').val('');
                                $('#comms').val('');
                                // Récuperer l'identifiant du fournisseur
                                fournisseur = $('#idfourniss').val();
                                phase_produit();
                            }
                        }); 
                });
                //Inserer un nouveau produit :
                $('#insererP').click(function(){
                    alert('ok');
                    var ref = $('#ref').val();
                    var des = $('#des').val();
                    var achat = $('#achat').val();
                    var vente = $('#vente').val();
                    var qte = $('#qte').val();
                    var seuil = $('#seuil').val();
                    var cat = $('#cat').val();
                    $.ajax({
                            url:"ajout_produit_panier.php",
                            method:"post",
                            data:{ref:ref,des:des,achat:achat,vente:vente,qte:qte,seuil:seuil,cat:cat,fournisseur:fournisseur},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#Kart').html(data);
                                //Vider les champs
                                //$('#nom').val('');
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
            });
            
            function phase_produit()
            {
                $('#container').css("display","none");
                $('#container2').css("display","none");
                $('#container3').css("display","block");
                //$('#subContain1').css("display","block");
                //$('#subContain2').css("display","none");
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
            // Choisir un fournisseur
            function clock(x)
            {
                // Recuperation du fournisseur choisit
                fournisseur = x;
                // Remplacer la variable de session du fournisseur
                $.ajax({
                        url:"choix_fournisseur.php",
                        data:{fou:x},
                        dataType:"text",
                        success:function(data)
                        {
                            
                        }
                    });
                phase_produit();
                return false;
            }
            // Ajout de ligne de commande
            function ajouter_produit(id)
            {
                var price = $("#p"+id).val();
                var qte = $("#q"+id).val();
                if(qte <= 0)
                    alert("Veuillez donner une quantité valide !");
                else
                {
                    $.ajax({
                            url:"ajouter_panier.php",
                            method:"post",
                            data:{idP:id,quantite:qte,prix:price,fournisseur:fournisseur},
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
                alert(id);
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