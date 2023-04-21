<?php

$op 	= (isset($_GET['op'])?$_GET['op']:null);
$ajout 	= ($op == 'a');
$modif 	= ($op == 'm');
$suppr 	= ($op == 's');
$num = (isset($_GET['num'])?$_GET['num']:null);
$id = (isset($_GET['id'])?$_GET['id']:null);
$editId = $ajout;

// accès à la page uniquement si un numéro de salle et statut opération sont passés en paramètre
if ( $num==null || ($id!=null && $ajout) || (($id=null) && $modif || $suppr) ) {
	header("location: salles.php");
} 


// équipements sélectionnables
$libelles = [];
require_once('../modele/equipementDAO.class.php');
$equipementDAO = new EquipementDAO();
$lesEquipements = $equipementDAO->getNonInventaire($num);
foreach ($lesEquipements as $unEquipt) {
	$libelles[$unEquipt->getId()] = $unEquipt->getLibelle();
}


require_once('../modele/equiptBySalleDAO.class.php');
$equiptBySalleDAO = new EquiptBySalleDAO();

// gestion des zones non modifiables en mode "modif"
$valeurs['id'] = null;
if ($modif)	{
	$valeurs['id'] 		= $id;
	$unEquiptBySalle 	= $equiptBySalleDAO->getByNumSalleByIdEquipt($num, $id);
	$valeurs['libelle'] = $unEquiptBySalle->getEquipement()->getLibelle();
}
if ($editId) {
	$valeurs['id'] = (isset($_POST['id'])?trim($_POST['id']):$valeurs['id']);
}

$erreurs = ['id'=>"", 'qte'=>""];
$valeurs['qte'] = (isset($_POST['qte'])?trim($_POST['qte']):null);

$retour = false;

require_once('../modele/salleDAO.class.php');
$salleDAO = new SalleDAO();
$uneSalle = $salleDAO->getByNum($num);
$titre = 'Salle ' .$num .' ' .$uneSalle->getLibelle() .' - ';
$titre .= (($op=='a')?'Nouvel équipement':(($op=='m')?"Edition d'une ligne d'inventaire":null));


if (isset($_POST['valider'])) {
	if (!isset($valeurs['id']) or strlen(trim($valeurs['id']))==0) 			{ $erreurs['id'] = "choix obligatoire d'un équipement"; }
	if (!isset($valeurs['qte']) or !is_numeric($valeurs['qte']) or $valeurs['qte']<1 )		{	$erreurs['qte'] = 'la quantité doit &ecirc;tre supérieur ou égal à 0';	}

 	$nbErreurs = 0;
 	foreach ($erreurs as $erreur){
 		if ($erreur != "") $nbErreurs++;
 	}
 	if ($nbErreurs == 0){
		$unEquipt 		= $equipementDAO->getById($valeurs['id']);
		$unEquiptBySalle= new EquiptBySalle($num, $unEquipt, $valeurs['qte']);
		$retour = true;
		if ($op=="a")	{
			$equiptBySalleDAO->insert($unEquiptBySalle);
		}	
		else {			
			$equiptBySalleDAO->update($unEquiptBySalle);
		}
	}
}
else if (isset($_POST['annuler']))	{
	$retour = true;
}
else if ($suppr) {
// suppression
	$equiptBySalleDAO->deleteByNumSalleByIdEquipt($num,$id);
	$retour = true;
}
else if ($modif)	{
	$unEquiptBySalle = $equiptBySalleDAO->getByNumSalleByIdEquipt ($num,$id);
// affectation de la quantité, les autres valeurs ont déjà été renseignées 
// voir en début de fichier la partie gestion des zones non modifiables en mode "modif"
	$valeurs['qte']  	= $unEquiptBySalle->getQte();
}


if ($retour)
{
	header("location: salleEquipt.php?num=$num");
}	

require_once("../vue/editSalleEquipt.view.php");
?>