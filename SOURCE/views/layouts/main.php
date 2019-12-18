<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\modules\contrib\gxassets\GxVueAsset;
use app\assets\AppAsset;
use app\modules\app\APPConfig;
use app\modules\contrib\gxassets\GxTemplateAsset;
use app\modules\contrib\widgets\FlashMessageWidget;

GxTemplateAsset::register($this);
GxVueAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>resources/images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=  APPConfig::$CONFIG['siteName'] ?></title>
    <?php $this->head() ?>
    <script>
        var APP = {};
        new WOW().init();
    </script>
</head>

<body cz-shortcut-listen="true">
    <?php $this->beginBody() ?>
    <!-- Main header navbar -->
    <?= $this->render('header') ?>
    <!-- /main header navbar -->


    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <?= FlashMessageWidget::widget() ?>
            <?= $content ?>
        </div>
        <!-- /main content -->

    </div>

    <!-- /page container -->
    <!-- Page Footer -->

    <!-- /Page Footer -->
    <?php $this->endBody() ?>
    <?= $this->render('footer'); ?>
</body>

</html>
<?php $this->endPage(); ?>