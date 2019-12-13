<?php

namespace frontend\themes\woodland;

use pantera\content\OwlCarouserAsset;
use pantera\media\widgets\syncedOwls\SyncedOwlsAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/assets';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700&amp;subset=cyrillic',
        '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'js/webslidemenu/webslidemenu.css',
        'js/webslidemenu/dropdown-effects/fade-up.css',
        // 'css/medical-theme-default.css',
        // 'css/kingcomposer.min.css',
        // 'css/medical-style.css',
        'css/mburger.css',
        'css/mmenu.css',
        'css/main.min.css',
        // 'css/responsive.css',
        //'css/colors.less',
    ];
    public $js = [
        'js/bootstrap.bundle.min.js',
        'js/svg4everybody.min.js',
        'js/webslidemenu/webslidemenu.js',
        'js/mmenu.js',
        'js/jquery.goup.min.js',
        'js/js.cookie.js',
        'js/jquery.countTo.js',
        'js/jquery.formstyler.min.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        OwlCarouserAsset::class,
        SyncedOwlsAsset::class,
    ];
    public function init()
    {
        if (!empty($_COOKIE['low-vision-mode'])) {
            $this->css[] = 'css/low-vision.css';
        }
        return parent::init();
    }
}
