<?php



include_once('../classlanguage.php');
include_once('../classcompetence.php');



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

// Créer des compétences
$competences = [
    new Competence("B1-1 Gérer le patrimoine informatique", "Expérience dans la gestion du patrimoine informatique."),
    new Competence("B1-2 Répondre aux incidents et aux demandes d’assistance et d’évolution", "Expérience dans la gestion des incidents et des demandes d'assistance."),
    new Competence("B1-3 Développer la présence en ligne de l’organisation", "Expérience dans le développement de la présence en ligne de l'organisation."),
    new Competence("B1-4 Travailler en mode projet", "Expérience dans le travail en mode projet."),
    new Competence("B1-5 Mettre à disposition des utilisateurs un service informatique", "Expérience dans la mise à disposition de services informatiques aux utilisateurs."),
    new Competence("B1-6 Organiser son développement professionnel", "Expérience dans l'organisation du développement professionnel."),
    new Competence("B2R-1 Concevoir une solution d’infrastructure réseau", "Expérience dans la conception de solutions d'infrastructure réseau."),
    new Competence("B2R-2 Installer, tester et déployer une solution d’infrastructure réseau", "Expérience dans l'installation, le test et le déploiement de solutions d'infrastructure réseau."),
    new Competence("B2R-3 Exploiter, dépanner et superviser une solution d’infrastructure réseau", "Expérience dans l'exploitation, le dépannage et la supervision de solutions d'infrastructure réseau."),
    new Competence("B2D-1 Concevoir et développer une solution applicative", "Expérience dans la conception et le développement de solutions applicatives."),
    new Competence("B2D-2 Assurer la maintenance corrective ou évolutive d’une solution applicative", "Expérience dans la maintenance corrective ou évolutive de solutions applicatives."),
    new Competence("B2D-3 Gérer les données", "Expérience dans la gestion des données."),
    new Competence("B3R-1 Protéger les données à caractère personnel", "Expérience dans la protection des données à caractère personnel."),
    new Competence("B3R-2 Préserver l'identité numérique de l’organisation", "Expérience dans la préservation de l'identité numérique de l'organisation."),
    new Competence("B3R-3 Sécuriser les équipements et les usages des utilisateurs", "Expérience dans la sécurisation des équipements et des usages des utilisateurs."),
    new Competence("B3R-4 Garantir la disponibilité, l’intégrité et la confidentialité des services informatiques et des données de l’organisation face à des cyberattaques", "Expérience dans la garantie de la disponibilité, de l'intégrité et de la confidentialité des services informatiques et des données face aux cyberattaques."),
    new Competence("B3R-5 Assurer la cybersécurité d’une infrastructure réseau, d’un système, d’un service", "Expérience dans l'assurance de la cybersécurité d'une infrastructure réseau, d'un système et d'un service."),
    new Competence("B3D-1 Cybersécurité des services informatiques", "Expérience dans la cybersécurité des services informatiques."),
    new Competence("B3D-2 Protéger les données à caractère personnel", "Expérience dans la protection des données à caractère personnel."),
    new Competence("B3D-3 Préserver l'identité numérique de l’organisation", "Expérience dans la préservation de l'identité numérique de l'organisation."),
    new Competence("B3D-4 Sécuriser les équipements et les usages des utilisateurs", "Expérience dans la sécurisation des équipements et des usages des utilisateurs."),
    new Competence("B3D-5 Garantir la disponibilité, l’intégrité et la confidentialité des services informatiques et des données de l’organisation face à des cyberattaques", "Expérience dans la garantie de la disponibilité, de l'intégrité et de la confidentialité des services informatiques et des données face aux cyberattaques."),
    new Competence("B3D-6 Assurer la cybersécurité d’une solution applicative et de son développement", "Expérience dans l'assurance de la cybersécurité d'une solution applicative et de son développement.")
];

// Ajouter des langages aux compétences
$competences[0]->ajouterLangage($langages[0]); // Ajouter PHP à la première compétence
$competences[0]->ajouterLangage($langages[3]); // Ajouter JS à la première compétence

$competences[1]->ajouterLangage($langages[0]); // Ajouter PHP à la deuxième compétence
$competences[1]->ajouterLangage($langages[1]); // Ajouter JavaScript à la deuxième compétence

// ... Ajoutez d'autres langages aux compétences selon votre besoin

// Texte HTML
echo "<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../css/compétencesApprofondis.css'>
    <script src='fichier.js' async></script>
    <title>Compétences approfondis</title>
</head>
<body>
<div class='txt-accueil'>Compétences <button onclick='history. back()'>retour</button></div><br><br>";

// Tableau des compétences avec style pour l'alignement
echo "<table border='1' style='margin: 0 auto; width: 80%;'>
<tr>
    <th style='width: 25%;'>Intitulé</th>
    <th style='width: 50%;'>Détails</th>
    <th style='width: 25%;'>Langages</th>
</tr>";

// Boucle affichant les compétences
foreach ($competences as $competence) {
    echo "<tr>
        <td>" . $competence->getIntitulePrincipal() . "</td>
        <td>" . $competence->getDetails() . "</td>
        <td>";

    // Afficher les langages de la compétence
    foreach ($competence->getLangages() as $langage) {
        echo $langage->getIntitule() . ", ";
    }

    echo "</td></tr>";
}

echo "</table>";

// ... (votre code existant pour le reste de la page)

echo "</body>
</html>";

?>
