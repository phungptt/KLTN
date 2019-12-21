<?php
include('plan-trip-detail_css.php')
?>

<div class="plan-trip-detail">
     <section class="destination-banner-section banner-section">
          <div class="banner-img"></div>
          <div class="text-box">
               <div class="title"> <span class="destination">Đà Lạt</span></div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="plan-view my-5">
          <div class="container">
               <div class="row">
                    <div class="col-2 plan-view__sidebar">
                         <div class="nav flex-column nav-pills w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical"><a class="nav-link active w-100" id="day-1" data-toggle="pill" href="#tab-day-1" role="tab" aria-controls="tab-day-1" aria-selected="true">
                                   <div class="cloud">
                                        <div class="cloudshadow"></div>
                                        <div class="day-title">Ngày 1</div>
                                   </div>
                              </a><a class="nav-link w-100" id="day-2" data-toggle="pill" href="#tab-day-2" role="tab" aria-controls="tab-day-2" aria-selected="false">
                                   <div class="cloud">
                                        <div class="cloudshadow"> </div>
                                        <div class="day-title">Ngày 2</div>
                                   </div>
                              </a></div>
                    </div>
                    <div class="col-5 plan-view__content">
                         <div class="tab-content" id="v-pills-tabContent">
                              <div class="tab-pane fade show active" id="tab-day-1" role="tabpanel" aria-labelledby="day-1">
                                   <div class="day-view-wrap">
                                        <div class="day-plan-list">
                                             <div class="day-plan-list__item">
                                                  <div class="line-connect"></div>
                                                  <div class="step">1</div>
                                                  <div class="content-view">
                                                       <div class="title-name">Clay Tunnel</div>
                                                       <div class="rating">
                                                            <div class="title-left">
                                                                 <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                            </div>
                                                       </div>
                                                       <div class="content-detail d-flex">
                                                            <div class="text-detail">
                                                                 <p>1.5 hours</p>
                                                                 <p>Art installation area with an array of giant clay sculptures of everything from lizards to trains.</p>
                                                            </div><img src="<?= Yii::$app->homeUrl ?>resources/images/page/plan-trip-detail/item-1.jpg">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="day-plan-list__item">
                                                  <div class="time-moving d-flex"><a href="#"><i class="fa fa-car"> </i><span class="time-moving-text">15 phút</span></a></div>
                                                  <div class="line-connect"></div>
                                                  <div class="step">2</div>
                                                  <div class="content-view">
                                                       <div class="title-name">Tuyền Lâm Lake</div>
                                                       <div class="rating">
                                                            <div class="title-left">
                                                                 <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                            </div>
                                                       </div>
                                                       <div class="content-detail d-flex">
                                                            <div class="text-detail">
                                                                 <p>50 minutes</p>
                                                                 <p>Surrounded by trees, this sizable man-made lake offers scenic views amid a serene environment.</p>
                                                            </div><img src="<?= Yii::$app->homeUrl ?>resources/images/page/plan-trip-detail/item-2.jpg">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="day-plan-list__item">
                                                  <div class="time-moving d-flex"><a href="#"><i class="fa fa-car"> </i><span class="time-moving-text">15 phút</span></a></div>
                                                  <div class="line-connect"></div>
                                                  <div class="step">3</div>
                                                  <div class="content-view">
                                                       <div class="title-name">Domaine de Marie</div>
                                                       <div class="rating">
                                                            <div class="title-left">
                                                                 <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                            </div>
                                                       </div>
                                                       <div class="content-detail d-flex">
                                                            <div class="text-detail">
                                                                 <p>1 giờ</p>
                                                                 <p>Landmark pink church in a serene setting featuring landscaped gardens & a small shop.</p>
                                                            </div><img src="<?= Yii::$app->homeUrl ?>resources/images/page/plan-trip-detail/item-3.jpg">
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="tab-pane fade" id="tab-day-2" role="tabpanel" aria-labelledby="day-2">
                                   Ngày 2</div>
                         </div>
                    </div>
                    <div class="col-5 plan-view__map"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/plan-trip-detail/map.png"></div>
               </div>
          </div>
     </section>
</div>