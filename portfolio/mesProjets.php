<?php

include_once('classprojet.php');
include_once('classlanguage.php');
include_once('classcompetence.php');

// Créer une liste de langages
$langages = [
    new Langage("PHP"),
    new Langage("JavaScript"),
    new Langage("HTML"),
    new Langage("JS"),
    new Langage("CSS"),
    new Langage("Prestashop"),
    new Langage("Wordpress"),
    new Langage("Nicepage"),
    new Langage("C++")
];


// Créer des projets, images et langages, lien
$projets = [
    [
        "projet" => new Projet("Site Web TEPLAN", "Teplan"),
        "image" => "teplanimage.png",
        "langages" => [$langages[0], $langages[4], $langages[2]]
    ],
    [
        "projet" => new Projet("Site Web Foot", "Foot"),
        "image" => "projetfoot.png",
        "langages" => [$langages[0], $langages[4], $langages[2]]
    ],
    [
        "projet" => new Projet("Site Web Barange", "Barange"),
        "image" => "barange.png",
        "langages" => [$langages[5], $langages[4], $langages[2]]
    ],
    [
        "projet" => new Projet("Site Web Pepite-en-champagne", "pepiteenchampagne"),
        "image" => "Pepite en champagne.png",
        "langages" => [$langages[5]]
    ],
    [
        "projet" => new Projet("Site Web Portfolio", "Portfolio"),
        "image" => "Portfolio.png",
        "langages" => [$langages[0], $langages[3], $langages[2], $langages[4]]
    ],
    [
        "projet" => new Projet("Site Web CV", "cv"),
        "image" => "CVenLIGNE.png",
        "langages" => [$langages[2], $langages[4]]
    ],
    [
        "projet" => new Projet("Site Web Okazmot", "Okazmot"),
        "image" => "Okazmot.png",
        "langages" => [$langages[2], $langages[4]]
    ],
    /* projet déconne
    [
        "projet" => new Projet("Gestionnaire de mot de passe", "GestionnaireMDP"),
        "image" => "GestionnaireMDP.png",
        "langages" => [$langages[0]]
    ],
    */
    [
        "projet" => new Projet("Jeu 2d", "jeuxdev"),
        "image" => "Jeu2d.png",
        "langages" => [$langages[1], $langages[2], $langages[4]]
    ]
];



//texte HTML
$texte = "<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='css/projet.css'>
    <script src='fichier.js' async></script>
    <title>Projets</title>
</head>
<body>";


   // Liste des langages appris
   $texte .= "<div class='languages-learned'>";
   $texte .= "<h3>Langages Appris</h3><ul>";

   // Boucle affichant les langages appris
   foreach ($langages as $langage) {
       $texte .= "<li>" . $langage->getIntitule() . "</li>";
   }

   $texte .= "</ul></div>



    <div class='container2'>
        <div class='boxtitre'>
            Voici mes projets
        </div>  
    </div>


    <div class='navbar'>
        <a href='compétences.php'><input class='test' type ='button' value='Mes Compétences' ></a>
        <a href='index.html'><input class='test' type ='button' value='Accueil' ></a>
        <a href='parcours.html'><input class='test' type ='button' value='Mon Parcours' ></a>
    </div>
    
    <div class='container'>";



    //affichage de chaque projet grâce à la boucle   
    foreach ($projets as $projetData) {
        $projet = $projetData["projet"];
        $image = $projetData["image"];
        $langages = $projetData["langages"];
        
        $texte .= "
            <div class='box'>
                <p class='zoom' onClick=\"javascript:window.open('./PageProjet/Projet-" . str_replace(' ', '-', $projet->getLien()) . ".html');\">" . $projet->getIntitule() . "</p><br>
                <img class='image-moi' src='images/$image'> Langages utilisés:<br> ";

        // Afficher les langages
        $langageText = [];
        foreach ($langages as $langage) {
            $langageText[] = $langage->getIntitule();
        }
        $texte .= implode(", ", $langageText);

        $texte .= "</div>";
    }



$texte .= "
    </div>
</body>
</html>";


echo $texte;

?>