<?php

function impact($impact_water, $impact_co2, $display_type){    
    if ($impact_water != "" or $impact_co2 != "") {
        echo '<div class="impact">';
        if ($display_type == "multiple"){
            echo '<p class="sm">Tous ensemble, ';            
        } else {
            echo '<p class="sm">Grâce à ce défi, ';                        
        }
        if ($impact_water != ""){
            if ($display_type == "multiple"){
                echo 'nous économisons<br />'.$impact_water.' litres d\'eau';
            } else {
                echo 'vous économisez<br />'.$impact_water.' litres d\'eau';
            }
        }
        if ($impact_water != "" && $impact_co2 != ""){
            echo " et ";
        }
        if ($impact_co2 != ""){
            if ($display_type == "multiple"){
                echo 'nous évitons de produire<br />'.$impact_co2.' kg de CO<sub>2</sub>';
            } else {
                echo 'vous évitez de produire<br />'.$impact_co2.' kg de CO<sub>2</sub>';
            }
        }
        echo ' par an.';
        echo '</p>';
        echo '</div>';
    }
}

?>