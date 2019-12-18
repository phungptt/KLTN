<?php
     include('create-plan_css.php')
?>
<div class="create-plan">
     <section class="page-title parallax parallax1">
          <div class="container">
               <div class="row">
                    <div class="col-md-12">
                         <div class="page-title-heading"> Tạo lịch trình
                         </div>
                         <ul class="breadcrumbs">
                              <li> <a href="#" title="Trang chủ">Trang chủ</a><span class="arrow_right"></span></li>
                              <li>Tạo lịch trình</li>
                         </ul>
                    </div>
               </div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="create-plan-content">
          <div class="container">
               <div class="row align-items-center my-5">
                    <div class="col-lg-6"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/create-plan/create-plan.png" alt=""></div>
                    <div class="col-lg-6">
                         <form id="create-trip-plan" action="">
                              <div class="destination">
                                   <label class="label-control" for="">Điểm đến</label>
                                   <input type="text">
                              </div>
                              <div class="row align-items-center calendar-group">
                                   <div class="col-12">
                                        <label class="label-control" for="">Thời gian</label>
                                        <div class="postion-relative">
                                             <input class="from-date" type="text" placeholder="jj/mm/aaaa" name="dates"><i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                   </div>
                              </div>
                         </form>
                         <div class="create-plan-btn">
                              <div class="btn-more"><a href="/create-plan-detail.html" title="">Tạo lịch trình</a></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>