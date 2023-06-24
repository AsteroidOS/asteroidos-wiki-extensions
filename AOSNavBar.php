<?php

namespace MediaWiki\Extensions\AsteroidOS;

/**
 * @var string $title
 * @var array $aosNavBar
 * @var string $aosHome
 * @var array $aosNavBarSelected
 * @var string $aosNavBarSelectedDefault
 */
?>
<div id="aosnavbar" class="noprint mw-no-invert mw-page-container">
    <div id="aosnavbarlogo">
        <p><a id="logo" href="<?= $aosHome ?>"></a></p>
    </div>
    <div id="aosnavbarmenu">
        <ul id="aosnavbarlist">
            <?php
            foreach ($aosNavBar as $name => $url) {
                if (($title == $name && in_array($name, $aosNavBarSelected))
                    || (!(in_array($title, $aosNavBarSelected)) && $name == $aosNavBarSelectedDefault)) {
                    $anbClass = ' class="anb-selected"';
                } else {
                    $anbClass = '';
                }
                ?>
            <li id="anb-<?= strtolower($name) ?>"<?= $anbClass ?>><a href="<?= $url ?>"><?= $name ?></a></li><?php
            }
            ?>
        </ul>
    </div>
</div>
