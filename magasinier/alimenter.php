<?php
    // Connexion avec la base de donnée
    $bdd = new PDO('mysql:host=localhost;dbname=gestionVentes;charset=utf8','root','root');
    $reponse = $bdd->query("select * from fournisseur");
    $reponse2 = $bdd->query("select * from produit");
    $categories = $bdd->query("select * from categorie");
    // Démarrer la session
    session_start();
    if($_SESSION['user_type'] == 'm')
        echo "Bienvenue employé numéro : ".$_SESSION['username'];
    else header('/var/www/html/gestion_ventes/index.php');
?>

<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet" type="text/css" href="style_magasinier.css">
</head> 
<body>
    <ul>
        <li><a href='verifier_stock.php'>Vérifier stock</a></li>
        <li><a href='/gestion_ventes/magasinier/alimenter.php'>Alimenter stock</a></li>
        <li><a href='/gestion_ventes/magasinier/bon_livraison.php'>Etablir bon de livraison</a></li>
        <li><a href='/gestion_ventes/deconnexion.php'>Se déconnecter</a></li>
    </ul>
    
    <form id="alimenter_stock" method="POST" action="">
        <input type="hidden" id="choix_fournisseur" name="choix_fournisseur" value=""/>
            <div id="phase11">
                <table border=1>
                    <th>Choisir le fournisseur : </th>
                    <tr>
                        <td>
                            <select id="f_existant" name="f_existant" onchange="return getnameFournisseur()">
                                <option value="">Selectionner</option>
                                <?php while($donnees = $reponse->fetch())   
                                { ?>
                                <option value=" <?php echo $donnees['id_fournisseur'] ?> "> <?php echo $donnees['nom'] ?> </option>
                        <?php    }?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><button onclick="return saisir_f()">Ou bien saisir un nouveau fournisseur</button></td></tr>
                </table>
                <p id="test" ></p>
            </div>
            </br></br></br>
            <div id="phase12">
                <table border='1'>
                    <th colspan=2>Saisir un fournisseur</th>
                    <tr>
                        <td>nom :</td>
                        <td><input type="text" id="nom" name="nom"/></td>
                    </tr>
                    <tr>
                        <td>email :</td>
                        <td><input type="email" id="email" name="email"/></td>
                    </tr>
                    <tr>
                        <td>telephone :</td>
                        <td><input type="tel" id="tele" name="tele"/></td>
                    </tr>
                    <tr>
                        <td>commentaires :</td>
                        <td><input type="text" id="comms" name="comms"/></td>
                    </tr>
                    <tr><td colspan=2><button onclick="return choisir_f()">Ou bien choisir un fournisseur existant</button></td></tr>
                </table>
                </br></br>
            </div>
            <button id="endPhase1" onclick="return fin_phase1()">Continuez</button>
        
            <div id="phase21">
                <input type="hidden" id="choix_produit" name="choix_produit" value="" />
                <table border=1>
                    <th colspan=2>Choisir un produit : </th>
                    <tr><td colspan=2><select id="p_existant" name="p_existant" onchange="return getProduitInfos()">
                            <option value="">code et désignation</option>
                            <?php 
                                while($donnees2 = $reponse2->fetch())
                                {
                            ?>
                            <option value="<?php echo $donnees2['id_produit']; ?>"><?php echo $donnees2['code_produit'].' '.$donnees2['désignation']; ?></option>
                            <?php } ?>
                        </select></td></tr>
                    <tr>
                        <td>prix d'achat :</td>
                        <td><input type="text" id="prixAchat2" name="prixAchat2"/></td>
                    </tr>
                        <!-- return : pour ne pas rafraishir la page -->
                    <tr><td colspan=2><button colspan=2 onclick="return saisir_p()">Ou bien saisir un nouveau produit</button></td></tr>
                </table>
            </div>
            
            <div id="phase22">
                <table border=1>
                    <th colspan=2>Saisir un produit : </th>
                    <tr>
                        <td>code produit :</td>
                        <td><input type="text" id="codeP" name="codeP"/></td>
                    </tr>
                    <tr>
                        <td>désignation :</td>
                        <td><input type="text" id="designation" name="designation"/></td>
                    </tr>
                    <tr>
                        <td>catégorie</td>
                        <td>
                            <select id="cat" name="cat">
                                <option value="">Selectionner une catégorie</option>
                                <?php 
                                    while($donnees3 = $categories->fetch())
                                    { ?>
                                        <option value="<?php echo $donnees3['id_categorie']; ?>"><?php echo $donnees3['intitule']; ?></option>
                                    <?php } ?>
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>prix d'achat :</td>
                        <td><input type="text" id="prixAchat" name="prixAchat"/></td>
                    </tr>
                    <tr>
                        <td>prix de vente :</td>
                        <td><input type="text" id="prixVente" name="prixVente"/></td>
                    </tr>
                    <tr>
                        <td>seuil d'alimentation :</td>
                        <td><input type="text" id="seuil" name="seuil"/></td>
                    </tr>
                        <!-- return : pour ne pas rafraishir la page -->
                    <tr><td colspan=2><button onclick="return choisir_p()">Ou bien choisir un produit existant</button></td></tr>
                </table>
            </div>
                <table id="qteBlock">
                    <th>Quantité : </th>
                    <tr>
                        <td><input type="text" id="qte" name="qte"/></td>
                    </tr>
                </table>
            <button id="endPhase2" onclick="return fin_phase2()">Continuez</button>
            
    </form>
    
    <div id="afficher_toutes_infos">
        <p>Ici, nous allons afficher l'ensemble des infos que l'utilisateur à saisit, et nous allons les afficher dans cette partie.</p>
        <table border=1>
            <tr>
                <td colspan=2>fournisseur : </td>
                <td id="aff_fourn"></td>
            </tr>
            <tr>
                <td colspan=2>Produit : </td>
                <td id="aff_codeP"></td>
            </tr>
            <tr>
                <td colspan=2>Prix d'achat : </td>
                <td id="aff_prixA"></td>
            </tr>
            <tr>
                <td colspan=2>Quantité achetée : </td>
                <td id="aff_qte"></td>
            </tr>
            <tr>
                <td colspan=3><button onclick="return Modifier()">Modifier</button></td>
            </tr>
        </table>
    </div>
    <button id="validate" onclick="return valider_form()">Valider</button>
    <script>
    var y,z;
    var f_existant,nom,email,tel,comms,tour1=11;
    var p_existant,prixA2;code,desi,prixV,prixA,seuil,qteRecup,tour2=21;
    function _(x)
    {
        return document.getElementById(x);
    }
    function getnameFournisseur()
    {
        var x = document.getElementById("f_existant").options.selectedIndex;
        y = document.getElementById("f_existant").options[x].innerHTML;
        return false;
    }
    function getProduitInfos()
    {
        var x = document.getElementById("p_existant").options.selectedIndex;
        z = document.getElementById("p_existant").options[x].innerHTML;
        return false;
    }
    function saisir_f()
    {
        f_existant = _("f_existant").value;
        nom = '';
        email = '';
        tel = '';
        comms = '';
        // le tour de la phase 12
        tour1 = 12;
        _("phase11").style.display = "none";
        _("phase12").style.display = "block";
        return false;
    }
    function choisir_f()
    {
        f_existant = '';
        nom = _("nom").value;
        email = _("email").value;
        tel = _("tele").value;
        comms = _("comms").value;
        // Le tour à la phase 11
        tour1 = 11;
        _("phase11").style.display = "block";
        _("phase12").style.display = "none";
        return false;
    }
    
    function fin_phase1()
    {   tour2=21;
        qteRecup='';
        var fournisseur = document.getElementById("aff_fourn");
        // Récuperer les inputs
        if(tour1 == 11)
        {
            // Choisir fournisseur de la base de données
            _("choix_fournisseur").value = "choisir";
            f_existant = _("f_existant").value;
            nom = '';
            email = '';
            tel = '';
            comms = '';
            fournisseur.innerHTML = y;
            //fournisseur.innerHTML = _("nomfourniss").value;
        }
        if(tour1 == 12)
        {
            // Saisir un nouveau fournisseur
            _("choix_fournisseur").value = "saisir";
            f_existant = '';
            nom = _("nom").value;
            email = _("email").value;
            tel = _("tele").value;
            comms = _("comms").value;
            fournisseur.innerHTML = nom;
        }
        if(f_existant.length == 0 && nom.length==0 
            && email.length==0 && tel.length == 0 && comms.length == 0)
            alert('Veuillez saisir tous les champs !');
        else
        {
            // Affichage
            _("phase11").style.display = "none";
            _("phase12").style.display = "none";
            _("endPhase1").style.display = "none";
            _("phase21").style.display = "block";
            _("qteBlock").style.display = "block";
            _("endPhase2").style.display = "block";
        }
        return false;
    }
    
    function saisir_p()
    {
        p_existant = _("p_existant").value;
        prixA2 = _("prixAchat2").value;
        code = '';
        desi = '';
        prixV = '';
        prixA = '';
        seuil = '';
        // le tour de la phase 22
        tour2 = 22;
        _("phase21").style.display = "none";
        _("phase22").style.display = "block";
        return false;
    }
    function choisir_p()
    {
        p_existant = '';
        prixA2 = '';
        code = _("codeP").value;
        desi = _("designation").value;
        prixV = _("prixVente").value;
        prixA = _("prixAchat").value;
        seuil = _("seuil").value;
        // le tour de la phase 21
        tour2 = 21;
        _("phase21").style.display = "block";
        _("phase22").style.display = "none";
        return false;
    }
    
    function fin_phase2()
    {
        var produit = document.getElementById("aff_codeP");
        var prix_achat = document.getElementById("aff_prixA");
        var qte_prod = document.getElementById("aff_qte");
        qteRecup = _("qte").value;
        // Récuperer les inputs
        if(tour2 == 21)
        {
            // Choisir un produit
            _("choix_produit").value = "choisir";
            p_existant = _("p_existant").value;
            prixA2 = _("prixAchat2").value;
            code = '';
            desi = '';
            prixV = '';
            prixA = '';
            seuil = '';
            produit.innerHTML = z;
            prix_achat.innerHTML = prixA2;
            qte_prod.innerHTML = qteRecup;
        }
        if(tour2 == 22)
        {
            // Saisir un nouveau produit
            _("choix_produit").value = "saisir";
            p_existant = '';
            prixA2 = '';
            code = _("codeP").value;
            desi = _("designation").value;
            prixV = _("prixVente").value;
            prixA = _("prixAchat").value;
            seuil = _("seuil").value;
            produit.innerHTML = code+" "+desi;
            prix_achat.innerHTML = prixA;
            qte_prod.innerHTML = qteRecup;
        }
        if(p_existant.length == 0 && prixA2.length == 0 
            && code.length == 0 && desi.length == 0 
            && prixV.length == 0 && prixA.length == 0 
            && seuil.length == 0 && qteRecup.length == 0)
            alert('Veuillez saisir tous les champs !');
        else if(prixA.length == 0 && prixA2.length == 0)
            alert('Veuillez saisir tous les champs !');
        else if(qteRecup.length == 0)
            alert('Veuillez saisir tous les champs !');
        else
        {
            // Affichage
            _("phase21").style.display = "none";
            _("phase22").style.display = "none";
            _("qteBlock").style.display = "none";
            _("endPhase2").style.display = "none";
            _("afficher_toutes_infos").style.display = "block";
            _("validate").style.display = "block";
        }
        return false;
    }
    
    function Modifier()
    {
        // Affichage
        _("phase11").style.display = "block";
        _("phase12").style.display = "none";
        _("endPhase1").style.display = "block";
        _("phase21").style.display = "none";
        _("endPhase2").style.display = "none";
        _("phase21").style.display = "none";
        _("phase22").style.display = "none";
        _("qteBlock").style.display = "none";
        _("endPhase2").style.display = "none";
        _("afficher_toutes_infos").style.display = "none";
        _("validate").style.display = "none";
    }
    
    function valider_form()
    {
        _("alimenter_stock").method = "post";
        _("alimenter_stock").action = "alimenter_server.php";
        _("alimenter_stock").submit();
    }
    </script>
</body>
</html>
 
