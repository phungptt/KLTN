
<?php
     use app\modules\contrib\gxassets\GxSwiperAsset;

     GxSwiperAsset::register($this);
     include('destination-detail_css.php')
?>

<div class="destination-detail">
     <section class="destination-banner-section banner-section">
          <div class="banner-img"></div>
          <div class="text-box">
               <div class="title"> <span class="destination">Đà Lạt</span></div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="destination-content">
          <div class="container">
               <div class="text-desc my-5">
                    <p>Có rất nhiều địa điểm du lịch bạn chỉ cần 1 ngày tham quan là đủ, Đà Lạt lại có đến hàng trăm thứ hấp dẫn khiến bạn bận rộn suốt tuần vẫn chưa trải nghiệm hết. Có những điểm du lịch bạn chỉ muốn đến 1 trong đời, Đà Lạt lại khiến người ta thấy nhớ, thấy thương, dù có lui tới bao nhiêu lần vẫn muốn quay lại. </p>
                    <p>Bởi lẽ Đà Lạt đẹp quanh năm. Nằm trên cao nguyên Lâm Viên, thuộc vùng Tây Nguyên, Đà Lạt có khí hậu ôn đới, ẩn hiện trong sương mù, không khí lúc nào cũng mát mẻ, khoan khoái. Được mệnh danh là "Thành phố ngàn hoa", "Thành phố Tình Yêu", Đà Lạt là thủ phủ của hàng trăm ngàn loài hoa khoe sắc muôn nơi: hoa ngập tràn các điểm tham quan, hoa rộn ràng khắp phố phường, hoa len lỏi từng ngõ ngách, hoa hiện diện trong nếp sống nhà nhà, cả những loài hoa dại ven đường cũng bùng lên sức sống và "nổi tiếng" không kém cạnh (dã quỳ, đồi cỏ hồng). </p>
                    <p>Chỉ cần ở thành phố một ngày, bạn vẫn cảm nhận được 4 mùa trong năm: buổi sáng ấm áp như tiết trời xuân, buổi trưa nắng hạ vàng ươm, buổi chiều bồng bềnh mây trắng dìu dịu như sang thu, về đêm khoác lên mình cái lạnh buốt tê tái của mùa đông. Người dân Đà Lạt hiền lành, đôi má phơn phớt hồng, cuộc sống chậm rãi, dễ chịu. Nơi đây có đầy đủ các loại hình du lịch: nghỉ dưỡng (thưởng lãm hoa, nhâm nhi những đặc sản nóng giòn thơm phức...), trò chơi cảm giác mạnh (vượt thác), leo núi (Lang Biang)</p>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper">
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-1.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-2.jpg"></div>
                                   <div class="swiper-slide"> <img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-3.jpg"></div>
                              </div>
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section class="place-section my-5">
          <div class="container">
               <div class="text-box">
                    <h3>Địa điểm nổi bật</h3>
               </div>
               <div class="place-list">
                    <div class="place-list__item">
                         <div class="place-item-img"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-1.jpg"></div>
                         <div class="place-item-content">
                              <div class="title">
                                   Hồ Tuyền Lâm</div>
                              <div class="rating">
                                   <div class="title-left">
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>12 reviews</span></div>
                                   </div>
                              </div>
                              <hr>
                              <div class="bottom-area">
                                   <div class="ml-auto"><a class="btn-small" href="#">Khám phá</a></div>
                              </div>
                         </div>
                    </div>
                    <div class="place-list__item">
                         <div class="place-item-img"><img src="<?= Yii::$app->homeUrl ?>resources/images/page/destination-detail/slider-1.jpg"></div>
                         <div class="place-item-content">
                              <div class="title">
                                   Nhà thờ Domaine de Marie</div>
                              <div class="rating">
                                   <div class="title-left">
                                        <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>12 reviews</span></div>
                                   </div>
                              </div>
                              <hr>
                              <div class="bottom-area">
                                   <div class="ml-auto"><a class="btn-small" href="#">Khám phá</a></div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="btn-more">
                    <a href="#" title="">Xem thêm</a>
               </div>
          </div>
     </section>
</div>

<script>
     (function ($) {
          var swiper = new Swiper('.swiper-container', {
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

