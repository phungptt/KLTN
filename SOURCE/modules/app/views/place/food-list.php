<?php
use app\modules\api\APIConfig;
use app\modules\app\AppConfig;
use app\modules\app\services\PlaceService;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\app\widgets\AppObjectMapWidget;
use app\modules\app\widgets\CMSMapListWidget;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('food-list_css.php')
?>

<section class="flat-map-zoom-in" id="food-list">
     <div class="preloader">
          <div class="clear-loading loading-effect-2">
               <span></span>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="flat-filter">
                         <div class="wrap-box-search style2">
                              <form action="#" method="get" accept-charset="utf-8">
                                   <span  class="w-100" >
                                        <input type="text" placeholder="Tìm kiếm ?" name="search" v-model="places.query.keyword" v-on:change="getPlaceLocation(places.query.type,places.query.keyword)">
                                   </span>
                                   <span class="categories">
                                        <span class="ti-angle-down"></span>
                                   </span>
                                   <div class="clearfix"></div>
                              </form><!-- /form -->
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         <div class="wrap-imagebox style1">
                              <div class="imagebox style3" v-for="(food, index) in places.data">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="food.path" alt="" class="w-100">
                                                  <a @click="viewLocation(food)" @mouseover="showMarkerPopup(food.id)" title="">
                                                       <i aria-hidden="true" class="fas fa-map-marked-alt" 
                                                            style=" color: white; font-size: 36px;">
                                                       </i>
                                                  </a>
                                                  <div class="overlay"></div>
                                                  <div class="queue">
                                                       <star-rating :value = "food.rating"></star-rating>
                                                  </div>
                                             </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-content">
                                             <div class="box-title ad">
                                                  <a :href="'<?= AppConfig::getUrl('place/food-detail?slug=') ?>'  + food.slug" title="" >{{food.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li v-if="food.rating > 0">{{food.rating_number}} rating</li>
                                                  <li v-else="food.rating <= 0">0 rating</li>
                                                  <li v-if="food.comment_number > 0">{{food.comment_number}} đánh giá</li>
                                                  <li v-else="food.comment_number <= 0">0 đánh giá</li>
                                             </ul>
                                        </div><!-- /.box-content -->
                                        <ul class="location">
                                             <div class="address"><span class="fas fa-map-marker-alt"></span>{{food.name_destination}}</div>
                                        </ul><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                              </div><!-- /.imagebox style3 -->
                              <div class="clearfix"></div>
                              <div class="row">
                                   <div class="col-md-12">
                                        <!-- <nav aria-label="Page navigation example">
                                             <ul class="pagination justify-content-center">
                                                  <li class="page-item" v-bind:class="{'disabled': (currPage === 1)}" @click.prevent="setPage(currPage-1)"><a class="page-link" href="">Trang trước</a></li>
                                                  <li class="page-item" v-for="n in totalPage" v-bind:class="{'active': (currPage === (n))}" @click.prevent="setPage(n)"><a class="page-link" href="">{{n}}</a></li>
                                                  <li class="page-item" v-bind:class="{'disabled': (currPage === totalPage)}" @click.prevent="setPage(currPage+1)"><a class="page-link" href="">Trang sau</a></li>
                                             </ul>
                                        </nav> -->
                                   </div>
                              </div><!-- /.row -->
                         </div><!-- /.wrap-imagebox -->
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6">
                    <section class="pdmap h-100" id="flat-map">
                         <div class="pdmap style2" style="height: 1500px;">
                              <?= CMSMapListWidget::widget() ?>
                         </div>
                    </section><!-- /#flat-map-2 -->
               </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
     </div><!-- /.container-fluid -->
</section><!-- /.flat-map-zoom-in -->

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
          Vue.component("star-rating", {
               template: "#star-rating-template",
               props:{
                    value:{type: Number, default: 0},
                    maxStars: {type: Number, default: 5},
                    starredColor: {type: String, default: "#f0dd09"},
                    blankColor: {type: String, default: "#f0dd09"}
               },
               methods:{
                    getClass(n){
                         return {
                              "fa": true,
                              "fa-star": n <= this.value,
                              "fa-star-o": this.value <= n,
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
               el: '#food-list',
               data: {
                    countOfPage: 6,
                    currPage: 1,
                    places: {
					data: {},
                         paginations: {},
                         query: {
                              type: '<?= PlaceService::$FOOD_TYPE ?>',
                              keyword: null,
                         }
				}, 
               },
               created: function() {
                    var _this = this;
                    _this.$nextTick(function() {
                         _this.getPlaceLocation(_this.places.query.type,_this.places.query.keyword);
                    });
               },
               // computed: {
               //      pageStart: function() {
               //           return (this.currPage - 1) * this.countOfPage;
               //      },
               //      totalPage: function() {
               //           return Math.ceil(this.foodList.length / this.countOfPage);
               //      }
               // },
               methods: {
                    // setPage: function(idx) {
                    //      if (idx <= 0 || idx > this.totalPage) {
                    //           return;
                    //      }
                    //      this.currPage = idx;
                    // },
                    viewLocation: function(location) {
                         this.selectedLocation = location;
                         this.zoomToMap(location.lat, location.lng);
                         var iconMap = $('#image-object-on-map-' + location.id).parent();
                         iconMap.trigger('click');
                    },
                    zoomToMap: function(lat, lng) {
                         DATA.map.setView([lat, lng], 15);
                         MARKER.setLatLng([lat, lng]);
                    },
                    showMarkerPopup: function(id) {
                         var iconMap = $('#image-object-on-map-' + id).parent();
                         iconMap.trigger('mouseout');
                    },
                    getPlaceLocation: function(type, keyword) {
                         // - Loader 
                         $('.preloader').show();

                         var _this = this;
                         var api = '<?= APIConfig::getUrl('place/get-place-location') ?>';
                         $.ajax({
                              url: api,
                              type: 'POST',
                              start_time: new Date().getTime(),
                              data: {
                                   type: type,
                                   keyword: keyword,
                              },
                              success: function(resp) {
                                   window.addEventListener("load", _this.removePreLoader(new Date().getTime() - this.start_time));

                                   if(resp.status) {
                                        _this.places.data = resp.places.data
                                   } else {
                                        toastMessage('error', resp.message)
                                   }
                              },
                              error: function(msg) {
                                   toastMessage('error', msg)
                              }
                         });
                    },
                    removePreLoader: function(time) {
                         setTimeout(function() {
                              $('.preloader').hide(); }, time           
                         ); 
                    },
               },
          })
     })(jQuery)
</script>