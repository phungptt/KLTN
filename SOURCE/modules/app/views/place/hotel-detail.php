<?php
use app\modules\contrib\gxassets\GxSwiperAsset;

GxSwiperAsset::register($this);
include('hotel-detail_css.php')
?>

<div class="hotel-detail" id="hotel-detail">
     <section class="banner-section">
          <div class="banner-img"  :style="{ backgroundImage: 'url(' +  selectHotel.path + ')' }"></div>
          <div class="text-box">
               <h2 class="title">{{selectHotel.name}}</h2>
          </div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                              <div class="box-title"><a href="#" title="">{{selectHotel.name}}</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>{{selectHotel.address}}</li>
                                   <li class="phone"><i class="fa fa-phone" aria-hidden="true"></i>{{selectHotel.phone_number}}</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>{{selectHotel.time_open}} - {{selectHotel.time_closed}}</li>
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
     <section class="hotel-detail-content my-5">
          <div class="container">
               <div class="text-box">
                    <h3>Thông tin</h3>
                    <div class="text-desc">
                         <p>{{selectHotel.description}}</p>
                    </div>
               </div>
               <div class="amenities">
                    <h3>Tiện nghi</h3>
                    <ul class="quater">
                         <li><span class="far fa-check-square"></span>Wireless Internet</li>
                         <li><span class="far fa-check-square"></span>Street Parking</li>
                         <li><span class="far fa-check-square"></span>Kitchen</li>
                         <li><span class="far fa-check-square"></span>Bike Parking</li>
                    </ul>
                    <ul class="quater">
                         <li><span class="far fa-check-square"></span>Pets Friendly</li>
                         <li><span class="far fa-check-square"></span>Moderate</li>
                         <li><span class="far fa-check-square"></span>Smoking Allowed</li>
                         <li><span class="far fa-check-square"></span>Good for Kids</li>
                    </ul>
                    <ul class="quater">
                         <li><span class="far fa-check-square"></span>Most Reviewed</li>
                    </ul>
                    <div class="clearfix"></div>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper">
                                   <div class="swiper-slide"  v-for="image in imagesRelate"> <img :src="image.path"></div>
                              </div>
                              <!-- Add Arrows-->
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="list-room-section my-5">
          <div class="container">
               <div class="text-box">
                    <h3>Loại phòng</h3>
               </div>
               <div class="room-list d-flex">
                    <div class="room-list__item" v-for="room in rooms">
                         <div class="item-img" v-if="room.contain_number >= 2"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/lux-room.svg"></div>
                         <div class="item-img" v-else><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/single-bed.svg"></div>
                         <div class="item-content">
                              <div class="item-content__title">{{room.name}}</div>
                              <div class="item-content__price item-detail line-center"><span>{{room.price}} VNĐ / đêm</span></div>
                              <div class="item-content__guest item-detail"><i class="ti-user"></i><span>{{room.contain_number}} người</span></div>
                         </div>
                    </div>
                    <!-- <div class="room-list__item">
                         <div class="item-img"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/single-bed.svg"></div>
                         <div class="item-content">
                              <div class="item-content__title">Single Room</div>
                              <div class="item-content__price item-detail"><span>200.000 VNĐ / đêm</span></div>
                              <div class="item-content__guest item-detail"><i class="ti-user"></i><span>1 người</span></div>
                         </div>
                    </div> -->
               </div>
          </div>
     </section>
     <section class="comment-section mb-5">
          <div class="container">
               <div class="comment-area">
                         <h3 class="comment-title">Đánh giá</h3>
                         <ol class="comment-list">
                              <li class="comment" style="display: list-item;">
                                   <article class="comment-body">
                                        <div class="comment-image">
                                             <img src="<?= Yii::$app->homeUrl ?>resources/images/page/comment/comment_01.png" alt="">
                                        </div><!-- /.comment-image -->
                                        <div class="comment-content">
                                             <div class="comment-metadata">
                                                  April 8, 2017 9:48 pm
                                             </div>
                                             <h5>
                                                  The food was amazing
                                                  <span>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                  </span>
                                             </h5>
                                             <div class="comment-author">
                                                  by <a href="#" title="">Alex luthor</a>
                                             </div>
                                             <p>
                                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                             </p>
                                        </div><!-- /.comment-content -->
                                   </article><!-- /.comment-body -->
                              </li><!-- /.comment -->
                         </ol><!-- /.comment-list -->
                         <div class="load-more">
                              <a href="" title="">Tải thêm</a>
                         </div>
                         <div class="comment-respond">
                              <h2 class="comment-reply-title">Đánh giá của bạn</h2>
                              <div class="comment-vote">
                                   <p>Rating</p>
                                   <star-rating v-model="rating" :max-stars="5"></star-rating>
                              </div>
                              <form action="#" class="comment-form" method="get" accept-charset="utf-8">
                                   <div class="comment-form-title pl-0 w-100">
                                        <label for="comment-title">Tiêu đề nhận xét</label>
                                        <input type="text" id="comment-title" name="comment-title">
                                   </div>
                                   <div class="clearfix"></div>
                                   <div class="comment-form-comment">
                                        <label for="comment-comment">Nhận xét của bạn</label>
                                        <textarea id="comment-comment" name="comment"></textarea>
                                   </div>
                                   <div class="submit-form">
                                        <button type="submit">Gửi đánh giá</button>
                                   </div>
                              </form><!-- /.comment-form -->
                         </div><!-- /.comment-respond -->
                    </div>
               </div>
          </div>
     </section>
</div>
<template id="star-rating-template">
  <span>
    <i v-for="n in maxStars" 
       :class="getClass(n)" 
       :style="getStyle(n)"
       @click="$emit('input', n)"></i>
  </span>
</template>
<script>
     (function ($) {
          var selectHotel = <?= json_encode($hotel) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;
          var rooms = <?= json_encode($rooms) ?>;
          Vue.component("star-rating", {
               props:{
                    value:{type: Number, default: 0},
                    maxStars: {type: Number, default: 5},
                    starredColor: {type: String, default: "orange"},
                    blankColor: {type: String, default: "darkgray"}
               },
               template:"#star-rating-template",
               methods:{
                    getClass(n){
                         return {
                              "fa": true,
                              "fa-star": n <= this.value,
                              "fa-star-o": n > this.value,
                         }
                    },
                    getStyle(n){
                         return {
                              color: n <= this.value ? this.starredColor : this.blankColor
                         }
                    }
               }
          });

          APP.vueInstance = new Vue({
               el: '#hotel-detail',
               data: {
                    selectHotel: selectHotel,
                    imagesRelate: imagesRelate,
                    rooms: rooms,
                    rating: 0,
                    swiper: null,
                    id_place: selectHotel['id']
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