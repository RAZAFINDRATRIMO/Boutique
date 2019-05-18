<?php
function connexion()
{
   $hote="localhost";
   $login="root";
   $mdp="";
   $db="boutique";
   $connexion = new PDO("mysql:host=$hote;dbname=$db", $login, $mdp)or die('Erreur connexion à la base de données');
   return $connexion;
}

function getLesCategories()
{
        $lesCategories = array();
	$connexion = connexion();
	$requete = "select * from categorie";
   	$resultat = $connexion->query($requete);
        $lesLignes = $resultat->fetchAll();
   	foreach ($lesLignes as $ligne) 	
   	{   $idCategorie = $ligne["idCategorie"];
            $categorie = new Categorie($idCategorie,$ligne["libelle"]);
            $lesCategories[$idCategorie]=$categorie;
    	}
	return $lesCategories;
}

 function getLesProduits($uneCategorie)
{
        $lesProduits = array();
	$connexion = connexion();
	$requete ="select * from produit where idCategorie = '$uneCategorie'";
	$resultat = $connexion->query($requete);
        $lesLignes = $resultat->fetchAll();
   	foreach ($lesLignes as $ligne) 	
   	{
                $produit = new Produit($ligne["idProduit"],$ligne["description"],$ligne["image"], $ligne["prix"]);	
		$lesProduits[$ligne["idProduit"]] = $produit;		
 	}
	return $lesProduits;
}
function getProduit($unId)
{
        $produit = null;
	$connexion = connexion();
	$requete = "select * from produit where idProduit = '$unId'";
   	$resultat = $connexion->query($requete);
        $ligne = $resultat->fetch();
   	if ($ligne != FALSE)
   	{
    	$produit = new Produit($ligne["idProduit"],$ligne["description"],$ligne["image"], $ligne["prix"]);	
	}
	return $produit;
}
function initPanier()
{
	if(!isset($_SESSION['panier'])){
		$_SESSION['panier']= new Panier();
        }
}
function ajouterAuPanier($idProduit, $qte)
{	
	$_SESSION['panier']->ajoutItem($idProduit,$qte);	
}
function retirerDuPanier($idProduit)
{
	$_SESSION['panier']->suppressionItem($idProduit,1);
}
function getLesProduitsDuPanier()
{	$lesProduits = array();
	if (isset($_SESSION["panier"])){		
		$panier = $_SESSION["panier"]->recupPanier();		
		foreach($panier as $id => $qte)
		{
				$produit = getProduit($id);
				$lesProduits[]=$produit;
		}		
	}
	return $lesProduits;
}
function getLesQuantitesDuPanier()
{	
	$lesQuantites = array();
	if (isset($_SESSION["panier"])){	
		$panier = $_SESSION["panier"]->recupPanier();	
		foreach($panier as $id => $qte)
		{
				$lesQuantites[$id]=$qte;
		}				
	}
	return $lesQuantites;		
}
function creerCommande($nom,$rue,$cp,$ville,$mail )
{
	$connexion = connexion();
	$requete = "select max(idCommande) as maxi from commande";
        $resultat = $connexion->query($requete);
        $ligne = $resultat->fetch();
   	$idCommande = $ligne['maxi'];
   	$idCommande++;
	$date=date("Y-m-j");
   	$requete = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
   	$resultat = $connexion->query($requete);
   	$panier = $_SESSION['panier']->recupPanier();
	foreach($panier as $id=>$qte)
	{
		$requete = "insert into contenir values ('$idCommande','$id','$qte')";
		$resultat = $connexion->query($requete);
	}	
	session_destroy();
}
function estUnCp($codePostal)
{
   // Le code postal doit comporter 5 chiffres
   return strlen($codePostal)== 5 && estEntier($codePostal);
}

// Si la valeur transmise ne contient pas d'autres caract�res que des chiffres,
// la fonction retourne vrai
function estEntier($valeur)
{
   return !preg_match ("/^[^0-9]./", $valeur);
}
function estUnMail($mail)
{
$regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
return preg_match ($regexp, $mail);
}
function getErreursSaisieCommande($cp,$mail)
{
 $lesErreurs = array();
 if(!estUnCp($cp))
 	$lesErreurs[]= "erreur de code postal";
 if(!estUnMail($mail))
 	$lesErreurs[]= "erreur de mail";
 return $lesErreurs;
}

function enregAdmin()
{
	$_SESSION['admin']=1;
}
function estAdmin()
{
	if (isset($_SESSION['admin'])){
		return true;                
        }
	else {
		return false;
        }
}

function estPrix($valeur)
{
   return preg_match ("/^(-)?[0-9]+([.][0-9]+)?$/", $valeur);
}
function getErreursConnection($nom,$mdp)
{
 $lesErreurs = array();
 if(!estUnNom($nom))
 	$lesErreurs[]= "erreur de nom";
 if(!estUnMotDePasse($mdp))
 	$lesErreurs[]= "erreur de mot de passe";
 $connexion = connexion();
	$requete = "select * from administrateur where nom='$nom' and mdp='$mdp'";
   	$resultat = $connexion->query($requete);
        $ligne = $resultat->fetch();
   	if ($ligne != FALSE)
 return $lesErreurs;
}
?>