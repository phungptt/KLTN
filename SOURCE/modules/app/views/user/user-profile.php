<?php
use app\modules\api\APIConfig;
use app\modules\app\AppConfig;
use app\modules\contrib\gxassets\GxVueAsset;

GxVueAsset::register($this);
include('user-profile_css.php')
?>

<div class="user-profile" id="user-profile">
     <section class="user-tab-menu parallax parallax1">
          <div class="container">
               <div class="profile-head text-center">
                    <div class="profile-avatar">
                         <div class="avatar-edit">
                              <input id="profile-image-upload" type="file" accept=".png, .jpg, .jpeg">
                              <label for="profile-image-upload"></label>
                         </div>
                         <div class="avatar-preview">
                              <div id="profile-image-preview" style="background-image:url('../../resources/images/page/user-profile/man.png');" v-if="userInfo.gender == 0"></div>
                              <div id="profile-image-preview" style="background-image:url('../../resources/images/page/user-profile/woman.png');" v-else></div>
                         </div>
                    </div>
                    <div class="profile-info">
                         <div class="profile-info__name">{{userInfo.fullname}}</div>
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
                    <div class="tab-pane active" id="user-profile" role="tabpanel" aria-labelledby="user-profile-tab">
                         <div class="container">
                              <div class="account-profile">
                                   <form action="" class="form-listing" id="user-profile-form">
                                        <div class="inner-box form">
                                             <div class="form-group">
                                                  <label class="control-label">Họ tên</label>
                                                  <input type="email" name="UserInfo[fullname]" placeholder="" class="input-wrap" :value ="userInfo.fullname">
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label">Số điện thoại</label>
                                                  <input type="email" name="UserInfo[phone]" placeholder="" class="input-wrap" :value ="userInfo.phone">
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label">Email</label>
                                                  <input type="email" name="UserInfo[email]" placeholder="" class="input-wrap" :value ="userInfo.email"disabled>
                                             </div>
                                             <div class="form-group gender-select-wrap">
                                                  <label class="control-label">Giới tính</label>
                                                  <div class="input-wrap row">
                                                       <div class="col-4">
                                                            <label>
                                                                 <input type="radio" class="option-input radio" name="example" checked />
                                                                 Nam
                                                            </label>
                                                       </div>
                                                       <div class="col-4">
                                                            <label>
                                                                 <input type="radio" class="option-input radio" name="example" checked />
                                                                 Nữ
                                                            </label>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label">Ngày sinh</label>
                                                  <input type="date" name="UserInfo[birthday]" placeholder="" class="input-wrap" :value ="userInfo.birthday">
                                             </div>
                                             <div class="form-group">
                                                  <div class="input-wrap margin">
                                                       <button type="submit" class="btn btn-info btn-block btn-update" id="#btn-submit" @click="submitForm">Cập nhật</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
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
                    <div class="tab-pane user-plan-block " id="user-plan" role="tabpanel" aria-labelledby="user-plan-tab">
                         <div class="container">
                              <div class="wrap-imagebox style1">
                                   <div class="imagebox style3">
                                        
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

<script>
     (function($) {
          var userInfo = JSON.parse('<?= json_encode($userInfo, true) ?>');

          APP.vueInstance = new Vue({
               el: '#user-profile',
               data: {
                    userInfo: userInfo
               },
               methods: {
                    submitForm: function() {
                         event.preventDefault();
                         var _this = this,
                         btnSubmit = $("#btn-submit"),
                         formData = new FormData($('#user-profile-form')[0]);

                         btnSubmit.empty().append('Đang lưu thông tin...')

                         $.ajax({
                              contentType: false,
                              processData: false,
                              type: 'POST',
                              url: '<?= APPConfig::getUrl('user/user-profile') ?>',
                              data: formData,
                              success: function(response) {
                                   if (response.status === false) {
                                        toastMessage('error', response.message);
                                   } else {
                                        toastMessage('success', response.message);
                                        window.location.reload();
                                   }
                                   btnSubmit.empty().append('Lưu thông tin');
                              },
                              error: function() {
                                   toastMessage('error', 'Upload failed');
                                   btnSubmit.empty().append('Lưu thông tin');
                              }
                         });
                    }
               },
          })
     })(jQuery)
</script>