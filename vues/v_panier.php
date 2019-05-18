<img src="images/panier.gif"	alt="Panier" title="panier"/>
<img src="images/panier.jpg"	alt="Panier" title="panier"/>
<?php
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit->getId();
	$description = $unProduit->getDescription();
	$image = $unProduit->getImage();	
	$quantite = $lesQuantites[$id];
	$url ="<a href=index.php?uc=gererPanier&produit=$id&action=supprimerUnProduit>supprimer </a>";
	
	echo "
			<p><img src=".$image." alt=image width=100	height=100 />
			$description
			Quantite : $quantite
			$url
			</p>";
}
?>
<br>
<a href=index.php?uc=gererPanier&action=passerCommande>Passer la commande</a>
