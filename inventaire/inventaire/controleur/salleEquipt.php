<?php
$num = (isset($_GET['num'])?$_GET['num']:null);

// accès à la page uniquement si un numéro de salle est passé en paramètre
if ($num==null) {
	header("location: salles.php");
} 

require_once('../modele/salleDAO.class.php');
$salleDAO = new SalleDAO();
$uneSalle = $salleDAO->getByNum($num);
$titre  = $num .' ' .$uneSalle->getLibelle();

// liste des equipements de la salle
require_once('../modele/equiptBySalleDAO.class.php');
$equiptBySalleDAO = new EquiptBySalleDAO();
$lesEquiptsBySalle = $equiptBySalleDAO->getByNumSalle($num);
$lignes	= [];
foreach($lesEquiptsBySalle as $unEquiptBySalle)
{	
    $unEquipt = $unEquiptBySalle->getEquipement();
    $ch = '';
    $ch .= '<td>' .$unEquipt->getId() .'</td>';
    $ch .= '<td>' .$unEquipt->getLibelle() .'</td>';
	$ch .= '<td>' .$unEquiptBySalle->getQte() .'</td>';

	$ch .='<td><a href="editSalleEquipt.php?op=m&num=' .urlencode($num) .'&id=' .urlencode($unEquipt->getId()) .'" ><img src="../vue/style/modification.png"></a></td>';
    $ch .= '<td><a href="editSalleEquipt.php?op=s&num=' .urlencode($num) .'&id=' .urlencode($unEquipt->getId()) .'" ><img src="../vue/style/corbeille.png"></a></td>';
 
	$lignes[] = "<tr>$ch</tr>";
}

require_once('../vue/salleEquipt.view.php');