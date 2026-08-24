<?php

namespace MediaWiki\Extensions\AsteroidOS;

use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

class Hooks
{
    public static function onBeforePageDisplay(\OutputPage &$outputPage, \Skin &$skin)
    {
        $outputPage->addModuleStyles('zzz.ext.AsteroidOS.styles');
        $outputPage->addModules('zzz.ext.AsteroidOS.scripts');
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

    public static function onSkinAddFooterLinks(\Skin $skin, string $key, array &$footerlinks)
    {
        if ($key === 'places') {
            self::addFooterLink($skin, $footerlinks, 'asteroidos-code-of-conduct');
            self::addFooterLink($skin, $footerlinks, 'asteroidos-terms-of-service');
        }
    }

    /**
     * Add a footer link from the "<$id>-page" and "<$id>-desc" messages.
     */
    private static function addFooterLink(\Skin $skin, array &$footerlinks, string $id): void
    {
        $page_msg = $skin->msg("$id-page");
        $desc_msg = $skin->msg("$id-desc");
        if (!$page_msg->exists() || !$desc_msg->exists()) {
            return;
        }

        $link_target = Title::newFromText($page_msg->inContentLanguage()->text());
        if ($link_target === null) {
            return;
        }

        $linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
        $footerlinks[$id] = $linkRenderer->makeLink($link_target, $desc_msg->text());
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
