<?php
use app\modules\contrib\gxassets\GxSwiperAsset;

GxSwiperAsset::register($this);
include('hotel-detail_css.php')
?>

<div class="visit-location-detail">
     <section class="page-title parallax parallax1">
          <div class="container">
               <div class="row">
                    <div class="col-md-12">
                         <div class="page-title-heading">
                              Địa Điểm Tham Quan
                         </div>
                         <ul class="breadcrumbs">
                              <li>
                                   <a href="#" title="">Trang chủ</a>
                                        <span class="arrow_right"></span>
                              </li>
                              <li>
                                   Tham quan
                              </li>
                         </ul>
                    </div><!-- /.col-md-12 -->
               </div><!-- /.row -->
          </div><!-- /.container -->
          <div class="overlay"></div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                              <div class="box-title"><a href="#" title="">Nhà thờ Domaine de Marie</a><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>1 Ngô Quyền, P. 6, TP Đà Lạt, Lâm Đồng</li>
                                   <li class="phone"><i class="fa fa-phone" aria-hidden="true"></i>Không có</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>09:00 AM - 05:00 PM</li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-md-4 text-right">
                         <div class="title-right">
                              <div class="btn-more review"><a href="#" title="">Đánh giá</a></div>
                              <div class="clearfix"></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="flat-row flat-explore-detail">
          <div class="container">
               <div class="text-box">
                    <h3>Thông tin</h3>
                    <div class="text-desc">
                         <p>Nhà thờ Domaine de Marie (còn gọi là Lãnh địa Đức Bà hay nhà thờ Mai Anh) được xây dựng từ năm 1940 - 1944 do phu nhân toàn quyền Đông Dương Jean Decoux đứng ra quyên góp từ nhiều giáo dân. Nhà thờ cách trung tâm thành phố Đà Lạt 1 km về phía tây nam, được xây dựng theo phong cách châu Âu thế kỷ XVII, có sự kết hợp hài hòa giữa kiến trúc phương Tây với kiến trúc của dân tộc thiểu số vùng Tây Nguyên. Nét riêng của nhà thờ Domain de Marie là không có tháp chuông, hệ thống chiếu sáng của nhà thờ được làm bằng những khung kính màu. Bạn có thể nhìn thấy một pho tượng Đức Mẹ ban ơn cao 3 m, nặng 1 tấn đứng trên quả địa cầu, được khắc hoạ theo hình người phụ nữ Việt Nam, do kiến trúc sư người Pháp Jonchere thiết kế.</p>
                         <p>Nhà thờ Domain de Marie không mất vé tham quan, ở đây chỉ có tu nữ, họ sống và làm việc ở đây như đan áo lạnh và bán cho du khách vào tham quan.</p>
                    </div>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper">
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/visit-location.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/nha-tho-1.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/nha-tho-2.jpg"></div>
                              </div>
                              <!-- Add Arrows-->
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
               <div class="comment-area mt-4">
                    <h3 class="comment-title">3 Reviews</h3>
                    <ol class="comment-list">
                         <li class="comment">
                              <article class="comment-body">
                                   <div class="comment-image"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/comment/comment_01.png" alt=""></div>
                                   <div class="comment-content">
                                        <div class="comment-metadata">April 8, 2017 9:48 pm</div>
                                        <h5>The food was amazing<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></span></h5>
                                        <div class="comment-author">by <a href="#" title="">Alex luthor</a></div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                         <li class="comment"></li>
               </div>
               </article>
               </li>
               </ol>
          </div>
          </div>
     </section>
</div>

<script>
     (function ($) {
          var swiper = new Swiper('.swiper-container', {
               // slidesPerView: 3,
               centeredSlides: true,
               loop: true,
               pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
               },
               navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
               },
          });
     })(jQuery);
</script>