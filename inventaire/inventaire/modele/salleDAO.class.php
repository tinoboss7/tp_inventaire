<?php
	require_once("connexion.php");
    require_once("salle.class.php");
    class SalleDAO
	{
        private $bd;
        private $select; 

		function __construct()
		{
		    $this->bd=new Connexion();
            $this->select = 'SELECT num_salle, lib_salle, etage FROM SALLE ';
		}

        function insert (Salle $salle) : void {
            $this->bd->execSQL("INSERT INTO SALLE (num_salle, lib_salle, etage)
                                        VALUES (:num, :libelle, :etage)"
								,[':num'=>$salle->getNum(), ':libelle'=>$salle->getLibelle()
									,':etage'=>$salle->getEtage() ] );
		}

		function delete (string $num) : void	{
            $this->bd->execSQL("DELETE FROM SALLE WHERE num_salle = :num"
								,[':num'=>$num ] );
		}

		function update (Salle $salle) : void
		{
			$this->bd->execSQL("UPDATE SALLE SET lib_salle=:libelle, etage=:etage WHERE num_salle=:num"
								,[':libelle'=>$salle->getLibelle(), ':etage'=>$salle->getEtage()
									,':num'=>$salle->getNum() ] );									
		}

		private function loadQuery (array $result) : array	{
			$salles = [];
			foreach($result as $row)
			{
				$salle = new Salle();
				$salle->setNum($row['num_salle']);
				$salle->setLibelle($row['lib_salle']);
				$salle->setEtage($row['etage']);
				$salles[] = $salle; 
			}
			return $salles;
		}

		function getAll () : array	{
			return	($this->loadQuery($this->bd->execSQL($this->select)));	
		}

		function getByNum (string $num) : Salle	{
			$uneSalle = new Salle();
			$lesSalles = $this->loadQuery($this->bd->execSQL($this->select ." WHERE num_salle=:num", [':num'=>$num]) );
			if (count($lesSalles)>0) { $uneSalle = $lesSalles[0]; }
			return $uneSalle;
		}	
		
		function existe (string $num) : bool {
			$req 	= "SELECT *  FROM  SALLE
					  WHERE num_salle = :num";
			$res 	= ($this->loadQuery($this->bd->execSQL($req,[':num'=>$num])));
			return ($res != []);
		}

		function getTotalNbEquipt(string $numSalle) : int {	
			// renvoie la quantité totale d’équipements d’une salle
			$res = $this->bd->execSQL("SELECT SUM(qte) as total FROM CONTIENT WHERE num_salle=:numSalle", [':numSalle'=>$numSalle]);
			return (isset($res[0]['total']))?$res[0]['total']:0;	 
		}
    }
?>
