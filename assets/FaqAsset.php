<?php

namespace ando\faq\assets;

use yii\web\AssetBundle;

/**
 * Class FaqAsset
 * @package ando\faq\assets
 */
class FaqAsset extends AssetBundle
{
    public $sourcePath = '@ando/faq/resources';
    public $css = [
        'faq.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
