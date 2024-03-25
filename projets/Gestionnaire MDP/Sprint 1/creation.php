<?php
    session_start();
    include_once("authentification.php");
    include_once("controlePHP.php");
    include_once("myparam.inc.php");


    $pass = False;
    $mail = False;
    $num = False;

    if(verif_pass($_POST['pwd'])) {
        $pass = True;
    }
    if(verif_mail($_POST['mail'])) {
        $mail = True;
    }
    if(verif_num($_POST['num'])) {
        $num = True;
    }
    
    if($pass && $mail && $num) {

        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }

        $sqlSequence = "CREATE SEQUENCE idpass START 1;";
        $querySequence = pg_query($conn, $sqlSequence);

        $sqlVal = "SELECT nextval('idpass');
                    SELECT currval('idpass');";
        $queryVal = pg_query($conn, $sqlVal);
        $affiche = pg_fetch_array($queryVal);
        $value = $affiche[0];

        $sqlInsertion = "insert into pass (id, password, mail, num) values ('".$value."', '".$_POST['pwd']."', '".$_POST['mail']."', '".$_POST['num']."')";
        $queryInsertion = pg_query($conn, $sqlInsertion);
        if(!$queryInsertion) {
            die("Erreur d'insertion : " . pg_last_error());
        }
        
        $_SESSION['pwd'] = $_POST['pwd'];
        $_SESSION['id'] = $value;
        $_SESSION['acces'] = 'oui';
        $texte = header('Location:utilisateur.php');

    } else {
        $texte = formulaire_creation();
    }

    echo $texte;

?>