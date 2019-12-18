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
                        <div class="box-content"><a href="#" title="">Hạ Long</a></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/da-nang.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content"><a href="#" title="">Đà Nẵng</a></div>
                    </div>
                    <div class="height20"></div>
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/hanoi.png" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content"><a href="#" title="">Hà Nội</a></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/ninh-binh.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content"><a href="#" title="">Ninh Bình</a></div>
                    </div>
                    <div class="height20"></div>
                    <div class="imagebox style5">
                        <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/da-lat.jpg" alt="">
                            <div class="overlay"></div>
                        </div>
                        <div class="box-content"><a href="#" title="">Đà Lạt</a></div>
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
                                <div class="box-desc">Looking for a cozy hotel to stay, a restaurant to eat or a mall to do some shopping?</div>
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
                                <div class="box-desc">Search and filter hundreds of listings, read reviews and find the perfect spot.</div>
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
                                <div class="box-desc">Go and have a good time or even make a booking directly from the listing page.</div>
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
<section class="flat-row flat-main-blog style2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-row-title center">
                    <h2>Tips & Articles</h2>
                    <p>Mách bạn một số tips khi đi du lịch</p>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <article class="blog-post">
                            <div class="featured-post"><a href="#" title=""><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/01.png" alt="">
                                    <div class="overlay"></div>
                                </a></div>
                            <div class="content-post">
                                <div class="entry-post">
                                    <ul class="entry-meta">
                                        <li class="topic"><a href="#" title="">Vocation</a></li>
                                        <li class="date"><a href="#" title="">June 08, 2017</a></li>
                                    </ul>
                                    <h2 class="entry-title"><a href="#" title="">
                                            Working While Traveling
                                            Around the World</a></h2>
                                </div>
                                <p>Combining wanderlust and a steady job can be done for a year, with planning, permission and at a cost</p>
                                <div class="author-post">By <a href="#" title="">Patricia R. Olsen</a></div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <article class="blog-post">
                            <div class="featured-post"><a href="#" title=""><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/02.png" alt="">
                                    <div class="overlay"></div>
                                </a></div>
                            <div class="content-post">
                                <div class="entry-post">
                                    <ul class="entry-meta">
                                        <li class="topic"><a href="#" title="">Trending</a></li>
                                        <li class="date"><a href="#" title="">June 08, 2017</a></li>
                                    </ul>
                                    <h2 class="entry-title"><a href="#" title="">For Summer, <br> Five Hot Destinations</a></h2>
                                </div>
                                <p>Americans will likely travel more this summer than last, with Croatia, South Africa and Greece among the popular destinations.</p>
                                <div class="author-post">By <a href="#" title="">Sivani Vora</a></div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <article class="blog-post">
                            <div class="featured-post"><a href="#" title=""><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/03.png" alt="">
                                    <div class="overlay"></div>
                                </a></div>
                            <div class="content-post">
                                <div class="entry-post">
                                    <ul class="entry-meta">
                                        <li class="topic"><a href="#" title="">Surfacing</a></li>
                                        <li class="date"><a href="#" title="">May 25, 2017</a></li>
                                    </ul>
                                    <h2 class="entry-title"><a href="#" title="">
                                            Five Places to Go in
                                            Downtown Albuquerque</a></h2>
                                </div>
                                <p>Residents and in-the-know visitors to New Mexico’s largest city head to a once-derelict district that.</p>
                                <div class="author-post">By <a href="#" title="">Nick Pachelli</a></div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <article class="blog-post">
                            <div class="featured-post"><a href="#" title=""><img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/04.png" alt="">
                                    <div class="overlay"></div>
                                </a></div>
                            <div class="content-post">
                                <div class="entry-post">
                                    <ul class="entry-meta">
                                        <li class="topic"><a href="#" title="">24 Hour</a></li>
                                        <li class="date"><a href="#" title="">May 25, 2017</a></li>
                                    </ul>
                                    <h2 class="entry-title"><a href="#" title="">24 Hours in Indianapolis</a></h2>
                                </div>
                                <p>There is more to Indiana’s capital city than the Memorial Day weekend whirlwind known as the Indy 500.</p>
                                <div class="author-post">By <a href="#" title="">Elaine Glusac</a></div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-more"><a href="blog.html" title="">View Blog</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>