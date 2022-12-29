<?php
function dump($obj, $die = true) {
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';

    $die ? die() : null;
}
