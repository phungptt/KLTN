<?php
use app\modules\contrib\gxassets\GxSwiperAsset;

GxSwiperAsset::register($this);
include('food-detail_css.php')
?>

<div class="food-detail">
     <section class="banner-section">
          <div class="banner-img"></div>
          <div class="text-box">
               <h2 class="title">Food detail</h2>
          </div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                              <div class="box-title"><a href="#" title="">AN Restaurant</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>2 / 51 Hoang Cau Street, Hanoi, Vietnam</li>
                                   <li class="phone"><i class="fa fa-phone" aria-hidden="true"></i>(+84) 936 736 288</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>09:00 AM - 05:00 PM</li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-md-4 text-right">
                         <div class="title-right">
                              <div class="btn-more review"><a href="#" title="">Write A Review</a></div>
                              <div class="clearfix"></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="flat-row flat-explore-detail">
          <div class="container">
               <div class="text-box">
                    <h3>Thông tin</h3>
                    <div class="text-desc">
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><i>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla qui officia deserunt mollit anim id est laborum.</i>
                         <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    </div>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper">
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/food-detail/slider-1.png"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/food-detail/slider-2.png"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/food-detail/slider-3.png"></div>
                              </div>
                              <!-- Add Arrows-->
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
               <div class="comment-area">
                    <h3 class="comment-title">3 Reviews</h3>
                    <ol class="comment-list">
                         <li class="comment">
                              <article class="comment-body">
                                   <div class="comment-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/comment/comment_01.png" alt=""></div>
                                   <div class="comment-content">
                                        <div class="comment-metadata">April 8, 2017 9:48 pm</div>
                                        <h5>The food was amazing<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></span></h5>
                                        <div class="comment-author">by <a href="#" title="">Alex luthor</a></div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                         <li class="comment"></li>
               </div>
               </article>
               </li>
               </ol>
          </div>
          </div>
     </section>
</div>

<script>
     (function ($) {
          var swiper = new Swiper('.swiper-container', {
               // slidesPerView: 3,
               centeredSlides: true,
               loop: true,
               pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
               },
               navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
               },
          });
     })(jQuery);
</script>