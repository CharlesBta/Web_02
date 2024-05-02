<?php
global $dbPDO;
require_once('pdo.php');
?>

<!<!doctype html>
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
    <title>Web_02</title>
</head>
<body>
<?php
    $res = $dbPDO->prepare("
    SELECT Film.id as id, titre, Genre.libelle as genre, Realisateur.prenom as prenom, Realisateur.nom as nom, YEAR(dateDeSortie) as dateDeSortie FROM Film
    INNER JOIN Genre ON Film.id_genre = Genre.id
    INNER JOIN Realisateur ON Film.id_realisateur = Realisateur.id
    WHERE dateDeSortie BETWEEN '2010-01-01' AND '2019-12-31'
    ");
    $req = $res->execute();
?>
<h1>Liste des meilleurs films des années 2010 :</h1>
<ul>
    <?php
        foreach ($res->fetchAll(PDO::FETCH_CLASS) as $film) {
            echo "
            <li>
            <a href='film.php?idFilm=$film->id'>$film->titre</a> ($film->genre de $film->prenom $film->nom, $film->dateDeSortie)
            </li>
            ";
        }
    ?>
</ul>
</body>
</html>