<?php
include('user-profile_css.php')
?>

<div class="user-profile">
     <section class="user-tab-menu parallax parallax1">
          <div class="container">
               <div class="profile-head text-center">
                    <div class="profile-avatar">
                         <div class="avatar-edit">
                              <input id="profile-image-upload" type="file" accept=".png, .jpg, .jpeg">
                              <label for="profile-image-upload"></label>
                         </div>
                         <div class="avatar-preview">
                              <div id="profile-image-preview" style="background-image:url('../../resources/images/page/user-profile.jpg');"></div>
                         </div>
                    </div>
                    <div class="profile-info">
                         <div class="profile-info__name">Phạm Trương Tiểu Phụng</div>
                         <div class="profile-info__des">Đà Nẵng, Việt Nam</div>
                    </div>
                    <div class="profile-controls">
                         <ul class="nav" id="myTab" role="tablist">
                              <li class="nav-item"><a class="nav-link profile-control-block active" id="user-profile-tab" data-toggle="tab" href="#user-profile" role="tab" aria-controls="user-profile" aria-selected="true">Thông tin</a></li>
                              <li class="nav-item"><a class="nav-link profile-control-block" id="user-plan-tab" data-toggle="tab" href="#user-plan" role="tab" aria-controls="user-plan" aria-selected="false">Lịch trình</a></li>
                              <li class="nav-item"><a class="nav-link profile-control-block" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Nhật ký</a></li>
                         </ul>
                    </div>
               </div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="profile-content-section">
          <div class="profile-body">
               <div class="tab-content py-5" id="myTabContent">
                    <div class="tab-pane" id="user-profile" role="tabpanel" aria-labelledby="user-profile-tab">
                         <div class="container">
                              <div class="user-seen user-section-card">
                                   <div class="col-12 block-content country-block d-md-flex align-items-center">
                                        <div class="country-block__img"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/country.jpg" alt=""></div>
                                        <div class="country-block__content">
                                             <div class="title">1 Điểm đến</div>
                                             <div class="description">Bạn đã từng trải nghiệm</div>
                                        </div>
                                   </div>
                              </div>
                              <div class="user-seen user-section-card d-flex mt-5">
                                   <div class="col-md-6 col-sm-12 block-content country-block d-md-flex align-items-center">
                                        <div class="country-block__img"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/time-to-travel.jpg" alt=""></div>
                                        <div class="country-block__content">
                                             <div class="title">1 Ngày</div>
                                             <div class="description">Khoảng thời gian để chu du</div>
                                        </div>
                                   </div>
                                   <div class="col-md-6 col-sm-12 block-content country-block d-md-flex align-items-center">
                                        <div class="country-block__img"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/backpack.jpg" alt=""></div>
                                        <div class="country-block__content">
                                             <div class="title">1 Lịch trình</div>
                                             <div class="description">Bạn đã thực hiện</div>
                                        </div>
                                   </div>
                              </div>
                              <div class="create-plan-btn">
                                   <div class="text-center mt-5"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/zigzag.svg" alt="">
                                        <div class="txt-16">Tăng con số lên nào!</div>
                                   </div>
                                   <div class="btn-more"><a href="#" title="">Tạo lịch trình</a></div>
                              </div>
                         </div>
                    </div>
                    <div class="tab-pane user-plan-block active" id="user-plan" role="tabpanel" aria-labelledby="user-plan-tab">
                         <div class="container">
                              <div class="plan-section">
                                   <div class="destination-block">
                                        <div class="des-wrap"><a href=""><img src="<?= Yii::$app->homeUrl ?>resources/images/page/user-profile/unnamed.jpg" alt=""><span class="des-content txt-white">
                                                       <div class="des-content__name">Đà Lạt</div>
                                                       <div class="des-content__time">2 Ngày</div>
                                                  </span></a>
                                             <div class="dropdown-style-1"><a href="javascript:void(0)">
                                                       <div class="dailist-sub-menu"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
                                                  </a>
                                                  <ul class="list">
                                                       <li><a href="#">Sửa</a></li>
                                                       <li><a href="#">Xóa</a></li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="create-plan-btn">
                                   <div class="btn-more"><a href="#" title="">Tạo lịch trình</a></div>
                              </div>
                         </div>
                    </div>
                    <div class="tab-pane" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                         <div class="container">
                              <div class="user-seen user-section-card">
                                   <div class="block-content country-block d-md-flex align-items-center">
                                        <div class="country-block__img"><img src="<?= Yii::$app->homeUrl ?>resources/images/icon/country.jpg" alt=""></div>
                                        <div class="country-block__content">
                                             <div class="title">1 Điểm đến</div>
                                             <div class="description">Bạn đã từng trải nghiệm</div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>