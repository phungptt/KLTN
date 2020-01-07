<?php
use app\modules\app\AppConfig;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\app\widgets\AppObjectMapWidget;
use app\modules\app\widgets\CMSMapListWidget;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('food-list_css.php')
?>

<section class="flat-map-zoom-in" id="food-list">
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
                                        <span class="ti-location-pin"></span>
                                        <input type="text" placeholder="Địa điểm" name="location">
                                   </span>
                                   <span class="categories">
                                        <span class="ti-angle-down"></span>
                                   </span>
                                   <div class="clearfix"></div>
                              </form><!-- /form -->
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         <div class="filter-result pt-3">
                              <div class="result">
                                   5 Results Found
                              </div>
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
                              <div class="imagebox style3" v-for="food in foodList">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="food.path" alt="" class="w-100">
                                                  <a :href="'<?= AppConfig::getUrl('place/food-detail?slug=') ?>'  + food.slug" title="">Xem</a>
                                                  <div class="overlay"></div>
                                                  <div class="queue">
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star" aria-hidden="true"></i>
                                                       <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                  </div>
                                             </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-content">
                                             <div class="box-title ad">
                                                  <a href="#" title="" @click="viewLocation(food)" @mouseover="showMarkerPopup(food.id)">{{food.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li>5 rating</li>
                                                  <li>5 reviews</li>
                                             </ul>
                                        </div><!-- /.box-content -->
                                        <ul class="location">
                                             <li class="address"><span class="ti-location-pin"></span>Hà Nội</li>
                                             <li class="closed">Closed Now !</li>
                                        </ul><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                              </div><!-- /.imagebox style3 -->
                              <div class="clearfix"></div>
                              <div class="btn-more">
                                   <a href="#" title="">Load More</a>
                              </div>
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

<script>
     (function($){
          var foodList = <?= json_encode($foodList) ?>

          APP.vueInstance = new Vue({
               el: '#food-list',
               data: {
                    foodList: foodList,
                    selectDestination: null
               },
               methods: {
                    viewLocation: function(location){
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
                    }
               },
          })


     })(jQuery)
</script>

