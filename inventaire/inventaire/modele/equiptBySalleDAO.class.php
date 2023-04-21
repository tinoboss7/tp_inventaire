<?php
	require_once("connexion.php");
    require_once("equiptBySalle.class.php");
	require_once("equipementDAO.class.php");
    class EquiptBySalleDAO
	{
        private $bd;
        private $select; 

		function __construct()
		{
		    $this->bd=new Connexion();
            $this->select = 'SELECT num_salle, id_equipt, qte 
							   FROM CONTIENT';
		}

        function insert (EquiptBySalle $equiptBySalle) : void {
            $this->bd->execSQL("INSERT INTO CONTIENT (num_salle, id_equipt, qte)
                                        VALUES (:numSalle, :idEquipt, :qte)"
								,[':numSalle'=>$equiptBySalle->getNumSalle(), ':idEquipt'=>$equiptBySalle->getEquipement()->getId()
									,':qte'=>$equiptBySalle->getQte() ] );
		}

		function deleteByNumSalleByIdEquipt (string $numSalle, string $idEquipt) : void	{
            $this->bd->execSQL("DELETE FROM CONTIENT WHERE num_salle = :numSalle AND id_equipt=:idEquipt"
								,[':numSalle'=>$numSalle, ':idEquipt'=>$idEquipt ] );
		}

		function deleteByNumSalle (string $numSalle) : void	{
            $this->bd->execSQL("DELETE FROM CONTIENT WHERE num_salle = :numSalle"
								,[':numSalle'=>$numSalle ] );
		}
		function deleteByIdEquipt (string $idEquipt) : void	{
            $this->bd->execSQL("DELETE FROM CONTIENT WHERE id_equit = :idEquipt"
								,[':idEquipt'=>$idEquipt ] );
		}

		function update (EquiptBySalle $equiptBySalle) : void
		{
			$this->bd->execSQL("UPDATE CONTIENT SET qte=:qte WHERE num_salle=:numSalle AND id_equipt=:idEquipt"
								,[':qte'=>$equiptBySalle->getQte(), ':numSalle'=>$equiptBySalle->getNumSalle()
									,':idEquipt'=>$equiptBySalle->getEquipement()->getId() ] );									
		}
 
		private function loadQuery (array $result) : array	{
			$equipementDAO = new EquipementDAO();
			$lesEquiptBySalle = [];
			foreach($result as $row)
			{
				$equipement = $equipementDAO->getById($row['id_equipt']);
				$lesEquiptBySalle[]= new EquiptBySalle($row['num_salle'], $equipement, $row['qte']);
			}
			return $lesEquiptBySalle;
		}

		function getAll () : array	{
			return	($this->loadQuery($this->bd->execSQL($this->select)));	
		}

		function getByNumSalle (string $numSalle) : array	{
			return	($this->loadQuery($this->bd->execSQL($this->select ." WHERE num_salle=:numSalle", [':numSalle'=>$numSalle]) ));
		}	
	
		function getByNumSalleByIdEquipt (string $numSalle, string $idEquipt) : EquiptBySalle	{
			return	($this->loadQuery($this->bd->execSQL($this->select ." AND num_salle=:numSalle AND id_equipt=:idEquipt"
									, [':numSalle'=>$numSalle, ':idEquipt'=>$idEquipt] )))[0];
		}	

    }
?>
