<?php

use kartik\form\ActiveForm;
use app\modules\app\APPConfig;
?>

<style>
    .navbar, footer {
        display: none !important;
    }

    .input-group-addon{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 0;
        color: #999;
    }

</style>
<div class="content d-flex justify-content-center align-items-center bg-white page-register">
    <?php $form = ActiveForm::begin([
        'id' => 'register-form'
    ]) ?>
    <div class="card card-body login-form py-5" style="width: 344px;">
        <div class="text-center">
            <div class="mb-3">
                <img src="<?= Yii::$app->homeUrl ?>resources/images/logo-site.png" style="max-width: 300px">
            </div>
            <h5 class="content-group text-muted font-weight-semibold"><?= Yii::t('app', 'REGISTER NEW ACCOUNT')?></h5>
        </div>

        <?= $form->field($model, 'fullname')->textInput(['placeholder' => Yii::t('app', 'Fullname')])->label(false) ?>
        <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Email')])->label(false) ?>
        <?= $form->field($model, 'password', [
                'addon' => ['append' => ['content' => '6 - 15 ' . Yii::t('app', 'words')]]
        ])->textInput(['placeholder' => Yii::t('app', 'Password'), 'type' => 'password'])->label(false) ?>
        <?= $form->field($model, 'cpassword')->textInput(['placeholder' => Yii::t('app', 'Confirm Password'), 'type' => 'password'])->label(false) ?>

        <div class="form-group">
            <div id="error" class="text-danger"></div>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" style="width: 100%" id="btn-register"><i
                        class="icon-user-plus"></i> <?= Yii::t('app', 'Register') ?>
            </button>
        </div>

        <div class="content-group">
            <div class="text-center">
                <span class="display-block text-black-50"><?= Yii::t('app', 'Already have account') ?>? <a href="login"><?= Yii::t('app', 'Login now') ?></a></span>
            </div>
        </div>

        <!-- <div class="content-divider text-muted form-group mb-1"><span class="p-2">© Copyright</span></div>
        <span class="help-block text-center no-margin"> 2019 @ <a target="_blank" href="https://hcmgis.vn/">Trung tâm Ứng dụng Hệ thống Thông tin Địa lý TP.HCM</a></span> -->
    </div>
    <?php ActiveForm::end() ?>
</div>