<?php

use app\modules\api\APIConfig;
use app\modules\app\AppConfig;
use app\modules\contrib\gxassets\GxVueAsset;

GxVueAsset::register($this);
?>

<div id="home-page">
    <section class="page-title style2 parallax parallax1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-heading">Khám Phá Những Nơi Tuyệt Vời</div>
                    <div class="text-heading">Tìm kiếm top những địa điểm ăn uống, khách sạn</div>
                    <div class="wrap-box-search">
                        <form action="#" method="get" accept-charset="utf-8"><span>
                                <input type="text" placeholder="Bạn đang tìm kiếm điều gì ?" name="search"></span><span class="location"><span class="ti-location-pin"></span>
                                <input type="text" placeholder="Điểm đến" name="location"></span><span class="categories"><span class="ti-angle-down"></span>
                                <select name="categories">
                                    <option value="">Tất cả</option>
                                    <option value="">Địa điểm</option>
                                    <option value="">Ăn, uống</option>
                                    <option value="">Khách sạn</option>
                                </select></span>
                            <button class="search-btn" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="flat-row flat-imagebox style5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-row-title center">
                        <h2>Điểm Đến Nổi Bật</h2>
                        <p>Những điểm đến bạn phải đi trong mùa hè này</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="imagebox style5">
                            <div class="box-image"><img :src="topDes[0].path" alt="" style="height: 370px;">
                                <div class="overlay"></div>
                            </div>
                            <div class="box-content line-center"><a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + topDes[0].slug" title="">{{topDes[0].name}}</a></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="imagebox style5">
                            <div class="box-image"><img :src="topDes[1].path" alt="" style="height: 175px;">
                                <div class="overlay"></div>
                            </div>
                            <div class="box-content line-center"><a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + topDes[1].slug" title="">{{topDes[1].name}}</a></div>
                        </div>
                        <div class="height20"></div>
                        <div class="imagebox style5">
                            <div class="box-image"><img :src="topDes[2].path" alt="" style="height: 175px;">
                                <div class="overlay"></div>
                            </div>
                            <div class="box-content line-center"><a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + topDes[2].slug" title="">{{topDes[2].name}}</a></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="imagebox style5">
                            <div class="box-image"><img :src="topDes[3].path" alt="" style="height: 175px;">
                                <div class="overlay"></div>
                            </div>
                            <div class="box-content line-center"><a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + topDes[3].slug" title="">{{topDes[3].name}}</a></div>
                        </div>
                        <div class="height20"></div>
                        <div class="imagebox style5">
                            <div class="box-image"><img :src="topDes[4].path" alt="" style="height: 175px;">
                                <div class="overlay"></div>
                            </div>
                            <div class="box-content line-center"><a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + topDes[4].slug" title="">{{topDes[4].name}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-row flat-imagebox background" id="food-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-row-title center">
                        <h2>Những địa điểm tuyệt vời</h2>
                        <p>Khám phá các điểm vui chơi tuyệt vời và phù hợp</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4" v-for="location in topLocation.slice(0,3)">
                            <div class="imagebox">
                                <div class="box-imagebox">
                                    <div class="box-header">
                                        <div class="box-image"><img :src="location.path" alt=""><a href="#" title="">Xem</a>
                                            <div class="overlay"></div>
                                            <div class="queue">
                                                <star-rating :value="location.rating_avg"></star-rating>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-header-->
                                    <div class="box-content">
                                        <div class="box-title ad"><a href="#" title="">{{location.name}}</a></div>
                                        <ul class="rating">
                                            <li>{{location.rating_count}} lượt đánh giá</li>
                                            <li v-if="location. place_type == 1">Ăn uống</li>
                                            <li v-if="location. place_type == 2">Tham quan</li>
                                            <li v-if="location. place_type == 0">Khách sạn</li>
                                        </ul>
                                        <div class="box-desc">{{location.short_description}}</div>
                                    </div>
                                    <!-- /.box-content-->
                                    <div class="location">
                                        <div class="address"><i class="fas fa-map-marker-alt"></i>{{location.name_destination}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-row flat-iconbox style1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-row-title center">
                        <h2>Tại Sao Phải Chọn Chúng Tôi ?</h2>
                        <p>Dailist giúp bạn tìm kiếm mọi thứ bạn mong muốn.</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="iconbox style1">
                                <div class="box-header">
                                    <div class="iconbox-icon"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/iconbox-03.png" alt=""></div>
                                </div>
                                <div class="box-content">
                                    <h4 class="box-title">Chọn Thứ Để Làm</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="iconbox style1">
                                <div class="box-header">
                                    <div class="iconbox-icon"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/iconbox-02.png" alt=""></div>
                                </div>
                                <div class="box-content">
                                    <h4 class="box-title">Tìm Thứ Bạn Muốn</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="iconbox style1">
                                <div class="box-header">
                                    <div class="iconbox-icon"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/iconbox-01.png" alt=""></div>
                                </div>
                                <div class="box-content">
                                    <h4 class="box-title">Khám Phá Các Địa Điểm Tuyệt Vời</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-row flat-text-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-title center">
                        <h2>Mang đến cho bạn những điều tuyệt vời nhất</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-row flat-main-blog flat-imagebox style3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-row-title center">
                        <h2>Lịch trình gợi ý</h2>
                    </div>
                    <div class="wrap-imagebox style1">
                        <div class="imagebox style3" v-for="plan in planList">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image">
                                        <img :src="plan.des_path" alt="" class="w-100">
                                        <a title="">
                                            <i aria-hidden="true" class="fas fa-map-marked-alt" style=" color: white; font-size: 36px;">
                                            </i>
                                        </a>
                                        <div class="overlay"></div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-content">
                                    <div class="box-title ad">
                                        <a :href="'<?= AppConfig::getUrl('plan/plan-trip-detail?slug=') ?>'  + plan.plan_slug" title="">{{plan.des_name}}</a>
                                    </div>
                                    <ul class="rating">
                                        <li>Thời gian: {{plan.total_day}} ngày</li>
                                    </ul>
                                    <ul class="rating">
                                        <li>Người tạo: {{plan.fullname}}</li>
                                    </ul>
                                </div><!-- /.box-content -->
                            </div><!-- /.box-imagebox -->
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-more"><a href="blog.html" title="">Xem thêm</a></div>
                </div>
            </div>
        </div>
    </section>
</div>


<template id="star-rating-template">
    <span>
        <i v-for="n in maxStars" :class="getClass(n)" :style="getStyle(n)" @click="$emit('input', n)" style="font-size: 20px">
        </i>
    </span>
</template>

<script>
    (function($) {
        var topDes = <?= json_encode($topDes) ?>;
        var topLocation = <?= json_encode($topLocation) ?>;
        var planList = <?= json_encode($planList) ?>;


        Vue.component("star-rating", {
            props: {
                value: {
                    type: Number,
                    default: 0
                },
                maxStars: {
                    type: Number,
                    default: 5
                },
                starredColor: {
                    type: String,
                    default: "#f0dd09"
                },
                blankColor: {
                    type: String,
                    default: "darkgray"
                }
            },
            template: "#star-rating-template",
            methods: {
                getClass(n) {
                    return {
                        "fa": true,
                        "fa-star": n <= this.value,
                        "fa-star-o": n > this.value,
                        'fa-star-half-o': (this.value / n == 0 && this.value % 2 != 0)
                    }
                },
                getStyle(n) {
                    return {
                        color: n <= this.value ? this.starredColor : this.blankColor
                    }
                }
            }
        });

        APP.vueInstance = new Vue({
            el: '#home-page',
            data: {
                topDes: topDes,
                topLocation: topLocation,
                planList: planList,
            },
            methods: {

            },
        });
    })(jQuery);
</script>