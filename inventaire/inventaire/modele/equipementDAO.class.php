<?php
	require_once("connexion.php");
    require_once("equipement.class.php");
    class EquipementDAO
	{
        private $bd;
        private $select; 

		function __construct()
		{
		    $this->bd=new Connexion();
            $this->select = 'SELECT id_equipt, lib_equipt, commentaire FROM TYPe_EQUIPT ';
		}

        function insert (Equipement $Equipement) : void {
            $this->bd->execSQL("INSERT INTO Equipement (lib_equipt, commentaire)
                                        VALUES (:libelle, :commentaire)"
								,[':libelle'=>$Equipement->getLibelle(),':commentaire'=>$Equipement->getCommentaire() ] );
		}

		function delete (string $idEquipt) : void	{
            $this->bd->execSQL("DELETE FROM Equipement WHERE id_equipt = :idEquipt"
								,[':idEquipt'=>$idEquipt ] );
		}

		function update (Equipement $Equipement) : void
		{
			$this->bd->execSQL("UPDATE Equipement SET lib_equipt=:libelle, commentaire=:commentaire WHERE id_equipt=:id"
								,[':libelle'=>$Equipement->getLIbelle(), ':commentaire'=>$Equipement->getCommentaire()
									, ':id'=>$Equipement->getId() ] );									
		}

		private function loadQuery (array $result) : array	{
			$Equipements = [];
			foreach($result as $row)
			{
				$Equipement = new Equipement();
				$Equipement->setId($row['id_equipt']);
				$Equipement->setLibelle($row['lib_equipt']);
				$Equipement->setCommentaire($row['commentaire']);
				$Equipements[] = $Equipement; 
			}
			return $Equipements;
		}

		function getAll () : array	{
			return	($this->loadQuery($this->bd->execSQL($this->select)));	
		}

		function getById (string $id) : Equipement	{
			$unEquipement = new Equipement();
      		$lesEquipements = $this->loadQuery($this->bd->execSQL($this->select ." WHERE id_equipt=:id", [':id'=>$id]) );
      		if (count($lesEquipements) > 0) { $unEquipement = $lesEquipements[0];	}	
    		return $unEquipement;
		}	
		
		function existe (string $id) : bool {
			$req 	= "SELECT *  FROM  Equipement
					   WHERE id_equipt = :id";
			$res 	= ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));	
			return ($res != []);
		}

		function getNonInventaire (string $numSalle) {
			return	($this->loadQuery($this->bd->execSQL($this->select 
			." WHERE id_equipt NOT IN (SELECT id_equipt FROM CONTIENT WHERE num_salle=:num)", [':num'=>$numSalle]) ));
		}
    }



?>
