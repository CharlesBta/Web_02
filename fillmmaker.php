<?php
global $dbPDO;
require_once('pdo.php');
$id = $_GET['idRealisateur'];

$res = $dbPDO->prepare("
SELECT Realisateur.id as id, nom, prenom, nationalite FROM Realisateur
WHERE Realisateur.id = :id
");
$req = $res->execute([
    'id' => $id
]);
$realisateur = $res->fetch(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jersey+15&display=swap');
        h1 {
            font-family: "Jersey 15", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <title><?=$realisateur->prenom.' '.$realisateur->nom?></title>
</head>
<body>
<h1><?=$realisateur->prenom.' '.$realisateur->nom.' :'?></h1>
<p><strong>Nationalité</strong> : <?=$realisateur->nationalite?></p>
<p><strong>Filmographie</strong> :</p>
<ul>
    <?php
    $res = $dbPDO->prepare("
    SELECT Film.id as id, titre, YEAR(Film.dateDeSortie) as annee  FROM Film
    WHERE Film.id_realisateur = :id
    ORDER BY Film.dateDeSortie 
    ");
    $req = $res->execute([
        'id' => $id
    ]);

    foreach ($res->fetchAll(PDO::FETCH_CLASS) as $film) {
        echo "<li><a href='film.php?idFilm=$film->id'>$film->titre</a> $film->annee</li>";
    }
    ?>
</ul>
</body>
</html>
