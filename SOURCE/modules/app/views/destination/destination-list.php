<?php
use app\modules\app\AppConfig;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\app\widgets\AppObjectMapWidget;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('destination-list_css.php');
?>

<div class="destination-list" id="destination-list">     
     <section class="flat-map-zoom-in">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-6">
                         <div class="flat-filter">
                              <div class="wrap-box-search style2">
                                   <form action="#" method="get" accept-charset="utf-8">
                                        <span class="w-100">
                                             <input type="text" placeholder="Tìm kiếm ?" name="search">
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
                              <div class="wrap-imagebox style3" v-for="dest in destinations">
                              <div class="imagebox style2" style="display: block;">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img :src="avatars[0]" alt="">
                                                  <a href="#" title="">Xem</a>
                                             </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-content">
                                             <div class="box-title ad">
                                                  <a href="#" title="">{{dest.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li>5 rating</li>
                                                  <li>Moderate</li>
                                             </ul>
                                             <div class="box-desc">
                                                  {{dest.short_description}}
                                             </div>
                                        </div><!-- /.box-content -->
                                   </div><!-- /.box-imagebox -->
                              </div>
                              </div><!-- /.wrap-imagebox -->
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
</div>


<script>
     (function($){
          var destinationList = <?= json_encode($destinations) ?>;
          var avatars = <?= json_encode($avatars) ?>;

          APP.vueInstance = new Vue({
               el: '#destination-list',
               data: {
                    destinations: destinationList,
                    avatars: avatars,
                    selectDestination: null
               },
               methods: {
                    
               },
          })

          var map = L.map('flat-map').setView([16.0544,108.2022 ], 6);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          L.marker([16.0544,108.2022]).addTo(map)
          .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
          .openPopup();
     })(jQuery)
</script>