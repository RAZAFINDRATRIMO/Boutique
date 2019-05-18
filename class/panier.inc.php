<?PHP
class Panier 
{
    private $panier;

	// constructeur
	function __construct()
	{ 	
		$this->panier = array();
	}
	// ajouter un article 
	public function ajoutItem($refProduit,$nb) 
	{
            if (isset($this->panier[$refProduit])) {
                    $this->panier[$refProduit] += $nb;
            }
            else {
                    $this->panier[$refProduit] = $nb;
            }
	}	
	// supprimer un article 
	public function suppressionItem($refProduit,$nb) 
	{
		$this->panier[$refProduit] -= $nb;
		if ($this->panier[$refProduit] <= 0) {
			unset ($this->panier[$refProduit]);
                }
	}			
	// renvoit les références et les quantites
	public function recupPanier()
	{
		return $this->panier;
	}
} // fin de la classe
?>