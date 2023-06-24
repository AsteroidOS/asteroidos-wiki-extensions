<?php

namespace MediaWiki\Extensions\AsteroidOS;

use MediaWiki\MediaWikiServices;

class Hooks
{
    public static function onBeforePageDisplay(\OutputPage &$outputPage, \Skin &$skin)
    {
        $outputPage->addModuleStyles('zzz.ext.AsteroidOS.styles');
    }

    public static function onAfterFinalPageOutput(\OutputPage $outputPage)
    {
        // Insert the navigation right after the <body> element
        $out = preg_replace(
            '/(<body[^>]*>)/s',
            '$1' . self::geAOSNavBar($outputPage->getTitle()),
            ob_get_clean()
        );

        ob_start();
        echo $out;
        return true;
    }

    private static function geAOSNavBar(string $title): string
    {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig('asteroidos');
        $aosNavBar = $config->get("AOSNavBar");
        $aosHome = $config->get("AOSHome");
        $aosNavBarSelected = $config->get("AOSNavBarSelected");
        $aosNavBarSelectedDefault = $config->get("AOSNavBarSelectedDefault");

        ob_start();
        include __DIR__ . '/AOSNavBar.php';
        return ob_get_clean();
    }
}
