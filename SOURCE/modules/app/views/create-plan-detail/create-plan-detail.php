<?php
include('create-plan-detail_css.php')
?>
<div class="create-plan-detail">
     <section class="banner-section">
          <div class="banner-img"></div>
          <div class="text-box">
               <div class="title"> <span class="destination">Sapa</span></div>
               <div class="planning-days d-flex"><i class="fa fa-calendar"></i><span>2 Ngày </span></div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="trip-panel-detail my-5">
          <div class="container">
               <div class="trip-list">
                    <div class="trip-list__item">
                         <div class="day-of-trip"><span>Ngày 1</span></div>
                         <div class="trip-wrap">
                              <ul class="step-list">
                                   <li class="first-step">
                                        <div class="step-timeline-started step-timeline-traveled-info d-flex">
                                             <div class="border"><i class="fa fa-home"> </i></div>
                                             <div class="grow-full-width"><span>Khởi hành</span>
                                                  <div class="date-started">12/07/2019</div>
                                             </div>
                                        </div>
                                   </li>
                                   <li class="js-step">
                                        <div class="step-list-step">
                                             <div class="card-item d-flex">
                                                  <div class="card-image mr-3"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/plan-trip-detail/item-3.jpg"></div>
                                                  <div class="place-text">
                                                       <h3 class="text-16">Thác Bạc </h3>
                                                       <div class="d-flex align-items-center"><i class="fa fa-clock-o"></i><span class="text-12 px-2">45 phút</span></div>
                                                       <div class="d-flex">
                                                            <button class="edit-btn"><span>Sửa</span></button>
                                                            <button class="delete-btn"><span>Xóa</span></button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </li>
                                   <li class="step-list-past-future-separator">
                                        <div class="step-list-past-future-separator-content">
                                             <button class="add-step-empty-trip-button d-flex">
                                                  <div class="add-step-empty-trip-button-icon line-center"> <i class="fa fa-plus"></i></div>
                                                  <div class="add-step-empty-trip-button-text card">Thêm địa điểm</div>
                                             </button>
                                        </div>
                                   </li>
                                   <li class="last-step">
                                        <div class="step-timeline-ended">
                                             <div class="border"><i class="fa fa-flag"></i></div>
                                             <div class="grow-full-width"><span>Kết thúc</span></div>
                                        </div>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="add-place-modal dailylist-modal ">
          <div class="container">
               <div class="trip-panel-editor modal-card">
                    <div class="modal-close-button"><i class="fa fa-times-circle"></i></div>
                    <h4 class="modal-title text-16">
                         Thêm địa điểm </h4>
                    <div class="modal-content">
                         <form class="step-pick-location">
                              <div class="search-box d-flex">
                                   <div class="search-box__item">
                                        <input type="text" placeholder="Tìm kiếm" name="search">
                                   </div>
                                   <div class="search-box__item"><span class="ti-angle-down"></span>
                                        <select name="categories">
                                             <option value="">All Categories</option>
                                             <option value="">All Categories</option>
                                             <option value="">All Categories</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="result-box my-3">
                                   <div class="result-box__item imagebox">
                                        <div class="box-imagebox d-flex">
                                             <div class="box-header">
                                                  <div class="box-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/img-v4-01.png"></div>
                                             </div>
                                             <div class="box-content">
                                                  <div class="box-title"> <a href="#">An Restaurant</a><i class="fa fa-check-circle"></i></div>
                                                  <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                  <div class="address">
                                                       <p>2/51 Hoàng Cầu, Hà Nội</p>
                                                  </div>
                                                  <div class="button-header button-pick-location"><a href="javascript:void(0)">Thêm vào lịch trình</a></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </form>
                         <form class="step-editor-location-info">
                              <div class="horizontal-field">
                                   <div class="horizontal-field__label">Thời gian</div>
                                   <div class="horizontal-field__content">
                                        <div class="step-editor-date">
                                             <div class="line-center">
                                                  <div class="date-picker">
                                                       <select name="day-picker">
                                                            <option value="">Ngày 1</option>
                                                            <option value="">Ngày 2</option>
                                                            <option value="">Ngày 3</option>
                                                       </select>
                                                  </div>
                                                  <div class="time-picker">
                                                       <input class="form-control js-time-picker time-picker" type="text" value="00:00">
                                                       <div class="time-picker-icon"><i class="fa fa-clock-o"></i></div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="navigation-btn line-center">
                                   <div class="button-header"><a href="javascript:void(0)">Thêm địa điểm</a></div>
                                   <div class="button-header button-go-back"><a href="javascript:void(0)">Quay lại</a></div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section>
</div>