
<?php
     use kartik\form\ActiveForm;
     use app\modules\api\APIConfig;
     use app\modules\app\APPConfig;
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
     <section class="place-section my-5">
          <div class="container">
               <div class="text-box">
                    <h3>Địa điểm nổi bật</h3>
               </div>
               <div class="place-list">
                    <div class="place-list__item" v-for="place in topPlace.slice(0,4)">
                         <div class="place-item-img"><img :src="place.path"></div>
                         <div class="place-item-content">
                              <div class="title">
                                   {{place.name}}</div>
                              <div class="rating">
                                   <div class="title-left">
                                        <div class="queue"><star-rating :value = "place.rating_avg"></star-rating></div>
                                   </div>
                              </div>
                              <hr></hr>
                              <div class="bottom-area">
                                   <div class="ml-auto" >
                                        <a class="btn-small" :href="'<?= AppConfig::getUrl('place/visit-location-detail?slug=') ?>'  + place.slug" v-if="place.id_type_of_place == 2">Khám phá</a>
                                        <a class="btn-small" :href="'<?= AppConfig::getUrl('place/food-detail?slug=') ?>'  + place.slug" v-if="place.id_type_of_place == 1">Khám phá</a>
                                        <a class="btn-small" :href="'<?= AppConfig::getUrl('place/hotel-detail?slug=') ?>'  + place.slug" v-if="place.id_type_of_place == 0">Khám phá</a>
                                   </div>
                              </div>
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
     (function ($) {
          var selectDestination = <?= json_encode($destination) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>;
          var topPlace = <?= json_encode($topPlace) ?>;

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
               el: '#destination-detail',
               data: {
                    selectDestination: selectDestination,
                    imagesRelate: imagesRelate,
                    topPlace: topPlace,
                    rating: 0,
                    id_des: selectDestination['id'],
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
                         formData.append('id_place', this.id_des);
                         formData.append('rating', this.rating);
                         btnSubmit.empty().append('Đang lưu đánh giá mới...');
                         var api = '<?= APIConfig::getUrl('destination/create-comment') ?>';
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
                         var api = '<?= APIConfig::getUrl('destination/get-review') ?>';
                         $.ajax({
                              url: api,
                              type: 'POST',
                              start_time: new Date().getTime(),
                              data: {
                                   id: _this.id_des
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

