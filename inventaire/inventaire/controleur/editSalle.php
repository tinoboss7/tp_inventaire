<?php

$op 	= (isset($_GET['op'])?$_GET['op']:null);
$ajout 	= ($op == 'a');
$modif 	= ($op == 'm');
$suppr 	= ($op == 's');
$num 	= (isset($_GET['num'])?$_GET['num']:null);
$editNum= $ajout;

// accès à la page uniquement si un numéro de salle et statut opération sont passés en paramètre
if ( ($num!=null && $ajout) || (($num=null) && $modif || $suppr) ) {
	header("location: salles.php");
} 

// étages valides
$etages = ['RdC'=>'RdC',1=>'1',2=>'2',3=>'3'];

require_once('../modele/salleDAO.class.php');
$salleDAO = new SalleDAO();

// gestion des zones non modifiables en mode "modif"
$valeurs['num'] = null;
if ($modif)	{
	$valeurs['num'] = $num;
	$uneSalle = $salleDAO->getByNum($valeurs['num']);
}
if ($editNum) {
	$valeurs['num'] = (isset($_POST['num'])?trim($_POST['num']):$valeurs['num']);
}


$titre = (($ajout)?'Nouvelle Salle':(($modif)?"Salle - édition des informations":null));

$erreurs = ['num'=>"", 'libelle'=>'', 'etage'=>""];
$valeurs['libelle'] = (isset($_POST['libelle'])?trim($_POST['libelle']):null);
$valeurs['etage'] = (isset($_POST['etage'])?trim($_POST['etage']):null);

$retour = false;
	
if (isset($_POST['valider'])) {
	if (!isset($valeurs['num']) or strlen($valeurs['num'])==0) 	{ $erreurs['num']	= 'saisie obligatoire du numéro';	}
	else if ($editNum and $salleDAO->existe($valeurs['num'])) 	{ $erreurs['num'] 	= 'Numéro de salle déjà existant.';	}
	if (!isset($valeurs['etage']) or strlen($valeurs['etage'])==0 or !in_array($valeurs['etage'],$etages,true)) { 
		$erreurs['etage'] = 'Etage non valide.'; 
	}


 	$nbErreurs = 0;
 	foreach ($erreurs as $erreur){
 		if ($erreur != "") $nbErreurs++;
 	}
 	if ($nbErreurs == 0){
		$uneSalle = new Salle($valeurs['num'],$valeurs['libelle'], $valeurs['etage']);
		$retour = true;
		if ($ajout)	{
			$salleDAO->insert($uneSalle);
		}	
		else {			
			$salleDAO->update($uneSalle);
		}
	}
}
else if (isset($_POST['annuler']))	{
	$retour = true;
}
else if ($suppr) {
// suppression
	$salleDAO->delete($num);
	$retour = true;
}
else if ($modif)	{
	$uneSalle = $salleDAO->getByNum($num);
	$valeurs['num']		= $uneSalle->getNum();
	$valeurs['libelle'] = $uneSalle->getLibelle();		
	$valeurs['etage'] 	= $uneSalle->getEtage();		
}


if ($retour)
{
	header("location: salles.php");
}	

require_once("../vue/editSalle.view.php");
?>