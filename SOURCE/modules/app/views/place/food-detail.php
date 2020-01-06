<?php
     use app\modules\contrib\gxassets\GxSwiperAsset;
     use app\modules\contrib\gxassets\GxVueAsset;

     GxSwiperAsset::register($this);
     GxVueAsset::register($this);
     include('food-detail_css.php');
?>

<div class="food-detail" id="food-detail">
     <section class="banner-section">
          <div class="banner-img"  :style="{ backgroundImage: 'url(' +  selectFood.path + ')' }"></div>
          <div class="text-box">
               <h2 class="title">{{selectFood.name}}</h2>
          </div>
     </section>
     <section class="flat-title">
          <div class="container">
               <div class="row">
                    <div class="col-md-8">
                         <div class="title-left">
                              <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                              <div class="box-title"><a href="#" title="">{{selectFood.name}}</a></div>
                              <ul class="box-address">
                                   <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>{{selectFood.address}}</li>
                                   <li class="phone" v-if="selectFood.phone_number"><i class="fa fa-phone" aria-hidden="true"></i>{{selectFood.phone_number}}</li>
                                   <li class="phone" v-else><i class="fa fa-phone" aria-hidden="true"></i>Không có</li>
                                   <li class="open-hour"><i class="fa fa-clock-o" aria-hidden="true"></i>{{selectFood.time_open}} - {{selectFood.time_closed}}</li>
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
                         <p>{{selectFood.description}}</p>
                    </div>
               </div>
               <div class="image-slider-block">
                    <div class="text-box">
                         <h3>Hình ảnh</h3>
                    </div>
                    <div class="slider-box">
                         <div class="swiper-container">
                              <div class="swiper-wrapper" v-for="image in imagesRelate">
                                   <div class="swiper-slide"> <img :src="image.path"></div>
                              </div>
                              <div class="swiper-button-next"></div>
                              <div class="swiper-button-prev"></div>
                         </div>
                    </div>
               </div>
               <div class="comment-area">
							<h3 class="comment-title">3 Reviews</h3>
							<ol class="comment-list">
								<li class="comment" style="display: list-item;">
									<article class="comment-body">
										<div class="comment-image">
											<img src="images/blog/comment_01.png" alt="">
										</div><!-- /.comment-image -->
										<div class="comment-content">
											<div class="comment-metadata">
												April 8, 2017 9:48 pm
											</div>
											<h5>
												The food was amazing
												<span>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</span>
											</h5>
											<div class="comment-author">
												by <a href="#" title="">Alex luthor</a>
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
											</p>
											<div class="comment-like">
												<ul>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 2</a>
													</li>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 0</a>
													</li>
												</ul>
												<div class="comment-reply">
													<a href="#" title="">Reply</a>
												</div>
											</div><!-- /.comment-like -->
										</div><!-- /.comment-content -->
									</article><!-- /.comment-body -->
								</li><!-- /.comment -->
								<li class="comment" style="display: list-item;">
									<article class="comment-body">
										<div class="comment-image">
											<img src="images/blog/comment_02.png" alt="">
										</div><!-- /.comment-image -->
										<div class="comment-content">
											<div class="comment-metadata">
												April 2, 2017 5:48 pm
											</div>
											<h5>
												We had a great time !!!!
												<span>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</span>
											</h5>
											<div class="comment-author">
												by <a href="#" title="">Patricia Alice</a>
											</div>
											<p>
												Such a lovely place. The host met us at agreed time, showed us everything. The apartment is conveniently located, a short walk to subway, shops, and restaurants. Wi fi worked well. We had a great time.
											</p>
											<div class="comment-like">
												<ul>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 5</a>
													</li>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 0</a>
													</li>
												</ul>
												<div class="comment-reply">
													<a href="#" title="">Reply</a>
												</div>
											</div><!-- /.comment-like -->
										</div><!-- /.comment-content -->
									</article><!-- /.comment-body -->
								</li><!-- /.comment -->
								<li class="comment">
									<article class="comment-body">
										<div class="comment-image">
											<img src="images/blog/comment_01.png" alt="">
										</div><!-- /.comment-image -->
										<div class="comment-content">
											<div class="comment-metadata">
												April 8, 2017 9:48 pm
											</div>
											<h5>
												The food was amazing
												<span>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</span>
											</h5>
											<div class="comment-author">
												by <a href="#" title="">Alex luthor</a>
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
											</p>
											<div class="comment-like">
												<ul>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 2</a>
													</li>
													<li>
														<a href="#" title=""><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 0</a>
													</li>
												</ul>
												<div class="comment-reply">
													<a href="#" title="">Reply</a>
												</div>
											</div><!-- /.comment-like -->
										</div><!-- /.comment-content -->
									</article><!-- /.comment-body -->
								</li><!-- /.comment -->
							</ol><!-- /.comment-list -->
							<div class="load-more">
								<a href="" title="">Load More</a>
							</div>
							<div class="comment-respond">
								<h2 class="comment-reply-title">Leave a Review</h2>
								<div class="comment-vote">
									<p>Your Rating for this listing</p>
									<star-rating></star-rating>
									<span>Good!!!</span>
								</div>
								<form action="#" class="comment-form" method="get" accept-charset="utf-8">
									<div class="clearfix"></div>
									<div class="comment-form-comment">
										<label for="comment-comment">Review</label>
										<textarea id="comment-comment" name="comment"></textarea>
										<p>
											Your review recommended to be at least 140 characters long
										</p>
									</div>
									<div class="submit-form">
										<button type="submit">Submit Your Review</button>
									</div>
								</form><!-- /.comment-form -->
							</div><!-- /.comment-respond -->
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
          var selectFood = <?= json_encode($food) ?>;
          var imagesRelate = <?= json_encode($imagesRelate) ?>
          Vue.component('star-rating', {

          })

          APP.vueInstance = new Vue({
               el: '#food-detail',
               data: {
                    selectFood: selectFood,
                    imagesRelate: imagesRelate,
                    rating: "No Rating Selected",
                    boundRating: 3
               },
              
               methods: {
                    
               },
               // mounted() {
               //      this.swiper = new window.Swiper('.swiper-container', {
               //           cssMode: true,
               //           navigation: {
               //                nextEl: '.swiper-button-next',
               //                prevEl: '.swiper-button-prev',
               //           },
               //           pagination: {
               //                el: '.swiper-pagination',
               //                clickable: true,
               //           },
               //           mousewheel: true,
               //           keyboard: true,
               //      })
               // },
          });
     })(jQuery);
</script>