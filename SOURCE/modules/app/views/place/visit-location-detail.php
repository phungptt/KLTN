<?php

use kartik\form\ActiveForm;
use app\modules\api\APIConfig;
use app\modules\app\APPConfig;
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
                              <star-rating :value = "review.rating"></star-rating>
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
                                   <div class="swiper-slide"  v-for="image in imagesRelate"> <img :src="image.path"></div>
                              </div>
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
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
          var selectVisit = <?= json_encode($visit) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;

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
                    id_place: selectVisit['id'],
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