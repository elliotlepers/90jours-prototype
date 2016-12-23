<?php

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

} 


?>