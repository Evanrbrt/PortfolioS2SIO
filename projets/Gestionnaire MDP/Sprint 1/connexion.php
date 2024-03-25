<?php
    session_start();
    include_once("myparam.inc.php");

    if(isset($_POST['pass']) && !empty($_POST['pass'])) {
        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }

        $acces = False;

        $sqlConnexion = "select id, password from pass";
        $queryConnexion = pg_query($conn, $sqlConnexion);
        $fetchConnexion = pg_fetch_all($queryConnexion);
        foreach($fetchConnexion as $value) {
            if ($value['password'] == $_POST['pass']) {
                $_SESSION['pwd'] = $_POST['pass'];
                $_SESSION['id'] = $value['id'];
                $_SESSION['acces'] = 'oui';
                $acces = True;
            }
        }
        if($acces == False) {
            echo "Accès refusé";
        }

}


?>