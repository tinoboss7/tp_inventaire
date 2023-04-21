<html>
<head>
<meta charset="utf-8">
<title>Liste des salles</title>
<link rel="stylesheet" href="../vue/style/style.css">
</head>
<body>
<?php require_once('../vue/header.php'); ?>

<section>
    <label></label>
    <h1>Liste des salles</h1>
</section>

<section>
    <label></label>
    <table border="1" class='table_salle'>
    <tr><th>Numéro</th><th>Désignation</th><th>Etage</th><th>Equipements</th>
        <th></th>
        <th></th>
    </tr>

    <?php
    foreach($lignes as $ligne) {
        echo $ligne; // tableau de lignes à créer dans /controleur/salles.php
    }
    ?>

    <tr><td colspan="7"></td></tr>
    <tr><td colspan="7" style="text-align:right" ><a href="editSalle.php?op=a" class="ajout">Ajouter une salle</a></td></tr>

    </table>
</section>

</body>
</html>