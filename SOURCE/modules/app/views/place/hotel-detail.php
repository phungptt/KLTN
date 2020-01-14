<?php
     use kartik\form\ActiveForm;
     use app\modules\api\APIConfig;
     use app\modules\contrib\gxassets\GxSwiperAsset;


     GxSwiperAsset::register($this);
     include('hotel-detail_css.php')
?>

<div class="hotel-detail" id="hotel-detail">
     <section class="banner-section">
          <div class="banner-img" :style="{ backgroundImage: 'url(' +  selectHotel.path + ')' }"></div>
          <div class="text-box">
               <h2 class="title">{{selectHotel.name}}</h2>
          </div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <star-rating :value = "review.rating"></star-rating>
                              <div class="box-title"><a href="#" title="">{{selectHotel.name}}</a></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>{{selectHotel.address}}</li>
                                   <li class="phone"><i class="fa fa-phone" aria-hidden="true"></i>{{selectHotel.phone_number}}</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>{{selectHotel.time_open}} - {{selectHotel.time_closed}}</li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-md-4 text-right">
                         <div class="title-right">
                              <div class="btn-more review"><a href="#comment-section" title="">Đánh giá</a></div>
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
                                   <div class="swiper-slide" v-for="image in imagesRelate"> <img :src="image.path"></div>
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
     <section class="comment-section mb-5" id="comment-section">
          <div class="container">
               <div class="comment-area">
                         <div class="comment-respond mb-5">
                              <?php $form = ActiveForm::begin([
                                   'id' => 'create-rating-form',
                                   'options' => [
                                        'enctype' => 'multipart/form-data',
                                        'class' => 'form-listing create-form',
                                   ],
                              ]) ?>
                              <h2 class="comment-reply-title">Đánh giá của bạn</h2>
                              <div class="comment-vote">
                                   <div>
                                        <label>Rating</label>
                                   </div>
                                   <star-rating v-model="rating" :max-stars="5"></star-rating>
                              </div>
                                   <div class="comment-form-title pl-0 w-100">
                                        <?= $form->field($comment, 'short_description')->textInput(['class' => 'required'])->label('Tiêu đề nhận xét') ?>
                                   </div>
                                   <div class="clearfix"></div>
                                   <div class="comment-form-comment">
                                        <?= $form->field($comment, 'content')->textarea(array('rows' => 5))->label('Nhận xét của bạn') ?>
                                   </div>
                                   <div class="submit-form">
                                        <button id="btn-submit" @click="submitForm">Gửi đánh giá</button>
                                   </div>
                              <?php $form->end() ?>
                         </div><!-- /.comment-respond -->
                         <h3 class="comment-title">Đánh giá từ người dùng </h3>
                         <ol class="comment-list">
                              <li class="comment" style="display: list-item;" v-for="comment in review.comments">
                                   <article class="comment-body">
                                        <div class="comment-image">
                                             <img src="<?= Yii::$app->homeUrl ?>resources/images/page/comment/man.png" alt="" v-if="comment.gender == 0">
                                             <img src="<?= Yii::$app->homeUrl ?>resources/images/page/comment/woman.png" alt="" v-else>
                                        </div><!-- /.comment-image -->
                                        <div class="comment-content">
                                             <div class="comment-metadata">
                                                  {{comment.create_at}}
                                             </div>
                                             <h5>
                                                  {{comment.short_description}}
                                             </h5>
                                             <div class="comment-author">
                                                  bởi <a href="#" title="">{{comment.user_name}}</a>
                                             </div>
                                             <p>
                                                  {{comment.content}}
                                             </p>
                                        </div><!-- /.comment-content -->
                                   </article><!-- /.comment-body -->
                              </li><!-- /.comment -->
                              <div class="line-center">
                                   <div class="loader1">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                   </div>
                              </div>
                         </ol><!-- /.comment-list -->
               </div>
          </div>
     </section>
</div>

<template id="star-rating-template">
     <span>
          <i v-for="n in maxStars" 
                    :class="getClass(n)" 
                    :style="getStyle(n)"
                    @click="$emit('input', n)"
                    style="font-size: 20px">
          </i>
     </span>
</template>

<script>
     (function($) {
          var selectHotel = <?= json_encode($hotel) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;
          var rooms = <?= json_encode($rooms) ?>;

          Vue.component("star-rating", {
               props:{
                    value:{type: Number, default: 0},
                    maxStars: {type: Number, default: 5},
                    starredColor: {type: String, default: "#f0dd09"},
                    blankColor: {type: String, default: "darkgray"}
               },
               template:"#star-rating-template",
               methods:{
                    getClass(n){
                         return {
                              "fa": true,
                              "fa-star": n <= this.value,
                              "fa-star-o": n > this.value,
                              'fa-star-half-o': (this.value / n == 0 && this.value % 2 != 0)
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
                    id_place: selectHotel['id'],
                    review: {
                         comments: {},
                         rating: {}
                    },
               },
               created: function() {
                    var _this = this;
                    _this.$nextTick(function() {
                         _this.getReview();
                    });
               },
               methods: {
                    removePreLoader: function(time) {
                         setTimeout(function() {
                              $('.loader1').hide(); }, time           
                         ); 
                    },
                    submitForm: function(event) {
                         event.preventDefault();
                         btnSubmit = $("#btn-submit"),
                         formData = new FormData($('#create-rating-form')[0]);
                         formData.append('id_place', this.id_place);
                         formData.append('rating', this.rating);
                         btnSubmit.empty().append('Đang lưu đánh giá mới...');
                         var api = '<?= APIConfig::getUrl('place/create-comment') ?>';
                         $.ajax({
                              contentType: false,
                              processData: false,
                              type: 'POST',
                              url: api,
                              data: formData,
                              success: function(response) {
                                   if (response.status === false) {
                                        toastMessage('error', response.message);
                                   } else {
                                        toastMessage('success', response.message);
                                        window.location.reload();
                                   }
                                   btnSubmit.empty().append('Lưu nhận xét');
                              },
                              error: function() {
                                   toastMessage('error', 'Upload failed');
                                   btnSubmit.empty().append('Lưu nhận xét');
                              }
                         });
                    },
                    getReview: function() {
                         $('.loader1').show();

                         var _this = this;
                         var api = '<?= APIConfig::getUrl('place/get-review') ?>';
                         $.ajax({
                              url: api,
                              type: 'POST',
                              start_time: new Date().getTime(),
                              data: {
                                   id: _this.id_place
                              },
                              success: function(resp) {
                                   window.addEventListener("load", _this.removePreLoader(new Date().getTime() - this.start_time));
                                   if(resp.status) {
                                        _this.review.comments = resp.review.comments;
                                        _this.review.rating = parseFloat(resp.review.rating['avg']);
                                   } else {
                                        toastMessage('error', resp.message)
                                   }
                              },
                              error: function(msg) {
                                   toastMessage('error', msg)
                              }
                         });
                    },
               },
          });
     })(jQuery);
</script>