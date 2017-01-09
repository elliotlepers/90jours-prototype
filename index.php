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
                <button class="back">Retour</button>
                <img class="user" src="images/icon-user.svg"/>
            </div>
        </header>
        
        <!-- Début de menu lorsque l'on clique sur icon-user -->
        <div id="menu">
            <div class="topbar">
                <h4>Mon profil</h4>
                <p>X</p>
            </div>
            <div id="profile">
                <p>Bonjour,</p>
                <div class="stat">
                    <p class="sm">Vous avez déjà réalisé</p>
                    <h3>8 défis</h3>
                </div>
                
                <button class="btn btn-sm">Tout voir</button>

                <div class="stat">
                    <p class="sm">Vous économisez</p>
                    <h3>1500 litres</h3>
                    <p class="sm number">d'eau chaque année</p>
                </div>
                
                <div class="stat">
                    <p class="sm">Vous évitez de produire</p>
                    <h3>2250 kg</h3>
                    <p class="sm number">de CO<sub>2</sub> chaque année</p>
                </div>
                
                <div class="stat">
                    <p class="sm">Vous avez gagné</p>
                    <h3>500 points</h3>
                </div>
                
                <button class="btn btn-sm">Plus</button>
                
                <div class="settings-menu">
                    <div class="settings-item">
                        <p>Je fais un break</p>
                        <p>&#9002;</p>
                    </div>
                </div>
                
                <div class="settings-menu">
                    <div class="settings-item">
                        <p>Nous contacter</p>
                        <p>&#9002;</p>
                    </div>
                    <div class="settings-item">
                        <p>Mentions légales</p>
                        <p>&#9002;</p>
                    </div>
                    <div class="settings-item">
                        <p>Paramètres</p>
                        <p>&#9002;</p>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="slider">
            <div class="section home" data-anchor="screen1">
                <div class="screen">
                    <img class="logo" src="images/logo.svg"/>
                    <p>Votre assistant personnel de transition écologique</p>
                    <button class="btn btn-next btn-light">Je me lance</button>
                </div>
            </div>
            <?php
                
                require("functions.php");
            
                $json_file = file_get_contents("data.json");
                $data = json_decode($json_file);
                $n = 1;
                $btn_next = '<button class="btn btn-next">Continuer</button>';
                foreach ($data as $name => $value) {
                    foreach ($value as $entry) {
                        $n++;
                        $classes = $entry->type.' '.$entry->status;
                        if (
                            $entry->status == "defi-accepted" or 
                            $entry->status == "learning-question" or 
                            $entry->status == "learning-lesson" or 
                            $entry->status == "defi-tutorial" or 
                            $entry->status == "defi-collectif"
                        ){
                            $classes .= " alt";
                        }
                        echo '<div class="section '.$classes.'" data-anchor="screen'.$n.'" id="slide'.$n.'">';
                        echo '<div class="screen">';
                        
                        echo '<button class="btn btn-sm btn-back">Retour</button>';
                                       
                        switch($entry->type){
                            case "tutorial":
                                $label = "Étape ".$entry->step;
                                break;
                            case "stats_indiv":
                                $label = "Statistiques";
                                break;
                            case "stats_coll":
                                $label = "Statistiques";
                                break;
                            case "stats_more":
                                $label = "Statistiques";
                                break;
                            case "question":
                                if($entry->step != ""){
                                    $label = "Question ".$entry->step;
                                } else {
                                    $label = "Question";
                                }
                                break;
                            case "defi":
                                if ($entry->status == "defi-collectif" or $entry->status == "defi-expired") {
                                    $label = "Défi collectif";
                                } else {
                                    $label = "Défi";
                                }
                                break;
                            default:
                                $label = "";
                                break;
                        }
                        
                        if($label != ""){
                            echo '<span class="label-positionner"><span class="label">'.$label.'</span></span>';
                        }
                        
                        if($entry->title != ""){
                            echo '<h3>'.$entry->title.'</h3>';
                        }
                        
                        if($entry->text != ""){
                            echo '<p>'.$entry->text.'</p>';
                        }
                        
                        if ($entry->type == "defi"){
                            
                            if ($entry->status == "defi-collectif"){
                                echo '<p class="sm">Il vous reste 8 heures et 23 minutes pour réussir ce défi.</p>';
                            } elseif ($entry->status == "defi-expired"){
                                echo '<p>Défi expiré</p>';
                            }

                            
                            if ($entry->status != "defi-expired"){
                                echo '<div class="start-btns">';
                                if ($entry->status == "defi-collectif") {
                                    echo '<button class="btn btn-start btn-feat">J\'ai réussi</button>';
                                } else {
                                    echo '<button class="btn btn-start btn-feat">Je me lance</button>';
                                }
                                echo '<button class="btn btn-success btn-next btn-feat">J\'ai réussi</button>';
                                echo '</div>';
                            }
                            
                            if (($entry->status != "defi-collectif") && ($entry->status != "defi-expired")){
                                echo '<div class="sub-btns">';
                                echo '<button class="btn btn-sm">Je le fais déjà</button>';
                                echo '<button class="btn btn-sm">Je le ferai plus tard</button>';
                                echo '<button class="btn btn-sm">Je ne le ferai jamais</button>';
                                echo '</div>';
                            }
                            
                            echo '<div class="never-btns">';
                            echo '<button class="btn btn-next btn-feat">Je me lance</button>';
                            echo '<button class="btn btn-next btn-sm">Passer définitivement</button>';
                            echo '<button class="btn btn-next btn-sm btn-red">Panic Button</button>';
                            echo '</div>';
                            
                            impact($entry->impact_water, $entry->impact_co2);
                            
                            echo '<button class="btn btn-sm btn-inline btn-more">En savoir plus</button>';

                            
                        } elseif ($entry->type == "bravo") {
                            
                            echo '<h3>Bravo !</h3>';
                            impact($entry->impact_water, $entry->impact_co2);
                            echo '<p>Partagez votre succès avec vos ami-e-s.</p>';
                            echo '<button class="btn btn-next">Partager</button><br/>';
                            echo '<button class="btn btn-sm">Continuer</button>';
                      
                        } elseif ($entry->type == "learning"){
                            
                            if ($entry->step == "") {
                                echo '<span class="label-positionner"><span class="label">Apprendre</span></span>';
                            } else {
                                echo '<span class="label-positionner"><span class="label">Étape '.$entry->step.'</span></span>';
                            }
                            if ($entry->status == "learning-waiting") {
                                echo '<button class="btn btn-feat">Je me lance</button>';
                                echo '<button class="btn btn-sm">Je le sais déjà</button>';
                                echo '<button class="btn btn-sm">Je le ferai plus tard</button>';
                                echo '<button class="btn btn-sm">Je ne le ferai jamais</button>';
                            } 
                        }
                        
                        
                        if (($entry->type != "defi") && ($entry->type != "bravo")){
                            if ($entry->button == ""){
                                echo $btn_next;
                            } else {
                                $buttons = explode(";", $entry->button);
                                foreach ($buttons as &$button) {
                                    echo '<button class="btn">'.$button.'</button><br/>';
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