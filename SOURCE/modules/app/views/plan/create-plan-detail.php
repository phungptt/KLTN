<?php

use app\modules\api\APIConfig;
use app\modules\app\APPConfig;
use app\modules\app\services\PlaceService;

include('create-plan-detail_css.php')
?>
<div class="create-plan-detail" id="create-plan-detail-page">
     <section class="banner-section">
          <div class="banner-img"></div>
          <div class="text-box" v-cloak>
               <div class="title"> <span class="destination">{{ plan.name }}</span></div>
               <div class="planning-days d-flex"><i class="fa fa-calendar"></i><span>{{ (date_start == date_end) ? date_start : date_start + ' - ' + date_end }}</span></div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="trip-panel-detail my-5">
          <div class="container">
               <div class="trip-list">
                    <div class="trip-list__item" v-for="(tripItem, index) in trip">
                         <div class="day-of-trip"><span>Ngày {{ index + 1 }}</span></div>
                         <div class="trip-wrap">
                              <ul class="step-list">
                                   <li class="first-step">
                                        <div class="step-timeline-started step-timeline-traveled-info d-flex">
                                             <div class="border"><i class="fa fa-home"> </i></div>
                                             <div class="grow-full-width"><span>Khởi hành</span>
                                                  <div class="date-started">{{ tripItem.date }}</div>
                                             </div>
                                        </div>
                                   </li>
                                   <li class="js-step">
                                        <div class="step-list-step" v-for="(place, idx) in tripItem.details">
                                             <div class="card-item d-flex">
                                                  <div class="card-image mr-3"><img :src="place.path"></div>
                                                  <div class="place-text">
                                                       <h3 class="text-16">{{ place.place_name }}</h3>
                                                       <div class="d-flex align-items-center"><i class="fa fa-clock-o"></i><span class="text-12 px-2">{{ place.time_start }}</span></div>
                                                       <div class="d-flex align-items-center"><i class="fa fa-clock-o"></i><span class="text-12 px-2">{{ place.time_stay }}</span></div>
                                                       <button class="delete-btn"><span>Xóa</span></button>
                                                  </div>
                                             </div>
                                        </div>
                                   </li>
                                   <li class="step-list-past-future-separator">
                                        <div class="step-list-past-future-separator-content">
                                             <button class="add-step-empty-trip-button d-flex">
                                                  <div class="add-step-empty-trip-button-icon line-center"> <i class="fa fa-plus"></i></div>
                                                  <div class="add-step-empty-trip-button-text card" @click="showListPlace(index)">Thêm địa điểm</div>
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
     <section class="add-place-modal dailylist-modal" v-if="toggleListPlace">
          <div class="container">
               <div class="trip-panel-editor modal-card">
                    <div class="modal-close-button" @click="toggleListPlace = false"><i class="fa fa-times-circle"></i></div>
                    <h4 class="modal-title text-16">Thêm địa điểm </h4>
                    <div class="modal-content">
                         <form class="step-pick-location">
                              <div class="search-box d-flex">
                                   <div class="search-box__item">
                                        <input type="text" placeholder="Tìm kiếm" name="search">
                                   </div>
                                   <div class="search-box__item"><span class="ti-angle-down"></span>
                                        <select name="categories" v-model="type">
                                             <option v-for="(label, value) in placeTypes" :value="value">{{ label }}</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="result-box my-3">
                                   <div class="result-box__item imagebox">
                                        <div class="box-imagebox d-flex" v-for="place in places.data">
                                             <div class="box-header">
                                                  <div class="box-image"><img :src="place.path"></div>
                                             </div>
                                             <div class="box-content">
                                                  <div class="box-title"> <a :href="'<?= APPConfig::getUrl('place/detail?slug=')?>' + place.slug">{{ place.name }}</a><i class="fa fa-check-circle"></i></div>
                                                  <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                  <div class="address">
                                                       <p>{{ place.address }}</p>
                                                  </div>
                                                  <div class="button-header button-pick-location" @click="addPlaceToTrip(place)"><a href="javascript:void(0)">Thêm vào lịch trình</a></div>
                                             </div>
                                        </div>
                                        <nav aria-label="Page navigation example">
                                             <ul class="pagination" v-if="places.paginations.pages > 1">
                                                  <li class="page-item" v-for="p, i in places.paginations.links" :class="p == 'current' ? 'active' : '' ">
                                                       <a href="#" class="page-link" @click="changePage(p)">
                                                            {{ i == 0 ? '← &nbsp; Đầu tiên' : (i == paginations.links.length - 1 ? 'Cuối cùng &nbsp; →' : (p == 'current' ? paginations.current : p)) }}
                                                       </a>
                                                  </li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section>
</div>

<script>
     $(function() {
          var plan = JSON.parse('<?= json_encode($plan, true) ?>');
          var placeTypes = JSON.parse('<?= json_encode(PlaceService::$placeTypes, true) ?>');
          var vm = new Vue({
               el: '#create-plan-detail-page',
               data: {
                    plan: plan,
                    trip: [],
                    toggleListPlace: false,
                    places: {
                         data: {},
                         paginations: {},
                         query: {
                              type: '<?= PlaceService::$VISIT_TYPE ?>',
                              keyword: '',
                              page: 1,
                              pointcenter: {
                                   lat: null,
                                   lng: null
                              }
                         }
                         
                    },
                    currentDay: null,
                    placeTypes: placeTypes
               },
               computed: {
                    date_start: function() {
                         var date = new Date(this.plan.date_start);
                         return this.formatDate(date);
                    },

                    date_end: function() {
                         var date = new Date(this.plan.date_end);
                         return this.formatDate(date);
                    }
                    
               },
               created: function() {
                    var _this = this;
                    _this.$nextTick(function() {
                         _this.initTripData();
                         _this.getVisitLocations(_this.places.query.type, _this.places.query.page, _this.places.query.keyword, _this.places.query.pointcenter)
                    })
               },
               methods: {
                    showListPlace: function(index) {
                         this.currentDay = index;
                         this.toggleListPlace = true;
                    },

                    plusDays: function(dateStr, days) {
                         var date = new Date(dateStr);
                         date.setDate(date.getDate() + days);
                         
                         return this.formatDate(date);
                    },

                    getVisitLocations: function(type, page, keyword, pointcenter) {
                         var _this = this;
                         var api = '<?= APIConfig::getUrl('place/get-place-list') ?>';
                         $.ajax({
                              url: api,
                              type: 'POST',
                              data: {
                                   destination: _this.plan.id_destination,
                                   type: type,
                                   page: page,
                                   keyword: keyword,
                                   lat: pointcenter.lat,
                                   lng: pointcenter.lng
                              },
                              success: function(resp) {
                                   if(resp.status) {
                                        _this.places = resp.places
                                   } else {
                                        toastMessage('error', resp.message)
                                   }
                              },
                              error: function(msg) {
                                   toastMessage('error', msg)
                              }
                         })
                    },

                    changePage: function(page) {
                         console.log(1);
                    },

                    addPlaceToTrip: function(place) {
                         console.log(place)
                         this.toggleListPlace = false;
                    },

                    initTripData: function() {
                         for(var i = 0; i < this.plan.total_day; i++) {
                              this.trip.push({
                                   date: this.plusDays(this.plan.date_start, i),
                                   details: []
                              });
                         }
                    },

                    addPlaceToTrip: function(place) {

                    },

                    formatDate: function(date) {
                         let dd = date.getDate();
                         let mm = date.getMonth() + 1;
                         let yyyy = date.getFullYear();

                         dd = dd < 10 ? '0' + dd : dd;
                         mm = mm < 10 ? '0' + mm : mm;
                         return dd + '/' + mm + '/' + yyyy;
                    }
               }
          })
     })
</script>