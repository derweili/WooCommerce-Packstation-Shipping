<?php

function derweili_packstation_popup(){
    ?>

    <div id="derweili-packstation-popup-bg"></div>
    <div id="derweili-packstation-popup">
        <h2>Packstation finden</h2>
        <form id="packstation-finder-address">
            <label for="packstation-finder-address-input">
                Postleitzahl eingeben
             </label>
            <input type="text" id="packstation-finder-address-input" />
            <button type = "submit">Suchen</button>
        </form>
        <div class="results" id="packstation-finder-results">
            

        </div>
    </div>

    <?php
}

add_action('wp_footer', 'derweili_packstation_popup');