<?php

use kartik\form\ActiveForm;
use app\modules\app\APPConfig;
use app\modules\app\services\PlaceService;
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
                         <?php $form = ActiveForm::begin([
                              'id' => 'create-rating-form',
                              'options' => [
                                   'enctype' => 'multipart/form-data',
                                   'class' => 'form-listing create-form'
                              ]
                         ]) ?>
                         <h2 class="comment-reply-title">Đánh giá của bạn</h2>
                         <div class="comment-vote">
                              <p>Rating</p>
                              <star-rating v-model="rating" :max-stars="5"></star-rating>
                         </div>
                         <div class="comment-form-title pl-0 w-100">
                              <?= $form->field($comment, 'short_description')->textInput()->label('Tiêu đề nhận xét') ?>
                         </div>
                         <div class="clearfix"></div>
                         <div class="comment-form-comment">
                              <?= $form->field($comment, 'content')->textarea(['rows' => 5])->label('Nhận xét của bạn') ?>
                         </div>
                         <div class="submit-form">
                              <button id="btn-submit" @click="submitForm">Gửi đánh giá</button>
                         </div>
                         <?php $form->end() ?>
                    </div><!-- /.comment-respond -->
               </div>
          </div>
</div>

</section>
</div>

<template id="star-rating-template">
     <span>
          <i v-for="n in maxStars" :class="getClass(n)" :style="getStyle(n)" @click="$emit('input', n)"></i>
     </span>
</template>

<script>
     (function($) {
          var selectVisit = <?= json_encode($visit) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;
          var comments = <?= json_encode($comments) ?>;

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
               el: '#visit-location-detail',
               data: {
                    selectVisit: selectVisit,
                    imagesRelate: imagesRelate,
                    rating: 0,
                    comments: comments,
                    id_place: selectVisit['id']
               },
               methods: {
                    submitForm: function(event) {
                         event.preventDefault();
                         var _this = this,
                         btnSubmit = $("#btn-submit"),
                         formData = new FormData($('#create-rating-form')[0]);
                         formData.append('id_place', this.id_place)
                         btnSubmit.empty().append('Đang lưu đánh giá mới...')

                         $.ajax({
                              contentType: false,
                              processData: false,
                              type: 'POST',
                              url: '<?= APPConfig::getUrl('place/visit-location-detail') ?>',
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
                    }
               },
          });
     })(jQuery);
</script>