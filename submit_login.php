<?php
session_start();
global $dbPDO;
require('pdo.php');
$post = $_POST;
if (isset($post['email']) && isset($post['password'])) {
    try {
        $resultat = $dbPDO->prepare("SELECT * FROM Users WHERE email = :email");
        $req = $resultat->execute([
            'email' => $post['email']
        ]);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $rows = $resultat->rowCount();

    if ($rows > 0) {
        echo "<pre>L'utilisateur a bien été trouvé</pre>";
        $user = $resultat->fetch();
        if ($user['password'] === sha1($post['password'])) {
            echo "<pre>Le mot de passe est correct</pre>";
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit();
        } else {
            echo "<pre>Le mot de passe est incorrect</pre>";
            header('Location: login.php');
        }
        header('Location: dashboard.php');
    } else {
        echo "<pre>Aucun user trouvé</pre>";
        header('Location: login.php');
    }

    header('Location: login.php');
    exit();

} else {
    echo "ko";
    header('Location: register.php');
    exit();
}
?>