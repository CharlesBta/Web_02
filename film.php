<?php
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
global $dbPDO;
require_once('pdo.php');

if (isset($_GET['idFilm'])) {
    $id = $_GET['idFilm'];
    $res = $dbPDO->prepare("
    SELECT titre, Genre.libelle as genre, Realisateur.prenom as prenom, Realisateur.nom as nom, dateDeSortie, description, duree FROM Film
    INNER JOIN Genre ON Film.id_genre = Genre.id
    INNER JOIN Realisateur ON Film.id_realisateur = Realisateur.id
    WHERE Film.id = :id
    ");
    $req = $res->execute([
        'id' => $id
    ]);
    $film = $res->fetch(PDO::FETCH_OBJ);

    $heures = floor($film->duree / 60);
    $minutes = $film->duree % 60;
}
?>

<!<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$film->titre?></title>
</head>
<body>
<h1><?=$film->titre?> :</h1>

<p><?=strftime("%d %B %Y", strtotime($film->dateDeSortie))?> | <?=$heures.'h '.$minutes.'min'?> | <?=$film->genre?></p>
<p>De <a href="*"><?=$film->prenom .' '. $film->nom?></a></p>
<p><strong>Synopsis : </strong><?=$film->description?></p>
</body>
</html>
