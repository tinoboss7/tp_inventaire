<?php
    class Equipement
	{
		private $id;
		private $libelle;
		private $commentaire;

		function __construct(string $id='', string $libelle='', string $commentaire='') {
			$this->id	    	=$id;
			$this->libelle		=$libelle;
			$this->commentaire	=$commentaire;
		}

		function getId	    	() : string			    { return $this->id;		        	}
		function setId	    	(string $id)			{ $this->id=$id;	        		}
		function getLibelle 	() : string			    { return $this->libelle; 			}
		function setLibelle 	(string $libelle)		{ $this->libelle=$libelle; 			}
		function getCommentaire	() : ?string			{ return $this->commentaire; 		}   // '?' : gestion valeur nulle possible dans la table
		function setCommentaire	(?string $commentaire)	{ $this->commentaire=$commentaire;  }		
	}
?>