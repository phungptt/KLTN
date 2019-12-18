
<?php if (Yii::$app->session->hasFlash('success')): ?>
<div class="alert alert-primary alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <!-- <span class="font-weight-semibold">Thông báo!</span>  -->
    <?= Yii::$app->session->getFlash('success') ?>
</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
<div class="alert alert-danger alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <!-- <span class="font-weight-semibold">Thông báo!</span> -->
    <?= Yii::$app->session->getFlash('error') ?>
</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('warning')): ?>
<div class="alert alert-warning alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <!-- <span class="font-weight-semibold">Thông báo!</span> -->
    <?= Yii::$app->session->getFlash('warning') ?>
</div>
<?php endif; ?>
