<?php
	require_once("../modele/equipement.class.php");
	class EquiptBySalle
	{
		private $numSalle;
		private $equipement;
		private $qte;

		function __construct(string $numSalle='', Equipement $equipement=null, int $qte=0) {
			$this->numSalle 	= $numSalle;
			$this->equipement	= $equipement;
			$this->qte 	   		= $qte;
		}

		function getNumSalle   	() : string			    { return $this->numSalle;	    	}
		function setNumSalle    (string $numSalle)		{ $this->numSalle=$numSalle;        }
		function getEquipement  () : Equipement			{ return $this->equipement;		    }
		function setEquipement  (Equipement $equipement){ $this->equipement=$equipement;    }
		function getQte		    () : int			    { return $this->qte; 		        }
		function setQte		    (int $qte)		    	{ $this->qte=$qte; 			        }		
	}
?>