<?php
use app\modules\api\APIConfig;
use app\modules\app\AppConfig;
use app\modules\app\services\PlaceService;
use app\modules\app\widgets\CMSMapListWidget;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\contrib\gxassets\GxLeafletPruneClusterAsset;

GxLeafletAsset::register($this);
GxLeafletPruneClusterAsset::register($this);
include('visit-location-list_css.php')
?>

<section class="flat-map-zoom-in" id="visit-location-list">
     <div class="preloader" style="z-index: 2000">
          <div class="clear-loading loading-effect-2">
               <span></span>
          </div>
     </div>

     <div class="container-fluid px-0">
          <div class="row mx-0">
               <div class="col-lg-6 px-0">
                    <div class="flat-filter place-list" style="overflow-y: scroll; overflow-x: hidden">
                         <div class="wrap-box-search style2" style="margin-left: 0; margin-right: 0">
                              <form action="#" method="get" accept-charset="utf-8">
                                   <span>
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
                              <div class="imagebox style3" style="display: block;" v-for="(visit, index) in places.data">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="visit.path" alt="" class="w-100">
                                                  <a  @click="viewLocation(visit)" @mouseover="showMarkerPopup(visit.id)">
                                                       <i aria-hidden="true" class="fas fa-map-marked-alt" 
                                                            style=" color: white; font-size: 36px;">
                                                       </i>
                                                  </a>
                                                  <div class="overlay"></div>
                                                  <div class="queue">
                                                       <star-rating :value = "visit.rating"></star-rating>
                                                  </div>
                                             </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-content">
                                             <div class="box-title ad">
                                                  <a :href="'<?= AppConfig::getUrl('place/visit-location-detail?slug=') ?>'  + visit.slug" title="" >{{visit.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li v-if="visit.rating > 0">{{visit.rating_number}} rating</li>
                                                  <li v-else="visit.rating <= 0">0 rating</li>
                                                  <li v-if="visit.comment_number > 0">{{visit.comment_number}} đánh giá</li>
                                                  <li v-else="visit.comment_number <= 0">0 đánh giá</li>
                                             </ul>
                                        </div><!-- /.box-content -->
                                        <ul class="location">
                                             <div class="address"><span class="fas fa-map-marker-alt"></span>{{visit.name_destination}}</div>
                                        </ul><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                                   <div class="height30"></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="row">
                                   <div class="col-md-12">
                                        
                                   </div>
                              </div><!-- /.row -->
                         </div><!-- /.wrap-imagebox -->
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6 px-0">
                    <section class="pdmap">
                         <div class="pdmap style2" style="height: 1200px;">
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
          setPageHeight();
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
                              "fa-star-o": this.value < n,
                              'fa-star-half-o': this.value > (n - 1)
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
               el: '#visit-location-list',
               data: {
                    selectLocation: null,
                    countOfPage: 4,
                    currPage: 1,
                    places: {
					data: {},
                         paginations: {},
                         query: {
                              type: '<?= PlaceService::$VISIT_TYPE ?>',
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
               methods: {
                    setPage: function(idx) {
                         if (idx <= 0 || idx > this.totalPage) {
                              return;
                         }
                         this.currPage = idx;
                    },
                    viewLocation: function(location){
                         this.selectedLocation = location;
                         this.zoomToMap(location.lat, location.lng);
                         var iconMap = $('#image-object-on-map-' + location.id_place).parent();
                         iconMap.trigger('click');
                    },
                    zoomToMap: function(lat, lng) {
                         DATA.map.setView([lat, lng], 17);
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
                                        initPlacesLayer(resp.places.data, true)
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

     $(window).on('resize', function() {
          setPageHeight()
     })

     function setPageHeight() {
          var headerHeight = $('.header').height()
          var windowHeight = $(window).height()

          $('.place-list').height(windowHeight - headerHeight)
          $('#flat-map').height(windowHeight - headerHeight)
     }
</script>