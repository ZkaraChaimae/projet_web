<?php
// Connexion avec la base de donnée
$bdd = mysqli_connect('localhost','root','root','gestionVentes');

// Démarrer la session
session_start();
if($_SESSION['user_type'] != 'm')
    header('Location:/gestion_ventes/index.php');
/////////////////////////////////////////////////

if((isset($_SESSION['panier']) || isset($_SESSION['nv']))&& isset($_SESSION['currentFournisseur']))
{
    $datestring = date('Y-m-d');
    // Ajouter la commande
    $fournisseur = $_SESSION['currentFournisseur'];
    $employe = $_SESSION['username'];
    // Chercher le magasinier:
    $sqlMagasinier = "select id_magasinier from magasinier where id_emp = ".$employe." limit 1";
    $resultat = mysqli_query($bdd,$sqlMagasinier);
    $rowM = mysqli_fetch_assoc($resultat);
    $magasinier = $rowM['id_magasinier'];
    
    
    // Inserer la commande
    $sql = "insert into cmd_fournisseur(date_cmd,id_mag,id_fournisseur)
            values('$datestring',$magasinier,$fournisseur)";
    mysqli_query($bdd, $sql);
    $idCmd = mysqli_insert_id($bdd);//Id de la commande
    
    
    if(isset($_SESSION['panier']))
    {
        // Inserer lignes de commande :
        // Recuperer les clés du tableau :
        $keys = array_keys($_SESSION['panier']);
        $sql2 = 'select * from produit where id_produit in ('.implode(',',$keys).')';
        $result = mysqli_query($bdd, $sql2);
        // Afficher le panier
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                // Inserer LC :
                $produit = $row['id_produit'];
                $qte = $_SESSION['panier'][$produit][1];
                $prix = $_SESSION['panier'][$produit][0];
                $sql_lc = 'insert into lc_fournisseur(qte, prix_achat, id_Prod,id_cf) 
                            values('.$qte.','.$prix.','.$produit.','.$idCmd.')';
                mysqli_query($bdd, $sql_lc);
                echo $sql_lc;
                echo '<br>';
                // UPDATE la quantité dans le stock 
                $sql_update = 'update produit set qte_stock = '.$qte.' where id_produit ='.$produit;
                mysqli_query($bdd, $sql_update);
                echo $sql_update;
                echo '<br>';
            }
        }
        // Supprimer le panier:
        unset($_SESSION['panier']);
    }
    if(isset($_SESSION['nv']))
    {
        while ($keys = current($_SESSION['nv'])) 
        {
            $this_key = key($_SESSION['nv']);
            
            //1- Inserer le produit :
            $var1 = $_SESSION['nv'][$this_key][0];//des
            $var2 = $_SESSION['nv'][$this_key][1];//prix achat
            $var3 = $_SESSION['nv'][$this_key][2];//prix vente
            $var4 = $_SESSION['nv'][$this_key][3];//quantité
            $var5 = $_SESSION['nv'][$this_key][4];//seuil
            $var6 = $_SESSION['nv'][$this_key][5];//seuil
            $sqlProduit = 'insert into produit(code_produit,designation,prix_achat,prix_vente,qte_stock,seuil,id_categ) values("'.$this_key.'","'.$var1.'",'.$var2.','.$var3.','.$var4.','.$var5.','.$var6.')';
            mysqli_query($bdd, $sqlProduit);
            $produit = mysqli_insert_id($bdd);//Id du produit
            echo $sqlProduit;
            
            //2- Inserer ligne de commande :
            $sql_lc = 'insert into lc_fournisseur(qte, prix_achat, id_Prod,id_cf) 
                            values('.$var4.','.$var2.','.$produit.','.$idCmd.')';
            mysqli_query($bdd, $sql_lc);
            echo $sql_lc;
            echo '<br>';
            
            //Passer au suivant
            next($_SESSION['nv']);
        }
        // Supprimer le panier:
        unset($_SESSION['nv']);
    }
    
    // Supprimer le fournisseur:
    unset($_SESSION['currentFournisseur']);
}
?>