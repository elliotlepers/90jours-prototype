<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 


        <title>90jours proto</title>
		<meta name="description" content="" />

		<meta property="og:type" content="website">
		<meta property="og:title" content="90jours proto" />
	

		<link rel="shortcut icon" href="images/favicon.png"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" href="css/jquery.fullpage.css">
		<link rel="stylesheet" href="css/animate.css">
		<script src="js/modernizr.custom.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script src="https://use.typekit.net/upl5bju.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
		
	</head>
	<body>
        
        <header>
            <div class="topbar">
                <img class="burger" src="images/icon-burger.svg"/>
                <img class="user" src="images/icon-user.svg"/>
            </div>
        </header>
        
        <div class="slider">
            <div class="section home" data-anchor="screen1">
                <div class="screen">
                    <img class="logo" src="images/logo.svg"/>
                    <p>Votre assistant personnel de transition écologique</p>
                    <button class="btn btn-light">Je me lance</button>
                </div>
            </div>
            <?php
                $json_file = file_get_contents("data.json");
                $data = json_decode($json_file);
                $n = 1;
                $btn_next = '<button class="btn">Continuer</button>';
                $btn_next_white = '<button class="btn btn-light">Continuer</button>';
                foreach ($data as $name => $value) {
                    foreach ($value as $entry) {
                        $n++;
                        echo '<div class="section '.$entry->type.' '.$entry->status.'" data-anchor="screen'.$n.'">';
                        echo '<div class="screen">';
                        if ($entry->type == 'tutorial'){
                            echo '<span class="label-positionner"><span class="label">Étape '.$entry->step.'</span></span>'; 
                        } elseif ($entry->type == "tomorrow") {
                            echo '<span class="label-positionner"><span class="label">À demain</span></span>';
                        } elseif ($entry->type == "success_defi" or $entry->type == "success_learning") {
                            echo '<span class="label-positionner"><span class="label">Succès</span></span>';
                        } elseif ($entry->type == "stats_indiv" or $entry->type == "stats_coll" or $entry->type == "stats_more") {
                            echo '<span class="label-positionner"><span class="label">Statistiques</span></span>';
                        } elseif ($entry->type == "share") {
                            echo '<span class="label-positionner"><span class="label">Partager</span></span>';
                        }
                        
                        if ($entry->type == 'question' && $entry->step != "" ){
                            echo '<span class="label-positionner"><span class="label">Question '.$entry->step.'</span></span>';
                        }  elseif ($entry->type == 'question') {
                            echo '<span class="label-positionner"><span class="label">En savoir plus sur vous</span></span>';
                        }
                        
                        if ($entry->status == "defi-accepted" or $entry->status == "learning-question" or $entry->status == "learning-lesson" or $entry->status == "defi-tutorial" or $entry->status == "defi-collectif") {
                            echo '<h3 class="white">'.$entry->title.'</h3>';
                            echo '<p class="white">'.$entry->text.'</p>';
                        } else {
                            echo '<h3 class="green">'.$entry->title.'</h3>';
                            echo '<p class="green">'.$entry->text.'</p>';
                        }
                        
                        if ($entry->type == "defi"){
                            if ($entry->status == "defi-collectif" or $entry->status == "defi-expired") {
                                 echo '<span class="label-positionner"><span class="label">Défi collectif</span></span>';
                            } else {
                                 echo '<span class="label-positionner"><span class="label">Défi</span></span>';
                            }
                            if ($entry->status == "defi-waiting") {
                                echo '<button class="btn btn-feat">Je me lance</button>';
                                echo '<button class="btn btn-sm">Je le fais déjà</button>';
                                echo '<button class="btn btn-sm">Je le ferai plus tard</button>';
                                echo '<button class="btn btn-sm">Je ne le ferai jamais</button>';
                                if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.<br />J\'éviterai aussi de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                } elseif ($entry->impact_water != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.</p>';
                                } elseif ($entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'éviterai de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                };
                                echo '<button class="btn btn-sm">En savoir plus</button>';
                            } elseif ($entry->status == "defi-accepted"){
                                echo '<button class="btn btn-feat btn-light">J\'ai réussi</button>';
                                echo '<button class="btn btn-sm btn-light">Je le fais déjà</button>';
                                echo '<button class="btn btn-sm btn-light">Je le ferai plus tard</button>';
                                echo '<button class="btn btn-sm btn-light">Je ne le ferai jamais</button>';
                                if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.<br />
                                    J\'éviterai aussi de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                } elseif ($entry->impact_water != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.</p>';
                                } elseif ($entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'éviterai de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                };
                                echo '<button class="btn btn-sm btn-light">En savoir plus</button>';
                            } elseif ($entry->status == "defi-collectif"){
                                echo '<button class="btn btn-feat btn-light">J\'ai réussi</button>';
                                echo '<p class="impact">Il vous reste '.$entry->time_left.' pour réussir ce défi.</p>';
                                if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.<br />
                                    J\'éviterai aussi de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                } elseif ($entry->impact_water != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'économiserai<br />'.$entry->impact_water.' L d\'eau par an.</p>';
                                } elseif ($entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'éviterai de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                };
                                echo '<button class="btn btn-sm btn-light">En savoir plus</button>';
                            } elseif ($entry->status == "defi-expired"){
                                echo '<p>Défi expiré</p>';
                                if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'aurais économisé<br />'.$entry->impact_water.' L d\'eau par an.<br />
                                    J\'aurais aussi évité de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                } elseif ($entry->impact_water != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'aurais économisé<br />'.$entry->impact_water.' L d\'eau par an.</p>';
                                } elseif ($entry->impact_co2 != "") {
                                    echo '<p class="impact">Grâce à ce défi, j\'aurais évité de produire<br />'.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                                };
                                echo '<button class="btn btn-sm">En savoir plus</button>';
                                echo $btn_next;
                            } elseif ($entry->status == "defi-never") {
                                echo '<button class="btn btn-feat">Je me lance</button>';
                                echo '<button class="btn btn-sm">Passer définitivement</button>';
                                echo '<button class="btn btn-sm btn-red">Panic Button</button>';
                            } elseif($entry->step != "") {
                                echo '<p class="white">'.$entry->text.'</p>';
                                echo $btn_next;
                            } else {
                                echo $btn_next;
                            };
                        } elseif ($entry->type == "success_defi") {
                            if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                echo '<p>Vous économisez '.$entry->impact_water.' L d\'eau et évitez de produire '.$entry->impact_co2.' kg de CO<sub>2</sub> chaque année.</p>';
                            } elseif ($entry->impact_water != "") {
                                echo '<p>Vous économisez '.$entry->impact_water.' L d\'eau par an.</p>';
                            } elseif ($entry->impact_co2 != "") {
                                echo '<p>Vous évitez de produire '.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                            };
                            echo $btn_next;
                        } elseif ($entry->type == "learning"){
                            if ($entry->step == "") {
                                echo '<span class="label-positionner"><span class="label">Apprendre</span></span>';
                            } else {
                                echo '<span class="label-positionner"><span class="label">Etape '.$entry->step.'</span></span>';
                            }
                            if ($entry->status == "learning-waiting") {
                                echo '<button class="btn btn-feat">Je me lance</button>';
                                echo '<button class="btn btn-sm">Je le sais déjà</button>';
                                echo '<button class="btn btn-sm">Je le ferai plus tard</button>';
                                echo '<button class="btn btn-sm">Je ne le ferai jamais</button>';
                            } elseif ($entry->status == "learning-question"){
                                $buttons = explode(";", $entry->button);
                                foreach ($buttons as &$button) {
                                    echo '<button class="btn btn-light">'.$button.'</button>';
                                }
                            } elseif ($entry->status == "learning-lesson") {
                                echo $btn_next_white;
                            };
                        } elseif ($entry->type == "success_defi") {
                            if ($entry->impact_water != "" && $entry->impact_co2 != "") {
                                echo '<p>Vous économisez '.$entry->impact_water.' L d\'eau et évitez de produire '.$entry->impact_co2.' kg de CO<sub>2</sub> chaque année.</p>';
                            } elseif ($entry->impact_water != "") {
                                echo '<p>Vous économisez '.$entry->impact_water.' L d\'eau par an.</p>';
                            } elseif ($entry->impact_co2 != "") {
                                echo '<p>Vous évitez de produire '.$entry->impact_co2.' kg de CO<sub>2</sub> par an.</p>';
                            };
                            echo $btn_next;
                        } elseif ($entry->type == "stats_indiv") {
                            echo '<p>Vous économisez chaque année</p><h3 class="green">'.$entry->impact_water.' L d\'eau</h3>';
                            echo '<p>Et vous évitez aussi de produire<p><h3 class="green">'.$entry->impact_co2.' kg de CO<sub>2</sub></h3>';
                            echo $btn_next;
                        } elseif ($entry->type == "stats_coll") {
                            echo '<p>Tous ensemble, Vous économisez chaque année<p><h3 class="green">'.$entry->impact_water.' L d\'eau</h3>';
                            echo '<p>Et vous évitez aussi de produire</p><h3 class="green">'.$entry->impact_co2.' kg de CO<sub>2</sub></h3>';  
                            echo $btn_next;
                        } elseif ($entry->type == "stats_more") {
                            echo '<p>Vous avez ouvert l\'appli</p><h3 class="green">'.$entry->opening_days.' jours de suite</h3>';
                            echo '<p>Et avez invité</p><h3 class="green">'.$entry->invited_ppl.' personnes</h3>';
                            echo $btn_next;
                        } elseif ($entry->button == "" && $entry->status == "defi-accepted" or $entry->status == "learning-question" or $entry->status == "learning-lesson" or $entry->status == "defi-tutorial" or $entry->status == "defi-collectif"){
                            echo $btn_next_white;
                        } elseif ($entry->button == "") {
                            echo $btn_next;
                        } else {
                            if ($entry->status == "defi-accepted" or $entry->status == "learning-question" or $entry->status == "learning-lesson" or $entry->status == "defi-tutorial" or $entry->status == "defi-collectif") {
                                $buttons = explode(";", $entry->button);
                                foreach ($buttons as &$button) {
                                    echo '<button class="btn btn-light">'.$button.'</button>';
                                }
                            }
                            else {
                                $buttons = explode(";", $entry->button);
                                foreach ($buttons as &$button) {
                                    echo '<button class="btn">'.$button.'</button>';
                                }
                            }
                        }
                        
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>

        </div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/jquery.easing.js"></script>
		<script src="js/jquery.fullpage.extensions.min.js"></script>
		<script src="js/main.js"></script>
        
	</body>
</html>