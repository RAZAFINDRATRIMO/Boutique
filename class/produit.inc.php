<?PHP
class Produit {
	private $id;
	private $description;
	private $image;
	private $prix;

	// constructeur
	function __construct($unId, $uneDescription, $uneImage, $unPrix){ // constructeur
		$this->id = $unId;
		$this->description = $uneDescription;
		$this->image = $uneImage;
		$this->prix = $unPrix;
	}
	// accesseur
	public function getId(){
		return $this->id ;
	}
	public function getDescription(){
		return $this->description;
	}	
	public function getImage(){
		return $this->image ;
	}
	public function getPrix(){
		return $this->prix ;
	}
} // fin de la classe
?>