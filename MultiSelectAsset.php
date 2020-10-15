<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace totocsa;

use yii\web\View;

class MultiSelectAsset extends \yii\web\AssetBundle {

    public $forceCopy = true;
    public $sourcePath = '@vendor/totocsa/yii2-multiselect/assets';
    public $css = [
        'css/multiselect.css',
    ];
    public $js = [
        ['js/multiselect.js'],
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

}
