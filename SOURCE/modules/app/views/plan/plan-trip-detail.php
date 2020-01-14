<?php

use app\modules\app\services\PlanService;
use app\modules\app\widgets\CMSMapPlanWidget;
use app\modules\contrib\gxassets\GxLeafletAsset;
GxLeafletAsset::register($this);

include('plan-trip-detail_css.php')
?>

<div class="plan-trip-detail" id="plan-trip-detail">
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
                         <div class="nav flex-column nav-pills w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link w-100" :class="index == 0 ? 'active' : ''" v-for="(item, index) in trip" :id="'day-' + index" data-toggle="pill" :href="'#tab-day-' + index" role="tab" :aria-controls="'tab-day-' + index" aria-selected="true">
                                   <div class="cloud">
                                        <div class="cloudshadow"></div>
                                        <div class="day-title">Ngày {{ index + 1 }}</div>
                                   </div>
                              </a>
                         </div>
                    </div>
                    <div class="col-5 plan-view__content">
                         <div class="tab-content" id="v-pills-tabContent">
                              <div class="tab-pane fade show" :class="didx == 0 ? 'active' : ''" v-for="(tripItem, didx) in trip" :id="'tab-day-' + didx" role="tabpanel" :aria-labelledby="'day-' + didx">
                                   <div class="day-view-wrap">
                                        <div class="day-plan-list">
                                             <div class="day-plan-list__item" v-for="(place, pidx) in tripItem.details">
                                                  <div class="time-moving d-flex" v-if="pidx > 0">
                                                       <a href="#">
                                                            <i :class="transferType[tripItem.details[pidx - 1].id_type_of_transport].icon"> </i>
                                                            <span class="time-moving-text font-weight-bold">Di chuyển: {{ Math.floor(tripItem.details[pidx - 1].distance, 2) + 'km - ' + rangeTimeFormat(tripItem.details[pidx - 1].time_move) }}</span>
                                                       </a>
                                                  </div>
                                                  <div class="line-connect"></div>
                                                  <div class="step">{{ pidx + 1 }}</div>
                                                  <div class="content-view">
                                                       <div class="title-name">{{ place.place_name }}</div>
                                                       <div class="rating">
                                                            <div class="title-left">
                                                                 <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                            </div>
                                                       </div>
                                                       <div class="content-detail d-flex">
                                                            <div class="text-detail">
                                                                 <p class="font-weight-bold">Bắt đầu: {{ startTimeFormat(place.time_start) }} | Lưu trú: {{ rangeTimeFormat(place.time_stay) }}</p>
                                                                 <!-- <p class="font-weight-bold">Thời gian rảnh: {{ place.free_time ? rangeTimeFormat(place.free_time) : '0' }}</p> -->
                                                                 <p>{{ place.note }}</p>
                                                            </div><img :src="place.path" style="object-fit: cover">
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-5 plan-view__map">
                         <?= CMSMapPlanWidget::widget() ?> 
                    </div>
               </div>
          </div>
     </section>
</div>

<script>
     $(function() {
          var plan = <?= json_encode($plan) ?>;
          var plan_detail = JSON.parse('<?= $plan['route_json'] ?>');
          var vm = new Vue({
               el: '#plan-trip-detail',
               data: {
                    plan: plan,
                    trip: plan_detail,
                    transferType: [
                         {
                              type: 'car',
                              label: 'Xe ô tô',
                              icon: 'fa fa-car'
                         }, {
                              type: 'pedestrian',
                              label: 'Người đi bộ',
                              icon: 'fa fa-walking'
                         }, {
                              type: 'bicycle',
                              label: 'Xe đạp',
                              icon: 'fa fa-biking'
                         },
                    ]
               },

               mounted: function() {
                    var _this = this
                    _this.$nextTick(function() {
                         console.log(DATA)
                         _this.initTripLayer()
                    })
               }, 

               created: function() {
                    
               },

               methods: {
                    rangeTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'range');
                    },

                    startTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'oclock');
                    },
                    
                    initTripLayer: function() {
                         var _this = this;
                         _this.trip.forEach((tripItem, didx) => {
                              // let arrLayerGroup = [];
                              DATA.layers.tripLayers[didx] = L.layerGroup()
                              tripItem.details.forEach((place, index) => {
                                   //init icon place
                                   let placeIcon = '<img src="' + place.path + '" id="image-object-on-map-' + place.slug + '">';
                                   let divIcon = L.divIcon({
                                        html: placeIcon,
                                        className: 'image-object-on-map position-relative',
                                        iconSize: [48, 48],
                                        iconAnchor: [24, 53],
                                        popupAnchor: [0, -44]
                                   });
                                   let placeMarker = L.marker([place.lat, place.lng], {icon: divIcon}).bindPopup(_this.contentImagePopup(place))
                                   DATA.layers.tripLayers[didx].addLayer(placeMarker)

                                   //getLineString
                                   if(index < tripItem.details.length - 1) {
                                        var prePlace = tripItem.details[index]
                                        var nextPlace = tripItem.details[index + 1]
                                        _this.getRoutesAndDistancesBetweenLocations(prePlace, nextPlace, DATA.transferType[prePlace.id_type_of_transport].type, function(shape) {
                                             let routeLine = L.polyline(shape, {color: 'blue'})
                                             DATA.layers.tripLayers[didx].addLayer(routeLine)
                                        })
                                   }
                              });
                         })

                         console.log(DATA.layers.tripLayers);
                    },

                    getRoutesAndDistancesBetweenLocations: function(waypoint0, waypoint1, transporttype, callback) {
                         var urlApiGetDistances = 'https://route.ls.hereapi.com/routing/7.2/calculateroute.json?apiKey=<?= PlanService::$HERE_KEY ?>' + '&waypoint0=geo!' + waypoint0.lat + ',' + waypoint0.lng + '&waypoint1=geo!' + waypoint1.lat + ',' + waypoint1.lng + '&routeattributes=sh&mode=fastest;' + transporttype;
                         return $.ajax({
                              url: urlApiGetDistances,
                              success: function(data) {
                                   if (data.response.route) {
                                        callback(data.response.route[0].shape);
                                   } else {
                                        callback(false);
                                   }
                              },
                              error: function(msg) {
                                   callback(false);
                              }
                         });
                    },

                    contentImagePopup: function(data) {
                         var urldetail = '<?= Yii::$app->homeUrl ?>app/place/' + (data.id_type_of_place == 0 ? 'hotel-detail' : (data.id_type_of_place == 1 ? 'food-detail' : 'visit-location-detail')) + '?slug=' + data.slug;
                         var html = '<div class="d-flex flex-column align-items-center">'
                         html += '<a href="' + urldetail + '"><h5 class="mb-0 font-weight-bold">' + data.name + '</h5></a>';
                         html += '<p class="text-muted mt-1 mb-2">' + data.address + '</p>';
                         html += '<a href="' + urldetail + '"><img src="' + data.path + '" style="width: 270px; height: 170px; object-fit:cover"></a>';
                         html += '</div>'
                         return html;
                    }
               }
          })
     })
</script>