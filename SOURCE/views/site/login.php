<?php

use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use app\modules\app\APPConfig;

// use yii\authclient\widgets\AuthChoice;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
?>

<style>
    .navbar, footer {
        display: none !important;
    }
</style>

<div class="content d-flex justify-content-center align-items-center bg-white bg-light">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form'
    ]); ?>
    <div class="card card-body login-form py-5" style="width: 364px;">
        <div class="text-center">
            <div class="mb-3">
                <img src="<?= Yii::$app->homeUrl ?>resources/images/logo-site.png" style="max-width: 300px">
            </div>
            <h5 class="content-group text-muted font-weight-semibold"><?= Yii::t('app', 'LOGIN TO SYSTEM')?></h5>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Password')])->label(false) ?>
        </div>

        <div class="form-group d-flex align-items-center">
            <a href="#" class="ml-auto"><?= Yii::t('app', 'Forget Password') ?>?</a>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block legitRipple"><?= Yii::t('app', 'Login') ?> <i class="icon-circle-right2 ml-2"></i></button>
        </div>

        <div class="content-group">
            <div class="text-center">
                <span class="display-block text-black-50"><?= Yii::t('app', 'Don\'t have account') ?>? <a href="register"><?= Yii::t('app', 'Register now') ?></a></span>
            </div>
        </div>

        <!-- <div class="content-divider text-muted form-group mb-1"><span class="p-2">HOẶC</span></div> -->

        <!-- <div class="content-divider text-muted form-group mb-1"><span class="p-2">© Copyright</span></div>
        <span class="help-block text-center no-margin"> 2019 @ <a target="_blank" href="https://hcmgis.vn/">Trung tâm Ứng dụng Hệ thống Thông tin Địa lý TP.HCM</a></span> -->
    </div>
    <?php ActiveForm::end(); ?>
</div>