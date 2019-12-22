<?php
use app\modules\contrib\gxassets\GxLeafletAsset;

GxLeafletAsset::register($this);
include('food-list_css.php')
?>

<section class="flat-map-zoom-in">
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
                              <div class="imagebox style3">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-01.png" alt="">
                                                  <a href="#" title="">Xem</a>
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
                                                  <a href="#" title="">AN Restaurant</a><i class="fa fa-check-circle" aria-hidden="true"></i>
                                             </div>
                                             <ul class="rating">
                                                  <li>5 rating</li>
                                                  <li>5 reviews</li>
                                             </ul>
                                             <div class="box-desc">
                                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                             </div>
                                        </div><!-- /.box-content -->
                                        <ul class="location">
                                             <li class="address"><span class="ti-location-pin"></span>Hà Nội</li>
                                             <li class="closed">Closed Now !</li>
                                        </ul><!-- /.location -->
                                   </div><!-- /.box-imagebox -->
                              </div><!-- /.imagebox style3 -->
                              <div class="imagebox style3">
                                   <div class="box-imagebox">
                                        <div class="box-header">
                                             <div class="box-image">
                                                  <img src="<?= Yii::$app->homeUrl ?>resources/images/page/home-page/img-01.png" alt="">
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
                                                  <a href="#" title="">AN Restaurant</a><i class="fa fa-check-circle" aria-hidden="true"></i>
                                             </div>
                                             <ul class="rating">
                                                  <li>5 rating</li>
                                                  <li>5 reviews</li>
                                             </ul>
                                             <div class="box-desc">
                                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                             </div>
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
                         
                    </section><!-- /#flat-map-2 -->
               </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
     </div><!-- /.container-fluid -->
</section><!-- /.flat-map-zoom-in -->

<script>
     (function($){
          var map = L.map('flat-map').setView([16.0544,108.2022 ], 6);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          L.marker([16.0544,108.2022]).addTo(map)
          .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
          .openPopup();
     })(jQuery)
</script>

