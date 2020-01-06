<?php

use app\modules\contrib\gxassets\GxBootstrapSliderAsset;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\app\widgets\AppObjectMapWidget;
use app\modules\app\widgets\CMSMapDetailWidget;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('hotel-list_css.php')
?>

<section class="flat-map-zoom-in" id="hotel-list">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="flat-filter">
                         <div class="wrap-box-search style2">
                              <form action="#" method="get" accept-charset="utf-8">
                                   <span>
                                        <input type="text" placeholder="Tìm kiếm ?" name="search">
                                   </span>
                                   <span class="location">
                                        <span class="fas fa-map-marker-alt"></span>
                                        <input type="text" placeholder="Địa điểm" name="location">
                                   </span>
                                   <span class="categories">
                                        <span class="ti-angle-down"></span>
                                   </span>
                                   <div class="clearfix"></div>
                                   <div class="box-slider">
                                        <!-- <input id="price-slider-range" type="text" class="span2" value="" v-model="sliderValue" /> -->
                                        <div class="slider-limit">
                                             <span class="price-min text-12">0 VNĐ</span>
                                             <span class="price-max text-12">24000000 VNĐ</span>
                                        </div>
                              </form><!-- /form -->
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         <div class="filter">
                              <div class="filter-title">
                                   <h5>Filter by tag:</h5>
                                   <span class="ti-angle-down"></span>
                              </div>
                              <div class="clearfix"></div>
                              <div class="select-filter">
                                   <ul class="list-filter one-half" >
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
                                   <ul class="list-filter one-half" >
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
                              <div class="imagebox style3" v-for="hotel in hotelList">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="hotel.path" alt="" class="w-100">
                                                  <a href="#" title="">Xem</a>
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
                                                  <a href="#" title="">{{hotel.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li>Từ 540 000 VNĐ / đêm</li>
                                             </ul>
                                             <div class="box-desc">
                                                 {{hotel.short_description}}
                                             </div>
                                        </div><!-- /.box-content -->
                                        <div class="location">
                                             <span class="fas fa-map-marker-alt"></span>
                                             <span>{{hotel.name_destination}}</span> 
                                        </ul><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                              </div><!-- /.imagebox style3 -->
                              <div class="height33 clearfix"></div>
                              <div class="clearfix"></div>
                           
                         </div><!-- /.wrap-imagebox -->
                         <div class="btn-more">
                              <a href="#" title="">Tải thêm</a>
                         </div>
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6">
                    <section class="pdmap" id="flat-map">
                         <div class="flat-maps" data-address="Ngõ 178 Nguyễn Lương Bằng, Chợ Dừa, Đống Đa, Hà Nội, Việt Nam" data-image="images/icon/map.png" data-name="Themesflat Map"></div>
                         <div class="gm-map">
                              <div class="map s1"></div>
                         </div>
                    </section><!-- /#flat-map-2 -->
               </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
     </div><!-- /.container-fluid -->
</section><!-- /.flat-map-zoom-in -->


<script>
     //    $("#price-slider-range").slider({
     //         min: 0,
     //         max: 24000000,
     //         step: 150000,
     //         value: [0,24000000]
     //    });
     //    $("#price-slider-range").on('slide', function(slideEvt){
     //      $('.price-min').text(slideEvt.value[0] + ' VNĐ');
     //      $('.price-max').text(slideEvt.value[1] + ' VNĐ');
     //    });
     (function($) {
          var hotelList = <?= json_encode($hotelList) ?>;
          var amenities = <?= json_encode($amenities) ?>

          APP.vueInstance = new Vue({
               el: '#hotel-list',
               data: {
                    hotelList: hotelList,
                    amenities: amenities,
                    sliderValue: [0, 24000000],
               },
               methods: {

               },
          })
     })(jQuery)
</script>