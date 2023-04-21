<html>
<head>
<meta charset="utf-8">
<title><?php echo $titre ?></title>
<link rel="stylesheet" href="../vue/style/style.css">
</head>
<body>
<?php require_once('../vue/header.php'); ?>

<section>
    <label></label>
    <h1><?php echo $titre ?></h1>     
</section>

<form name="add" action="" method="post">
<section>
    <label  for="num">Numéro :</label>
    <div>
        <?php 
        if ($editNum) { 
        ?>
            <!-- htmlentities nécessaire pour les chaînes de caractères 
            sinon la chaîne est tronquée à l'affichage à la première guillement ou première quote rencontrée
            -->
            <input  id="num" name="num" type="text" size="5" maxlength="5" value="<?= htmlentities($valeurs['num']) ?>" />
	        <br/>
            <span   class="erreur"><?= $erreurs['num'] ?></span>
        <?php 
         } 
        else echo($valeurs['num']); 
        ?>  
    </div>
</section>

<section>
    <label  for="libelle">Désignation :</label>
	<div>
        <input  id="libelle" name="libelle" type="text" size="30" maxlength="30" 
                value="<?= htmlentities($valeurs['libelle']) ?>" />
	    <br />
        <span   class="erreur"><?= $erreurs['libelle'] ?></span>
    </div>
</section>

<section>
    <label  for="etage">Etage :</label>
    <div>
        <select name = "etage" />
        <?php
            foreach ($etages as $cle=>$valeur){
                echo "<option value='$cle'";
                if ($cle == $valeurs['etage']) {
                    echo ' selected';
                }
                echo ">", $valeur, "</option>";
            }
        ?>
        </select>
        <br />
        <span   class="erreur"><?= $erreurs['etage'] ?></span>
    </div>
</section>

<section>
    <label>&nbsp;</label>
    <div>
        <input type="submit" id="valider" name="valider" value="Valider" />
        &emsp;
        <input type="submit" id="annuler" name="annuler" value="Annuler" />
    </div>
</section>

</form>

</body>
</html>