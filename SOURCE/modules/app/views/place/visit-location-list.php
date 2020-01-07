<?php
use app\modules\app\AppConfig;
use app\modules\app\widgets\CMSMapListWidget;
use app\modules\contrib\gxassets\GxLeafletAsset;

GxLeafletAsset::register($this);
include('visit-location-list_css.php')
?>

<section class="flat-map-zoom-in" id="visit-location-list">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="flat-filter">
                         <div class="wrap-box-search style2 mt-0">
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
                              </form><!-- /form -->
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         
                         <div class="wrap-imagebox style3">
                              <div class="imagebox style2" style="display: block;" v-for="visit in visitList">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="visit.path" alt="">
                                                  <a :href="'<?= AppConfig::getUrl('place/visit-location-detail?slug=') ?>'  + visit.slug" title="">Xem</a>
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
                                                  <a href="javascript:void(0)" title="" @click="viewLocation(visit)" @mouseover="showMarkerPopup(visit.id)">{{visit.name}}</a>
                                             </div>
                                             <div class="address">
                                                  <p>{{visit.address}}</p>
                                             </div>
                                        </div><!-- /.box-content -->
                                   </div><!-- /.box-imagebox -->
                                   <div class="height30"></div>
                              </div>
                              <div class="clearfix"></div>
                              <!-- <div class="btn-more">
                                   <a href="#" title="">Tải thêm</a>
                              </div> -->
                         </div><!-- /.wrap-imagebox -->
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6">
                    <section class="pdmap">
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
          var visitLocationList = <?= json_encode($visit) ?>

          APP.vueInstance = new Vue({
               el: '#visit-location-list',
               data: {
                    visitList: visitLocationList,
                    selectLocation: null
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