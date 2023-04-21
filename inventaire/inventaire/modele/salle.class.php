<?php
    class Salle
	{
		private $num;
		private $libelle;
		private $etage;

		function __construct(string $num='', string $libelle='', string $etage='') {
			$this->num		= $num;
			$this->libelle	= $libelle;
			$this->etage	= $etage;
		}

		function getNum		() : string			{ return $this->num; 		}
		function setNum		(string $num)		{ $this->num=$num; 			}
		function getLibelle	() : string			{ return $this->libelle; 	} 
		function setLibelle	(string $libelle)	{ $this->libelle=$libelle; 	}		
		function getEtage	() : string			{ return $this->etage; 		}
		function setEtage	(string $etage)		{ $this->etage=$etage; 		}

	}
?>
