<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04-Mar-19
 * Time: 2:55 PM
 */
use app\modules\app\APPConfig;
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="widget widget-about">
                    <div class="logo-ft"><a href="#" title="">Dailylist</a></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-categories">
                    <h3 class="widget-title">Danh mục</h3>
                    <ul class="one-half">
                        <li><a href="<?= AppConfig::getUrl('place/visit-location-list') ?>" title="">Địa điểm</a></li>
                        <li><a href="<?= AppConfig::getUrl('place/food-list') ?>" title="">Ăn uống</a></li>
                        <li><a href=""<?= AppConfig::getUrl('place/hotel-list') ?>" title="">Khách sạn</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-contact">
                    <h3 class="widget-title">Liên hệ</h3>
                    <ul class="contact-infomation">
                        <li class="address">Thành phố Hồ Chí Minh</li>
                        <li class="phone">(84) 89 931 6904</li>
                        <li class="email">dailist.support@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-map"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/bg-ft.png" alt="" /></div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="social-ft">
                    <li><a href="#" title=""><i class="ti-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" title=""><i class="ti-twitter-alt" aria-hidden="true"></i></a></li>
                    <li><a href="#" title=""><i class="ti-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" title=""><i class="ti-google" aria-hidden="true"></i></a></li>
                    <li><a href="#" title=""><i class="ti-pinterest" aria-hidden="true"></i></a></li>
                </ul>
                <div class="copyright">© 2017 Copyright by Deercreative. All rights reserved.</div>
            </div>
        </div>
    </div>
</div>