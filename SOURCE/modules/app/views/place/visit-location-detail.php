<?php

use app\modules\contrib\gxassets\GxSwiperAsset;
use app\modules\contrib\gxassets\GxVueAsset;

GxSwiperAsset::register($this);
GxVueAsset::register($this);
include('hotel-detail_css.php')
?>

<div class="visit-location-detail" id="visit-location-detail">
     <section class="banner-section">
          <div class="banner-img" :style="{ backgroundImage: 'url(' +  selectVisit.path + ')' }"></div>
          <div class="text-box">
               <h2 class="title">{{selectVisit.name}}</h2>
          </div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                              <div class="box-title"><a href="#" title="">{{selectVisit.name}}</a></i></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>{{selectVisit.address}}</li>
                                   <li class="phone" v-if="selectVisit.phone_number"><i class="fa fa-phone" aria-hidden="true"></i>{{selectVisit.phone_number}}</li>
                                   <li class="phone" v-else><i class="fa fa-phone" aria-hidden="true"></i>Không có</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>{{selectVisit.time_open}} - {{selectVisit.time_closed}}</li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-md-4 text-right">
                         <div class="title-right">
                              <div class="btn-more review"><a href="#" title="">Đánh giá</a></div>
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
                         <p>{{selectVisit.description}}</p>
                    </div>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper">
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/visit-location.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/nha-tho-1.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/nha-tho-2.jpg"></div>
                              </div>
                              <!-- Add Arrows-->
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
               <div class="comment-area mt-4">
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
     (function($) {
          var selectVisit = <?= json_encode($visit) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>

          APP.vueInstance = new Vue({
               el: '#visit-location-detail',
               data: {
                    selectVisit: selectVisit,
                    imagesRelate: imagesRelate,
               },

               methods: {

               },
               // mounted() {
               //      this.swiper = new window.Swiper('.swiper-container', {
               //           cssMode: true,
               //           navigation: {
               //                nextEl: '.swiper-button-next',
               //                prevEl: '.swiper-button-prev',
               //           },
               //           pagination: {
               //                el: '.swiper-pagination',
               //                clickable: true,
               //           },
               //           mousewheel: true,
               //           keyboard: true,
               //      })
               // },
          });
     })(jQuery);
</script>