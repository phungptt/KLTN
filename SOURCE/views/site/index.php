<?php

use app\modules\app\APPConfig;

?>
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
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/halong.png" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content line-center"><a href="#" title="">Hạ Long</a></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/da-nang.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content line-center"><a href="#" title="">Đà Nẵng</a></div>
                    </div>
                    <div class="height20"></div>
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/hanoi.png" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content line-center"><a href="#" title="">Hà Nội</a></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/ninh-binh.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content line-center"><a href="#" title="">Ninh Bình</a></div>
                    </div>
                    <div class="height20"></div>
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/da-lat.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content line-center"><a href="#" title="">Đà Lạt</a></div>
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
                    <h2>Ăn uống</h2>
                    <p>Khám phá các điểm ăn uống tuyệt vời</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="imagebox">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-01.png" alt=""><a href="#" title="">Preview</a>
                                        <div class="overlay"></div>
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <!-- /.box-header-->
                                <div class="box-content">
                                    <div class="box-title ad"><a href="#" title="">AN Restaurant</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                                    <ul class="rating">
                                        <li>5 rating</li>
                                        <li>Moderate</li>
                                        <li>Restaurant</li>
                                    </ul>
                                    <div class="box-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </div>
                                <!-- /.box-content-->
                                <div class="location">
                                    <div class="address"><span class="ti-location-pin"></span>Đà Lạt</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="imagebox">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-02.png" alt=""><a href="#" title="">Preview</a>
                                        <div class="overlay"></div>
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="box-title"><a href="#" title="">Acantara</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                                    <ul class="rating">
                                        <li>10 rating</li>
                                        <li>Ultra High End</li>
                                        <li>Hotel</li>
                                    </ul>
                                    <div class="box-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </div>
                                <div class="location">
                                    <div class="address"><span class="ti-location-pin"></span>Đà Lạt</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="imagebox">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-03.png" alt=""><a href="#" title="">Preview</a>
                                        <div class="overlay"></div>
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <!-- /.box-header-->
                                <div class="box-content">
                                    <div class="box-title"><a href="#" title="">Intercontinental</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                                    <ul class="rating">
                                        <li>6 rating</li>
                                        <li>Pricey</li>
                                        <li>Hotel</li>
                                    </ul>
                                    <div class="box-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </div>
                                <div class="location">
                                    <div class="address"><span class="ti-location-pin"></span>Đà Lạt</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="flat-row flat-imagebox background" id="hotel-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-row-title center">
                    <h2>Khách Sạn</h2>
                    <p></p>Chọn một nơi bạn có thể nghỉ ngơi và relax
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="imagebox">
                    <div class="box-imagebox">
                        <div class="box-header">
                            <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-01.png" alt=""><a href="#" title="">Preview</a>
                                <div class="overlay"></div>
                                <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="box-title ad"><a href="#" title="">AN Hotel</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                            <ul class="rating">
                                <li>500.000 VND / đêm</li>
                            </ul>
                            <div class="box-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                        </div>
                        <div class="location">
                            <div class="address"><span class="ti-location-pin"></span>Đà Lạt</div>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="imagebox style1">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image">
                                        <img src="/resources/images/da-lat.jpg" alt="">
                                        <a href="#" title="">Xem</a>
                                        <div class="overlay"></div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-content line-center">
                                    <div class="box-title ad">
                                        <a href="#" title="">Đà Lạt</a><i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </div>
                                    <ul class="rating">
                                        <li>5 ngày 4 đêm</li>
                                    </ul>
                                </div><!-- /.box-content -->
                                <ul class="location">
                                    <li class="address">
                                        <span class="fa fa-user" aria-hidden="true"></span>Tieu Phung
                                    </li>
                                </ul><!-- /.location -->
                            </div><!-- /.box-imagebox -->
                        </div><!-- /.imagebox style1 -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-more"><a href="blog.html" title="">Xem thêm</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>