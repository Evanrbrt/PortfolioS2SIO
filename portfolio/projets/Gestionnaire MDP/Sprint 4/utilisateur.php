<?php
session_start();
include_once("myparam.inc.php");
include_once("authentification.php");
include_once("controlePHP.php");

$texte = formulaire_deconnexion();
 
$texte = $texte .'
    <form action="" method="post">
        <h3>Sur quoi souhaitez-vous agir</h3>
        <label>Supprimer le compte</label><input type="radio" name="choix" value="supprCompte"><br>
        <label>Modifier le mot de passe</label><input type="radio" name="choix" value="choixMdp"><br>
        <label>Modifier le mail</label><input type="radio" name="choix" value="choixMail"><br>
        <label>Modifier le numéro</label><input type="radio" name="choix" value="choixNumero"><br>
        <input type="submit" value="Je confirme mon choix">
    </form>';



// v-------------------------- nouveau --------------------------v

$texte = $texte .'
<form action="" method="post">
    <label>Restauration</label><input type="radio" name="autreChoix" value="restauration"><br>
    <label>Purge</label><input type="radio" name="autreChoix" value="purge"><br>
    <input type="submit" value="Je confirme">
</form>';


if($_POST['autreChoix'] == "purge") {
    $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
    if (!$conn) {
        die("Erreur de connexion : " . pg_last_error());
    }

    $sqlDate = "select date_suppr from historique";
    $queryDate = pg_query($conn, $sqlDate);
    $fetchDate = pg_fetch_all($queryDate);
    if ($fetchDate >= 1) {  
        $texte = $texte .'
        
        <form action="" method="post">
            <select name="afficheApp">';
                            
                foreach($fetchDate as $value) {
                    $texte = $texte .'<option value='.$value['date_suppr'].'>'.$value['date_suppr'].'</option>';
                }
                
                $texte = $texte .'
            </select>
            <input type="submit" value="Purger" name="purger">
        </form>';
    } else {
        $texte = $texte .'Aucune date n\'est enregistrée';
    }
}

//Supprimer toutes les données
if($_POST['purger']) {
    if($_POST['afficheApp']) {

        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }
        $sqlToutSuppr = "delete from historique where date_suppr='".$_POST['afficheApp']."'";

        $queryToutSuppr = pg_query($conn, $sqlToutSuppr);
        if(!$queryToutSuppr){
            die("Erreur de suppression : " . pg_last_error());
        }
    }
}


// ^-------------------------- nouveau --------------------------^



if($_POST['choix'] == "choixMdp") {
    $texte = $texte .'
    <form action="" method="post">
        <label>Mot de passe actuel </label><input type="text" name="mdpActeul"><br>
        <label>Nouveau mot de passe </label><input type="text" name="mdpNouveau"><br>
        <input type="submit" value="Modifier" name="submit">
    </form>';
} else if($_POST['choix'] == "choixNumero") {
    $texte = $texte .'
    <form action="" method="post">
        <label>Modifier votre numéro</label><input type="radio" name="radioNumero" value="modifNumero"><br>
        <label>Supprimer votre numéro</label><input type="radio" name="radioNumero" value="supprNumero"><br>
        <input type="submit" value="Je confirme mon choix">
    </form>';
}

//Supprimer le compte
if($_POST['choix'] == "supprCompte") {
    $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
    if (!$conn) {
        die("Erreur de connexion : " . pg_last_error());
    }

// v-------------------------- nouveau --------------------------v
    $sqlNbApp = "select * from compte where id_1 = '".$_SESSION['id']."'";
    $queryNbApp = pg_query($conn, $sqlNbApp);
    if(!$queryNbApp){
        die("Erreur de select id_1 : " . pg_last_error());
    }
    $fetchNbApp = pg_fetch_all($queryNbApp);

    var_dump($fetchNbApp);

    foreach($fetchNbApp as $value) {
        
        $sqlHisto = "INSERT INTO historique values (CURRENT_TIMESTAMP, '".$_SESSION['pwd']."', '".$value['application']."', '".$value['identifiant']."', '".$value['password']."')";
        $queryHisto = pg_query($conn, $sqlHisto);
        if(!$queryHisto){
            die("Erreur d'insert dans histo : " . pg_last_error());
        }
    }
// ^-------------------------- nouveau --------------------------^


    $sqlSupprAutre = "delete from compte where id_1='".$_SESSION['id']."';";
    $querySupprAutre = pg_query($conn, $sqlSupprAutre);
    if(!$querySupprAutre){
        die("Erreur de suppression : " . pg_last_error());
    }

    $sqlSuppr = "delete from maitre where password='".$_SESSION['pwd']."';";
    $querySuppr = pg_query($conn, $sqlSuppr);
    if(!$querySuppr){
        die("Erreur de suppression : " . pg_last_error());
    }

    session_unset();
    session_destroy();
    header("Location:accueil.php");
}

//Modifier le mdp
if(isset($_POST['mdpActeul'], $_POST['mdpNouveau']) && !empty($_POST['mdpActeul']) && !empty($_POST['mdpNouveau'])) {
    if(verif_pass($_POST['mdpNouveau'])) {
        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }

        $sqlActeul = "update maitre
                        set password='".$_POST['mdpNouveau']."'
                        where password='".$_SESSION['pwd']."';";
        $queryActeul = pg_query($conn, $sqlActeul);

        if(!$queryActeul){
            die("Erreur de modification : " . pg_last_error());
        }
        $_SESSION['pwd'] = $_POST['mdpNouveau'];
    }
}

//Modifier le mail
if($_POST['choix'] == "choixMail") {
    $texte = $texte .'
    <form action="" method="post">
        <label>Nouveau mail </label><input type="text" name="modifMail"><br>
        <input type="submit" value="Modifier" name="submit">
    </form>';
}

if(isset($_POST['modifMail']) && !empty($_POST['modifMail'])) {
    if(verif_mail($_POST['modifMail'])) {
        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }

        $sqlMail = "update maitre
                    set mail='".$_POST['modifMail']."'
                    where password='".$_SESSION['pwd']."'; ";
        $queryMail = pg_query($conn, $sqlMail);
    }
}


//Modifier le numero
if($_POST['radioNumero'] == "modifNumero"){
    $texte = $texte .'
    <form action="" method="post">
        <label>Modifier le numéro </label><input type="text" name="modifNum"><br>
        <input type="submit" value="Modifier" name="submit">
    </form>';
}
if(isset($_POST['modifNum']) && !empty($_POST['modifNum'])){
    if(verif_num($_POST['modifNum'])) {
        $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
        if (!$conn) {
            die("Erreur de connexion : " . pg_last_error());
        }
        
        $sqlNum = "update maitre
                    set num='".$_POST['modifNum']."'
                    where password='".$_SESSION['pwd']."'; ";
        $queryNum = pg_query($conn, $sqlNum);
    }
}


//Supprimer le numero
if($_POST['radioNumero'] == "supprNumero"){
    $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
    if (!$conn) {
        die("Erreur de connexion : " . pg_last_error());
    }
    $sqlNumSuppr = "update maitre
                    set num=''
                    where password='".$_SESSION['pwd']."'; ";
    $queryNumSuppr = pg_query($conn, $sqlNumSuppr);
    if (!$queryNumSuppr) {
        die("Erreur de suppression de num : " . pg_last_error());
    }
}

// ------------------------- Liste déroulante -------------------------

$texte = $texte .'
    <form method="post">
        <select name="app">
            <option value="Amazon">Amazon</option>
            <option value="Fnac">Fnac</option>
            <option value="Boulanger">Boulanger</option>
            <option value="Ikea">Ikea</option>
            <option value="Action">Action</option>
            <option value="Plaza Bowling">Plaza Bowling</option>
            <option value="KFC">KFC</option>
            <option value="Burger King">Burger King</option>
            <option value="Air France">Air France</option>
            <option value="Corsair">Corsair</option>
        </select><br>

        <label>Identifiant </label><input type="text" name="identifiant"><br>
        <label>Mot de passe </label><input type="text" name="password"><br>
        <input type="submit" value="Choisir" name="submit">
    </form>';
    if(isset($_POST['app'], $_POST['identifiant'], $_POST['password']) && !empty($_POST['app']) && !empty($_POST['identifiant']) && !empty($_POST['password'])){
        if(verif_pass($_POST['password'])) {
            $conn = pg_connect('host=' . HOST . ' dbname=coffreFort user=' . USER . ' password=' . PASS);
            if (!$conn) {
                die("Erreur de connexion : " . pg_last_error());
            }
            $sqlSequence = "CREATE SEQUENCE idCompte START 1;";
            $querySequence = pg_query($conn, $sqlSequence);

            $sqlCreationCompte = "insert into compte (id, identifiant, password, application, id_1) values (nextval('idCompte'), '".$_POST['identifiant']."', '".$_POST['password']."', '".$_POST['app']."', '".$_SESSION['id']."');";
            $queryCreationCompte = pg_query($conn, $sqlCreationCompte);
            if (!$queryCreationCompte) {
                die("Erreur d'enregistrement : " . pg_last_error());
            }
        }
    }




echo $texte;


?>

<!-- 
mail modifier
mdp supprime compte ou modif le mdp
num modif et suppr -->
