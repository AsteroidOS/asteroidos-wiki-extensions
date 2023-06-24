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
<header class="navbar navbar-inverse navbar-fixed-top docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?= $aosHome ?>" class="navbar-brand" alt="AsteroidOS">
        <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" height="50" width="50">
      </a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <?php
        foreach ($aosNavBar as $name => $url) {
            if (($title == $name && in_array($name, $aosNavBarSelected))
                || (!(in_array($title, $aosNavBarSelected)) && $name == $aosNavBarSelectedDefault)) {
                $anbClass = ' class="anb-selected"';
            } else {
                $anbClass = '';
            }
            ?>
        <li <?= $anbClass ?>>
            <a href="<?= $url ?>"><?= $name ?></a>
        </li>
        <?php
        }
        ?>
      </ul>
    </nav>
  </div>
</header>
