<?php
global $dbPDO;
require('pdo.php');
$post = $_POST;
if (isset($post['email']) && isset($post['password'])) {
    echo "ok";
    try {
        $resultat = $dbPDO->prepare("
        INSERT INTO Users (`id`, `email`, `password`) VALUES (NULL, :email, SHA1(:password));
        ");
        $req = $resultat->execute([
            'email' => $post['email'],
            'password' => $post['password']
        ]);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $rows = $resultat->rowCount();

    if ($rows > 0) {
        header('Location: login.php');
        exit();
    } else {
        header('Location: register.php');
        exit();
    }
} else {
    header('Location: register.php');
    exit();
}
?>