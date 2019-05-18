<ul id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie->getId();
	$libCategorie = $uneCategorie->getLibelle();
	$url ="<a href=index.php?uc=voirProduits&idCategorie=$idCategorie&action=voirProduits> $libCategorie </a>";
	echo "<li>".$url."</li>\n";
}
?>
</ul>
