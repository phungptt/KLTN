<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04-Mar-19
 * Time: 2:54 PM
 */
?>
<?php

use app\modules\app\APPConfig;
use app\modules\app\services\SiteService;
use app\modules\app\services\UserService;

?>
<style>

</style>
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header-wrap">
                    <div class="logo" id="logo"><a href="<?= Yii::$app->homeUrl ?>" title="">Dailist</a></div>
                    <!-- /.logo-->
                    <div class="nav-wrap">
                        <nav class="mainnav" id="mainnav">
                            <ul class="menu d-flex">
                                <li><a href="<?= AppConfig::getUrl('destination/destination-list') ?>" title="">Điểm đến</a></li>
                                <li><a href="<?= AppConfig::getUrl('plan/create-plan') ?>" title="">Lịch trình</a></li>
                                <li><a href="javascript:void(0)" title="">Địa điểm</a>
                                    <ul class="submenu">
                                        <li><a href="<?= AppConfig::getUrl('place/hotel-list') ?>" title="">Khách sạn</a></li>
                                        <li><a href="<?= AppConfig::getUrl('place/food-list') ?>" title="">Ăn uống</a></li>
                                        <li><a href="<?= AppConfig::getUrl('place/visit-location-list') ?>" title="">Tham quan</a></li>
                                    </ul>
                                </li>
                                <?php if(UserService::IsAdministrator()) :?>
                                <li><a href="javascript:void(0)" title="">Admin</a>
                                    <ul class="submenu">
                                        <li><a href="<?= AppConfig::getUrl('admin/destination') ?>" title="">QL Điểm đến</a></li>
                                        <li><a href="<?= AppConfig::getUrl('admin/place') ?>" title="">QL Địa điểm</a></li>
                                        <li><a href="<?= AppConfig::getUrl('admin/user') ?>" title="">QL Người dùng</a></li>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(Yii::$app->user->isGuest) :?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>site/login" title="">Đăng nhập</a></li>
                                <?php else : ?>
                                    <li class="user-menu line-center">
                                        <div class="avatar"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/user-profile.jpg"/></div><a href="javascript:void(0)" title=""><?= UserService::GetUserFullName() ?></a>
                                        <ul class="submenu">
                                            <li><a href="<?= AppConfig::getUrl('user/user-profile') ?>" title="">Trang cá nhân</a></li>
                                            <li><a href="<?= Yii::$app->homeUrl ?>site/logout" title="">Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <!-- /.mainnav-->
                        <div class="button-header"><a href="<?= AppConfig::getUrl('plan/create-plan') ?>" title=""><i class="fa fa-plus"></i>Tạo lịch trình</a></div>
                        <div class="show-search">
                            <button><span class="ti-search"></span></button>
                            <div class="submenu top-search search-header">
                                <form class="search-form" role="search" method="get" action="#">
                                    <label>
                                        <input class="search-field" type="search" placeholder="Search …" value="" name="search" />
                                    </label>
                                    <button class="search-submit-form" title="Search now"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- /.show-search-->
                        <div class="btn-menu"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

</script>