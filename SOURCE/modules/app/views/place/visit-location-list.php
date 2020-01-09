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
                              </form><!-- /form -->
                         </div><!-- /.wrap-box-search -->
                         <div class="clearfix"></div>
                         
                         <div class="wrap-imagebox style1">
                              <div class="imagebox style3" style="display: block;" v-for="(visit, index) in visitList.slice(pageStart, pageStart + countOfPage)">
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
                                                  <a :href="'<?= AppConfig::getUrl('place/visit-detail?slug=') ?>'  + visit.slug" title="" >{{visit.name}}</a>
                                             </div>
                                             <ul class="rating">
                                                  <li>5 rating</li>
                                                  <li>5 reviews</li>
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
                                        <nav aria-label="Page navigation example">
                                             <ul class="pagination justify-content-center">
                                                  <li class="page-item" v-bind:class="{'disabled': (currPage === 1)}" @click.prevent="setPage(currPage-1)"><a class="page-link" href="">Trang trước</a></li>
                                                  <li class="page-item" v-for="n in totalPage" v-bind:class="{'active': (currPage === (n))}" @click.prevent="setPage(n)"><a class="page-link" href="">{{n}}</a></li>
                                                  <li class="page-item" v-bind:class="{'disabled': (currPage === totalPage)}" @click.prevent="setPage(currPage+1)"><a class="page-link" href="">Trang sau</a></li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div><!-- /.row -->
                         </div><!-- /.wrap-imagebox -->
                    </div><!-- /.flat-filter -->
               </div><!-- /.col-md-6 -->
               <div class="col-lg-6">
                    <section class="pdmap">
                         <div class="pdmap style2" style="height: 1200px;">
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
                    selectLocation: null,
                    countOfPage: 4,
                    currPage: 1,
               },
               computed: {
                    pageStart: function() {
                         return (this.currPage - 1) * this.countOfPage;
                    },
                    totalPage: function() {
                         return Math.ceil(this.visitList.length / this.countOfPage);
                    }
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