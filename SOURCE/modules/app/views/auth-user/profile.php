<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24-Jan-19
 * Time: 3:27 PM
 */

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use app\modules\app\PathConfig;
use app\modules\contrib\auth\UserService;

$pageData = [
    'pageTitle' => 'Dự án của tôi',
    'unsetBreadcrumbElements' => true,
];
?>

<?= $this->render(PathConfig::getAppViewPath('tagPageHeader'), $pageData); ?>

<!-- Page content -->
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thông tin cá nhân</h5>
                </div>
                <hr class="my-1">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-information']) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'fullname')->textInput([])->label('Họ tên') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'sex')->dropDownList([0 => 'Nam', 1 => 'Nữ'])->label('Giới tính') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'birthday')->widget(DatePicker::className(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-M-yyyy',
                                    'todayHighlight' => true
                                ]
                            ])->label('Ngày sinh') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'phone')->textInput(['type' => 'tel'])->label('Số điện thoại') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'address')->textInput([])->label('Địa chỉ') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userInfo, 'organization')->textInput([])->label('Đơn vị công tác') ?>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                </div>
                <hr class="my-1">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-account']) ?>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="text" name="AuthUser[username]" class="form-control" title="Email" value="<?= $user->username ?>" readonly autocomplete="username">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="AuthUser[current-password]" class="form-control" title="Mật khẩu">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="new-password">Mật khẩu mới</label>
                            <input type="password" name="AuthUser[password]" class="form-control" title="Mật khẩu mới" autocomplete="new-password">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="re-password">Xác nhận mật khẩu</label>
                            <input type="password" name="AuthUser[re-password]" class="form-control" title="Xác nhận mật khẩu" autocomplete="re-password">
                        </div>
                        <div class="col-md-12 form-group">
                            <button id="change-password" class="btn btn-primary">Thay đổi</button>
                            <span class="error-message text-danger"></span>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center bg-teal-400">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle" src="<?= Yii::$app->homeUrl ?>/resources/images/image.png" width="170" height="170" alt="">
                        <div class="card-img-actions-overlay card-img rounded-circle">
                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple">
                                <i class="icon-plus3"></i>
                            </a>
                        </div>
                    </div>

                    <h6 class="font-weight-semibold mb-0"><?= $userInfo->fullname ?></h6>
                    <span class="d-block"><?= $userInfo->organization ? $userInfo->organization : '' ?></span>

                    <div class="list-icons list-icons-extended mt-3">
                        <a href="<?= $userInfo->phone ? $userInfo->phone : '#' ?>" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Phone"><i class="icon-phone"></i></a>
                        <a href="<?= $user->username ?>" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Email"><i class="icon-mail5"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between my-2">
                        <span>Ngày tạo:</span>
                        <span><?= $user->created_at ?></span>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <span>Đăng nhập gần nhất:</span>
                        <span><?= UserService::getNearestLogin() ?></span>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="<?= Yii::$app->homeUrl ?>site/logout"><i class="icon-switch"></i> Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page content -->
<script>
    $("#change-password").click(function(e){
        e.preventDefault();
        var form = $("#form-account").serialize();
        var url = '<?= Yii::$app->homeUrl ?>contrib/auth/auth-user/change-password';
        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            success: function (resp) {
                $(".error-message").empty().append(resp);
            }
        })
    })
</script>