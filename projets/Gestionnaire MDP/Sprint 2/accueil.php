<?php
    session_start();
    include_once("authentification.php");
    include_once("connexion.php");

    if(isset($_SESSION['acces']) && $_SESSION['acces'] == 'oui') {
        $texte = header('Location:utilisateur.php');
    } else {
        $_SESSION['acces'] = 'non';
        $texte = formulaire_connexion();
    }
    echo $texte;
    
   
?>

