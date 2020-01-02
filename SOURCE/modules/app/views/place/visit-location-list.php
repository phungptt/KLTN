<?php
include('visit-location-list_css.php')
?>

<section class="flat-map-zoom-in" id="visit-location-list">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="flat-filter">
                         <div class="wrap-box-search style2 ">
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
                                                  <a href="#" title="">Preview</a>
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
                                                  <a href="#" title="">{{visit.name}}
                                             </div>
                                             <div class="address">
                                                  <p>{{visit.address}}</p>
                                             </div>
                                             <!-- <ul class="location">
                                                  <li class="address"><span class="ti-location-pin"></span>Hanoi, Vietnam</li>
                                                  <li class="closed">Closed Now !</li>
                                             </ul> -->
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
     (function($) {
          var visitLocationList = <?= json_encode($visit) ?>;

          APP.vueInstance = new Vue({
               el: '#visit-location-list',
               data: {
                    visitList: visitLocationList,
                    selectDestination: null
               },
               methods: {

               },
          })
     })(jQuery)
</script>