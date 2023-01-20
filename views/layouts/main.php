<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Url;

use app\assets\AppAsset;
use app\assets\NewAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

NewAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::toRoute(['site/index']);?>"><img src="/images/Miracle.jpg" alt="" width="110"></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase">
                        <?php if(Yii::$app->user->isGuest):?>
                        <li><a href="<?= Url::toRoute(['/auth/login'])?>">Login</a></li>
                        <?php else:?>
                        <li><a href="/admin">Admin panel</a>
                            <li><a href="/auth/logout">Logout</a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>


<?= $content ?>


<footer class="footer-widget-section">
    <div class="container">
    </div>
    <div class="footer-copy">
        <div class="container">
                    <div class="text-left">

                        <p> Sumy, Ukraine</p>

                        <p> Phone: +380952594370</p>

                    </div>
                    <div class="text-center">&copy; 2023 <a href="#">Miracle, <a> Andrii Beldiiev</a>
                    </div>


        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
