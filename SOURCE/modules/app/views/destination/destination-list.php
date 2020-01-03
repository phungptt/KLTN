<?php
use app\modules\app\AppConfig;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\app\widgets\AppObjectMapWidget;
use app\modules\app\widgets\CMSMapDetailWidget;

GxLeafletAsset::register($this);
GxVueAsset::register($this);
include('destination-list_css.php');
?>

<div class="destination-list" id="destination-list">     
<section class="page-title style1 parallax parallax1">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wrap-box-search style1">
							<form action="#" method="get" accept-charset="utf-8">
								<span class="w-100">
									<input type="text" placeholder="Nhập điểm đến" name="search">
								</span>
								<button type="submit" class="search-btn">Tìm kiếm</button>
							</form><!-- /form -->
						</div><!-- /.wrap-box-search -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
			<div class="overlay"></div>
		</section><!-- /.page-title -->

		<section class="flat-row flat-imagebox style3">
			<div class="container">
				<div class="wrap-imagebox style3" v-for="dest in destinations">
					<div class="row"  >
						<div class="col-sm-12">
							<div class="imagebox style2">
								<div class="box-imagebox">
									<div class="box-header">
										<div class="box-image">
											<img :src="dest.path" alt="">
											<a :href="'<?= AppConfig::getUrl('destination/destination-detail?slug=') ?>'  + dest.slug" title="">Xem</a>
										</div>
									</div><!-- /.box-header -->
									<div class="box-content">
										<div class="box-title ad">
											<a href="" title="">{{ dest.name }}</a>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-half-o" aria-hidden="true"></i>
											</div>
										</div>
										<ul class="rating">
											<li>5 rating</li>
											<li>5 view</li>
										</ul>
										<div class="box-desc">
                                                       {{ dest.short_description }}
										</div>
									</div><!-- /.box-content -->
								</div><!-- /.box-imagebox -->
							</div><!-- /.imagebox style2 -->
						</div><!-- /.col-sm-12 -->
                    </div>
               </div><!-- /.container -->
               <div class="row">
                    <div class="col-md-12">
                         <div class="btn-more">
                              <a href="#" title="">Show More</a>
                         </div>
                    </div>
               </div><!-- /.row -->
		</section><!-- /.flat-imagebox style3 -->
</div>

<script>
     (function($){
          var destinationList = <?= json_encode($destinations) ?>

          APP.vueInstance = new Vue({
               el: '#destination-list',
               data: {
                    destinations: destinationList,
                    selectDestination: null
               },
               methods: {
                   
               },
          })
     })(jQuery)
</script>