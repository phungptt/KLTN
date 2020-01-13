<?php
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
                         <div id="map" style="height: 550px"></div>
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
                    polyline: [

                    ],
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
                         // {
                         //      type: 'publicTransport',
                         //      label: 'Phương tiện công cộng',
                         //      icon: 'fa fa-bus'
                         // },
                    ]
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
               }
          })
     })
</script>