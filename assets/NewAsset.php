<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.comL
 * @since 2.0
 */
class NewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'public/css/bootstrap.min.css',
    'public/css/font-awesome.min.css',
    'public/css/animate.min.css',
    'public/css/owl.carousel.css',
    'public/css/owl.theme.css',
    'public/css/owl.transitions.css',
        'public/css/style.css',
    'public/css/responsive.css',
    ];
    public $js = [
    ];
    public $depends = [

    ];
}
