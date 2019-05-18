<?php
if (isset($_REQUEST['action'])) {
	$action = $_REQUEST['action'];
} else {
	$action = 'connection';
}
switch($action){
        case 'connexion' :
                include("vues/v_connexion.php");
                break;
        case 'verifConnexion' :
                $nom =$_REQUEST['nom'];
                $mdp =$_REQUEST['mdp'];
                $msgErreurs = getErreursConnection($nom,$mdp);
                if (count ($msgErreurs) != 0){
                    include ("vues/v_connexion.php");
                    include ("vues/v_erreurs.php");
                }
                else{
                    $lesCategories = getLesCategories();
                    include("vues/v_categoriesAdmin.php");
                }
                break;
            }
?>