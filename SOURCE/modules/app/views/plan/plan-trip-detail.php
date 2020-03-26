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
          <div class="content">
               <div class="row">
                    <div class="col-2 plan-view__sidebar">
                         <a class="nav-link w-100" v-for="(item, index) in trip" :id="'day-' + index">
                              <div class="day-item line-center mb-3">
                                   <img src="<?= Yii::$app->homeUrl ?>resources/images/icon/calendar.png"/>
                                   <div :class="index == currentDate ? 'text-primary': ''" class="day-title cursor-pointer" @click="changeDate(index)"> {{ index + 1 }}</div>
                              </div>
                         </a>
                    </div>
                    <div class="col-md-4 col-sm-10 plan-view__content">
                         <div class="day-view-wrap">
                              <div class="day-plan-list">
                                   <div class="day-plan-list__item" v-for="(place, pidx) in trip[currentDate].details">
                                        <div class="time-moving d-flex" v-if="pidx > 0">
                                             <a href="#">
                                                  <i :class="transferType[trip[currentDate].details[pidx - 1].id_type_of_transport].icon"> </i>
                                                  <span class="time-moving-text font-weight-bold">Di chuyển: {{ Math.floor(trip[currentDate].details[pidx - 1].distance, 2) + 'km - ' + rangeTimeFormat(trip[currentDate].details[pidx - 1].time_move) }}</span>
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
                    <div class="col-md-6 col-sm-12 plan-view__map mt-sm-4">
                         <div id='gxmap_create_map' style="height: 600px"></div>
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
                    ],
                    map: null,
                    layers: {
                         base: {},
                         overlay: {},
                         trip: {}
                    },
                    controls: {},
                    thisBaseLayer: [
                         {
                              domain: 'http://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
                              minZoom: 0,
                              maxZoom: 22,
                              attribution: 'Google Maps'
                         }, {
                              domain: 'http://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
                              minZoom: 0,
                              maxZoom: 22,
                              attribution: 'Google Satellite'
                         }, {
                              domain: 'http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',
                              minZoom: 0,
                              maxZoom: 22,
                              attribution: 'Google Satellite Hybrid'
                         }, {
                              domain: 'http://server.arcgisonline.com/arcgis/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
                              subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                              minZoom: 0,
                              maxZoom: 22,
                              attribution: 'Esri Street'
                         }
                    ],
                    currentDate: 0
               }, 

               mounted: function() {
                    this.initMap()
               },

               methods: {
                    rangeTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'range');
                    },

                    startTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'oclock');
                    },

                    changeDate: function(dateindex) {
                         var _this = this;
                         _this.currentDate = dateindex;

                         //add layer off currentDate
                         for(let key in _this.layers.trip) {
                              let layer = _this.layers.trip[key];
                              if(key == ('date_' + dateindex)) {
                                   if(!_this.map.hasLayer(layer)) {
                                        _this.map.addLayer(layer)
                                   }

                                   _this.map.fitBounds(layer.getBounds(), {
                                        padding: [50, 50]
                                   });
                              } else {
                                   if(_this.map.hasLayer(layer)) {
                                        _this.map.removeLayer(layer)
                                   }
                              }
                         }
                    },

                    initMap: function(){
                         this.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 13);
                         this.initControl();
                         this.initTripLayer()
                    },

                    initControl: function() {
                         var _this = this;
                         _this.thisBaseLayer.forEach(function(el, idx) {
                              _this.layers.base[el.attribution] = L.tileLayer.wms(el.domain, el);
                              if (idx === 0) {
                                   _this.map.addLayer(_this.layers.base[el.attribution]);
                              };
                         })
                         _this.controls.controllayer = L.control.layers(_this.layers.base);
                         _this.controls.controllayer.addTo(_this.map);
                    },
                    
                    initTripLayer: function() {
                         var _this = this;
                         _this.trip.forEach((tripItem, didx) => {
                              // let arrLayerGroup = [];
                              _this.layers.trip['date_' + didx] = L.featureGroup().addTo(this.map);
                              tripItem.details.forEach((place, index) => {
                                   //init icon place
                                   let placeIcon = '<img src="' + place.path + '" id="image-object-on-map-' + place.slug + '"><span class="count-cluster">' + (index + 1) + '</span>';
                                   let divIcon = L.divIcon({
                                        html: placeIcon,
                                        className: 'image-object-on-map position-relative',
                                        iconSize: [48, 48],
                                        iconAnchor: [24, 53],
                                        popupAnchor: [0, -44]
                                   });
                                   let placeMarker = L.marker([place.lat, place.lng], {icon: divIcon}).bindPopup(_this.contentImagePopup(place)).addTo(this.map);
                                   _this.layers.trip['date_' + didx].addLayer(placeMarker)

                                   // getLineString
                                   if(index < tripItem.details.length - 1) {
                                        var prePlace = tripItem.details[index]
                                        var nextPlace = tripItem.details[index + 1]
                                        _this.getRoutesAndDistancesBetweenLocations(prePlace, nextPlace, _this.transferType[prePlace.id_type_of_transport].type, function(shape) {
                                             let latlngs = []
                                             shape.forEach(latlng => {
                                                  let arr = latlng.split(',')
                                                  latlngs.push([arr[0], arr[1]])
                                             })

                                             let routeLine = L.polyline(latlngs, {color: 'blue'})
                                             _this.layers.trip['date_' + didx].addLayer(routeLine)
                                        })
                                   }
                              });
                              _this.layers.trip['date_' + didx].addTo(this.map)
                         })

                         //
                         _this.changeDate(0)
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

                    contentImagePopup: function(place) {
                         console.log(place)
                         var urldetail = '<?= Yii::$app->homeUrl ?>app/place/' + (place.id_type_of_place == 0 ? 'hotel-detail' : (place.id_type_of_place == 1 ? 'food-detail' : 'visit-location-detail')) + '?slug=' + place.slug;
                         var html = '<div class="d-flex flex-column align-items-center">'
                         html += '<a href="' + urldetail + '"><h5 class="mb-0 font-weight-bold">' + place.place_name + '</h5></a>';
                         html += '<p class="text-muted mt-1 mb-2">Bắt đầu: ' + this.startTimeFormat(place.time_start) + ' | Lưu trú: ' + this.rangeTimeFormat(place.time_stay) + '</p>';
                         html += '<a href="' + urldetail + '"><img src="' + place.path + '" style="width: 270px; height: 170px; object-fit:cover"></a>';
                         html += '</div>'
                         return html;
                    }
               }
          })
     })
</script>