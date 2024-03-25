<?php

    function verif_pass($mdp) {
        if(isset($_POST['submit'])) {
            if(empty($mdp)) {
                echo 'Le mot de passe est obligatoire <br>';
            } else {
                $longueur = strlen($mdp);
                // Verification longueur
                $longueur_correcte = False;
                if ($longueur >= 12)
                    {
                        $longueur_correcte = True;
                    }		
                if(!$longueur_correcte)
                    {
                        echo 'Le mot de passe est trop court <br>';		
                    }

                // Verification presence minuscule
                $presence_minuscule = False;
                $presence_majuscule = False;
                $presence_caractere = False;
                
                for ($i = 0; $i< $longueur; $i++)
                    {
                        $v = $mdp[$i];
                        if ($v >='a' && $v <='z')
                        {
                            $presence_minuscule = True;
                        } 
                        else if ($v >='A' && $v <='Z')
                        {
                            $presence_majuscule = True;
                        }
                        else if ($v =='!' || $v =='?' || $v =='_' || $v =='*' || $v ==',')
                        {
                            $presence_caractere = True;
                        }
                        else if ($v >= 0 && $v <= 9)
                        {
                            $presence_chiffre = True;
                        }
                    }
                if(!$presence_minuscule){
                    echo 'il faut au moins une minuscule <br>';			
                }

                if(!$presence_majuscule){
                    echo 'il faut au moins une majuscule <br>';			
                }

                if(!$presence_caractere){
                    echo 'il faut au moins un caractere spécial <br>';			
                }
                if(!$presence_chiffre){
                    echo 'il faut au moins un chiffre <br>';			
                }

                if($presence_caractere && $presence_majuscule && $presence_minuscule && $longueur_correcte && $presence_chiffre){
                    $passok = True;
                } else {
                    $passok = False;
                }
                
                return $passok;

            }
        }
    }

    function verif_mail($mail) {
        if(isset($_POST['submit'])) {
            if(empty($mail)) {
                echo 'Le mail est obligatoire <br>';
            } else {
                $longueur = strlen($mail);

                $presence_point = False;
                $presence_arobase = False;

                for ($i = 0; $i< $longueur; $i++)
                {
                    $v = $mail[$i];
                    if ($v =='.')
                    {
                        $presence_point = True;
                    } 
                    else if ($v =='@')
                    {
                        $presence_arobase = True;
                    }
                }
                if(!$presence_point){
                    echo 'il faut au moins un point <br>';			
                }
                if(!$presence_arobase){
                    echo 'il faut au moins un arobase <br>';			
                }

                if($presence_point && $presence_arobase){
                    $mailok = True;
                } else {
                    $mailok = False;
                }

                return $mailok;

            }
        }
    }

    function verif_num($num) {
        if(isset($_POST['submit'])) {
            if(empty($num)) {
                echo 'Le numéro est obligatoire <br>';
            } else {
                $longueur = strlen($num);

                $longueur_correcte = False;
                if ($longueur == 10) {
                    $longueur_correcte = True;
                }		
                if(!$longueur_correcte) {
                    echo 'Le numéro doit comporter 10 chiffres <br>';		
                }

                if($longueur_correcte){
                    $numok = True;
                } else {
                    $numok = False;
                }
                return $numok;
            }
        }
    }
?>