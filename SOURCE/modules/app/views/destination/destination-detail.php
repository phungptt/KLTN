
<?php
     use app\modules\app\AppConfig;
     use app\modules\contrib\gxassets\GxSwiperAsset;
     use app\modules\contrib\gxassets\GxVueAsset;

     GxSwiperAsset::register($this);
     GxVueAsset::register($this);
     include('destination-detail_css.php')
?>

<div class="destination-detail" id='destination-detail'>
     <section class="destination-banner-section banner-section">
          <div class="banner-img" :style="{ backgroundImage: 'url(' +  selectDestination.path + ')' }"></div>
          <div class="text-box">
               <div class="title"> <span class="destination">{{selectDestination.name}}</span></div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="destination-content">
          <div class="container">
               <div class="text-desc my-5">
                    {{selectDestination.description}}
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper" v-for="image in imagesRelate">
                                   <div class="swiper-slide"> <img :src="image.path"></div>
                              </div>
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="place-section my-5">
          <div class="container">
               <div class="text-box">
                    <h3>Địa điểm nổi bật</h3>
               </div>
               <div class="place-list">
                    <div class="place-list__item">
                         <div class="place-item-img"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-1.jpg"></div>
                         <div class="place-item-content">
                              <div class="title">
                                   Hồ Tuyền Lâm</div>
                              <div class="rating">
                                   <div class="title-left">
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>12 reviews</span></div>
                                   </div>
                              </div>
                              <hr>
                              <div class="bottom-area">
                                   <div class="ml-auto"><a class="btn-small" href="#">Khám phá</a></div>
                              </div>
                         </div>
                    </div>
                    <div class="place-list__item">
                         <div class="place-item-img"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-1.jpg"></div>
                         <div class="place-item-content">
                              <div class="title">
                                   Nhà thờ Domaine de Marie</div>
                              <div class="rating">
                                   <div class="title-left">
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>12 reviews</span></div>
                                   </div>
                              </div>
                              <hr>
                              <div class="bottom-area">
                                   <div class="ml-auto"><a class="btn-small" href="#">Khám phá</a></div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="btn-more">
                    <a href="#" title="">Xem thêm</a>
               </div>
          </div>
     </section>
</div>

<script>
     (function ($) {
          var selectDestination = <?= json_encode($destination) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;

          APP.vueInstance = new Vue({
               el: '#destination-detail',
               data: {
                    selectDestination: selectDestination,
                    imagesRelate: imagesRelate,
                    swiper: null,
               },
               methods: {
               },
               mounted() {
                    this.swiper = new window.Swiper('.swiper-container', {
                         cssMode: true,
                         navigation: {
                              nextEl: '.swiper-button-next',
                              prevEl: '.swiper-button-prev',
                         },
                         pagination: {
                              el: '.swiper-pagination',
                              clickable: true,
                         },
                         mousewheel: true,
                         keyboard: true,
                    })
               },
          });

     })(jQuery);
</script>

