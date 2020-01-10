<?php

use app\modules\api\APIConfig;
use app\modules\app\AppConfig;
use app\modules\app\services\PlaceService;
use app\modules\contrib\gxassets\GxBootstrapSliderAsset;
use app\modules\app\widgets\CMSMapListWidget;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('hotel-list_css.php')
?>

<section class="flat-map-zoom-in" id="hotel-list">
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
                              <form action="">
                                   <span>
                                        <input type="text" placeholder="Tìm kiếm ?" name="search" v-model="places.query.keyword" v-on:change="getPlaceLocation(places.query.type,places.query.keyword)">
                                   </span>
                                   <div class="clearfix"></div>
                              </form>
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         <div class="filter">
                              <div class="filter-title">
                                   <h5>Tìm kiếm với tiện ích</h5>
                                   <span class="ti-angle-down"></span>
                              </div>
                              <div class="clearfix"></div>
                              <div class="select-filter">
                                   <ul class="list-filter one-half">
                                        <div class="select-filter__item" v-for="(amenity,index) in amenities">
                                             <div v-if="index < 4">
                                                  <input class="inp-cbx" :id="amenity.id" type="checkbox" style="display: none" />
                                                  <label class="check-box" :for="amenity.id"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                 <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>{{amenity.name}}</span>
                                                  </label>
                                             </div>
                                        </div>
                                   </ul>
                                   <ul class="list-filter one-half">
                                        <div class="select-filter__item" v-for="(amenity,index) in amenities">
                                             <div v-if="index > 3">
                                                  <input class="inp-cbx" :id="amenity.id" type="checkbox" style="display: none" />
                                                  <label class="check-box" :for="amenity.id"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                 <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>{{amenity.name}}</span>
                                                  </label>
                                             </div>
                                        </div>
                                   </ul>
                                   <div class="clearfix"></div>
                              </div><!-- /.select-filter -->
                         </div>
                         <div class="filter-result">
                              <ul class="arrange">
                                   <li class="active">
                                        <span class="ti-view-grid"></span>
                                   </li>
                                   <li>
                                        <span class="ti-view-list"></span>
                                   </li>
                              </ul>
                         </div><!-- /.filter-result -->
                         <div class="wrap-imagebox style1">
                              <div class="imagebox style3" v-for="(hotel, index) in places.data">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="hotel.path" alt="" class="w-100">
                                                  <a @click="viewLocation(hotel)" @mouseover="showMarkerPopup(hotel.id)" title="">
                                                       <i aria-hidden="true" class="fas fa-map-marked-alt" style=" color: white; font-size: 36px;">
                                                       </i>
                                                  </a>
                                                  <div class="overlay"></div>
                                                  <div class="queue">
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                  </div>
                                             </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-content">
                                             <div class="box-title">
                                                  <a :href="'<?= AppConfig::getUrl('place/hotel-detail?slug=') ?>'  + hotel.slug" title="">{{hotel.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li>Từ {{hotel.price}} VNĐ / đêm</li>
                                             </ul>
                                             <div class="box-desc">
                                                  {{hotel.short_description}}
                                             </div>
                                        </div><!-- /.box-content -->
                                        <div class="location">
                                             <span class="fas fa-map-marker-alt"></span>
                                             <span>{{hotel.name_destination}}</span>
                                        </div><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                              </div><!-- /.imagebox style3 -->
                              <div class="height33 clearfix"></div>
                              <div class="clearfix"></div>
                         </div><!-- /.wrap-imagebox -->
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
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6">
                    <section class="pdmap" id="flat-map">
                         <div class="pdmap style2" style="height: 1500px;">
                              <?= CMSMapListWidget::widget() ?>
                         </div>
                    </section><!-- /#flat-map-2 -->
               </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
     </div><!-- /.container-fluid -->
</section><!-- /.flat-map-zoom-in -->


<script>
     (function($) {
          var amenities = <?= json_encode($amenities) ?>

          APP.vueInstance = new Vue({
               el: '#hotel-list',
               data: {
                    amenities: amenities,
                    countOfPage: 6,
                    currPage: 1,
                    places: {
                         data: {},
                         paginations: {},
                         query: {
                              type: '<?= PlaceService::$HOTEL_TYPE ?>',
                              keyword: null,
                         }
                    }
               },
               created: function() {
                    var _this = this;
                    _this.$nextTick(function() {
                         _this.getPlaceLocation(_this.places.query.type, _this.places.query.keyword)
                    })
               },
               methods: {
                    viewLocation: function(location) {
                         this.selectedLocation = location;
                         this.zoomToMap(location.lat, location.lng);
                         var iconMap = $('#image-object-on-map-' + location.id).parent();
                         iconMap.trigger('click');
                    },
                    viewObjectById: function(id) {
                         var _this = this;
                         var dest = _this.getDestinationById(id);
                         _this.viewDestination(dest);
                    },
                    getDestinationById: function(id) {
                         for (var i in this.places.data) {
                              if (this.places.data[i].id === id) {
                                   return this.places.data[i];
                              }
                         }
                         return null;
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

                                   if (resp.status) {
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
                              $('.preloader').hide();
                         }, time);
                    },
               },
          })
     })(jQuery)
</script>