<?php

use app\modules\api\APIConfig;
use app\modules\app\APPConfig;
use app\modules\app\services\PlaceService;
use app\modules\app\services\PlanService;
use app\modules\contrib\gxassets\GxVueDraggableAsset;

GxVueDraggableAsset::register($this);

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
                    <div class="trip-list__item" v-for="(tripItem, didx) in trip">
                         <div class="day-of-trip"><span>Ngày {{ didx + 1 }}</span></div>
                         <div class="trip-wrap position-relative">
                              <div class="overlay-loading-schedule position-absolute w-100 h-100 top-0 left-0 d-flex justify-content-center align-items-center" style="background:rgba(255,255,255,.9);z-index:100;" v-if="tripItem.calculating">
                                   <div class="loader1">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                   </div>
                              </div>
                              <ul class="step-list">
                                   <li class="first-step">
                                        <div class="step-timeline-started step-timeline-traveled-info d-flex">
                                             <div class="border"><i class="fa fa-home"> </i></div>
                                             <div class="grow-full-width"><span>Khởi hành</span>
                                                  <div class="date-started">{{ tripItem.date }}</div>
                                             </div>
                                        </div>
                                   </li>
                                   <draggable v-model="tripItem.details" @end="updateDistanceAndStartTimeOfDate(didx)">
                                        <transition-group>
                                             <li class="js-step" v-for="(place, pidx) in tripItem.details" :key="place.id_place + place.time_start">
                                                  <div class="step-list-step">
                                                       <div class="card-item d-flex">
                                                            <div class="card-image mr-3" style="width: 40%"><img :src="place.path"></div>
                                                            <div class="place-text">
                                                                 <a :href="'<?= APPConfig::getUrl('place/detail?slug=') ?>' + place.slug"></a>
                                                                 <h3 class="text-16 font-weight-bold">{{ place.place_name }}</h3></a>
                                                                 <div class="d-flex align-items-center"><i class="fa fa-clock-o"></i>
                                                                      <span class="text-12 px-2">Khởi hành: </span>
                                                                      <span class="text-primary-700 font-weight-bold cursor-pointer" 
                                                                           @click="openEditingBox($event, didx, pidx, place, 'time_start')">{{ startTimeFormat(place.time_start) }}</span>
                                                                 </div>
                                                                 <div class="d-flex align-items-center"><i class="fa fa-clock-o"></i>
                                                                      <span class="text-12 px-2">Lưu trú: </span>
                                                                      <span class="text-primary-700 font-weight-bold cursor-pointer" 
                                                                           @click="openEditingBox($event, didx, pidx, place, 'time_stay')">{{ rangeTimeFormat(place.time_stay) }}</span>
                                                                 </div>
                                                                 <?php include('_plan_popup_box.php') ?>
                                                                 <button class="delete-btn" @click="getRecentPlaces(didx, place.lat, place.lng)"><i class="fa fa-search-location mr-2"></i><span>Quanh đây</span></button>
                                                                 <button class="delete-btn" @click="removePlaceFromTrip(didx, pidx)"><span>Xóa</span></button>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="free-time" style="padding: 0 10px" v-if="place.free_time > 0">
                                                       <div class="d-flex flex-row justify-content-between align-items-center" style="padding: 15px 24px 0">
                                                            <h5 class="mb-0"><i class="fa fa-clock mr-1"></i> 
                                                                 <span>Thời gian rảnh: </span>
                                                                 <span class="text-primary border-bottom-1 border-bottom-dashed font-weight-bold cursor-pointer" 
                                                                      @click="openEditingBox($event, didx, pidx, place, 'free_time')">{{ rangeTimeFormat(place.free_time) }}</span>
                                                                 </h5>
                                                            <i class="icon-cross2 cursor-pointer ml-2" @click="removeFreeTimeOfPlace(didx, pidx)"></i>
                                                       </div>
                                                  </div>
                                                  <div class="transport-to-next-step" style="padding: 0 10px" v-if="pidx < tripItem.details.length - 1">
                                                       <div class="transfer-type" style="padding: 15px 24px 0">
                                                            <i :class="transferType[place.id_type_of_transport].icon" class="mr-2"></i>
                                                            <i class="fa fa-caret-down cursor-pointer" @click="openEditingBox($event, didx, pidx, place, 'transfer_type')"></i>
                                                            <span>{{ Math.floor(place.distance, 2) + 'km - ' + rangeTimeFormat(place.time_move) }}</span>
                                                       </div>
                                                  </div>
                                             </li>
                                        </transition-group>
                                    </draggable>
                                   <li class="step-list-past-future-separator">
                                        <div class="step-list-past-future-separator-content">
                                             <button class="add-step-empty-trip-button d-flex">
                                                  <div class="add-step-empty-trip-button-icon line-center"> <i class="fa fa-plus"></i></div>
                                                  <div class="add-step-empty-trip-button-text card" @click="showListPlace(didx)">Thêm địa điểm</div>
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
               <button class="submit-form-listing w-100" id="btn-submit" @click="savePlan">Lưu lịch trình</button>
          </div>

     </section>
     <section class="add-place-modal dailylist-modal" v-if="toggleListPlace">
          <div class="container">
               <div class="trip-panel-editor modal-card">
                    <div class="modal-close-button" @click="toggleListPlace = false"><i class="fa fa-times-circle"></i></div>
                    <h4 class="modal-title text-16">Thêm địa điểm </h4>
                    <div class="modal-content">
                         <div class="step-pick-location">
                              <form class="search-box d-flex">
                                   <div class="search-box__item" style="width: 40%">
                                        <input type="text" placeholder="Tìm kiếm" style="border-radius: 0" v-model="places.query.keyword">
                                   </div>
                                   <div class="search-box__item" style="width: 40%"><span class="ti-angle-down"></span>
                                        <select name="categories" v-model="places.query.type" style="border-radius: 0">
                                             <option v-for="(label, value) in placeTypes" :value="value">{{ label }}</option>
                                        </select>
                                   </div>

                                   <button class="search-btn" @click="searchPlaces">Tìm kiếm</button>
                              </form>
                              <div class="result-box my-3">
                                   <div class="result-box__item imagebox">
                                        <div class="box-imagebox d-flex" v-for="place in places.data">
                                             <div class="box-header">
                                                  <div class="box-image"><img :src="place.path"></div>
                                             </div>
                                             <div class="box-content">
                                                  <div class="box-title"> <a :href="'<?= APPConfig::getUrl('place/detail?slug=') ?>' + place.slug">{{ place.name }}</a><i class="fa fa-check-circle"></i></div>
                                                  <div class="queue"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
                                                  <div class="address">
                                                       <p>{{ place.address }}</p>
                                                  </div>
                                                  <div class="btn-more button-pick-location" @click="addPlaceToTrip(place, dayIndex)"><a href="javascript:void(0)">Thêm vào lịch trình</a></div>
                                             </div>
                                        </div>
                                        <nav aria-label="Page navigation example">
                                             <ul class="pagination" v-if="places.paginations.pages > 1">
                                                  <li class="page-item" v-for="p, i in places.paginations.links" :class="p == 'current' ? 'active' : '' ">
                                                       <a href="#" class="page-link" @click="changePage(p)">
                                                            {{ i == 0 ? '← &nbsp; Đầu tiên' : (i == places.paginations.links.length - 1 ? 'Cuối cùng &nbsp; →' : (p == 'current' ? places.paginations.current : p)) }}
                                                       </a>
                                                  </li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div>
                         </div>
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
                              keyword: null,
                              page: 1,
                              pointcenter: {
                                   lat: null,
                                   lng: null
                              }
                         }
                    },
                    dayIndex: null,
                    placeTypes: placeTypes,
                    openStayTimeBox: false,
                    openStartTimeBox: false,
                    openTransferTypeBox: false,
                    openFreeTimeBox: false,
                    openNoteBox: false,
                    dataOfPlaceEditing: {
                         didx: null,
                         pidx: null,
                         note: null,
                         time_start: null,
                         time_stay: null,
                         time_move: null,
                         free_time: null,
                         distance: null
                    },
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
               computed: {
                    date_start: function() {
                         var date = new Date(this.plan.date_start);
                         return formatDate(date);
                    },

                    date_end: function() {
                         var date = new Date(this.plan.date_end);
                         return formatDate(date);
                    },

                    time_start_format: function() {
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
                    showListPlace: function(didx) {
                         this.dayIndex = didx;
                         this.toggleListPlace = true;
                    },

                    getRecentPlaces: function(didx, lat, lng) {
                         this.places.query.pointcenter.lat = lat
                         this.places.query.pointcenter.lng = lng
                         this.places.query.page = 1
                         this.places.query.keyword = ''

                         this.getVisitLocations(this.places.query.type, this.places.query.page, this.places.query.keyword, this.places.query.pointcenter)
                         this.showListPlace(didx)
                    },

                    plusDays: function(dateStr, days) {
                         var date = new Date(dateStr);
                         date.setDate(date.getDate() + days);
                         return formatDate(date);
                    },

                    rangeTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'range');
                    },

                    startTimeFormat: function(minute) {
                         return convertMinuteToTime(minute, 'oclock');
                    },

                    showOverlayProcessSchedule: function(didx) {
                         this.trip[didx].calculating = true;
                    },

                    hideOverlayProcessSchedule: function(didx) {
                         var _this = this;
                         _this.$nextTick(function() {
                              _this.trip[didx].calculating = false;
                         })
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
                                   if (resp.status) {
                                        _this.places.data = resp.places.data
                                        _this.places.paginations = resp.places.paginations
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
                         if (typeof page == 'number') {
                              var _this = this
                              _this.places.query.page = page
                              _this.getVisitLocations(_this.places.query.type, _this.places.query.page, _this.places.query.keyword, _this.places.query.pointcenter)
                         }
                    },

                    searchPlaces: function(e) {
                         e.preventDefault()
                         var _this = this
                         _this.places.query.page = 1
                         _this.getVisitLocations(_this.places.query.type, _this.places.query.page, _this.places.query.keyword, _this.places.query.pointcenter)
                    },

                    initTripData: function() {
                         for (var i = 0; i < this.plan.total_day; i++) {
                              this.trip.push({
                                   date: this.plusDays(this.plan.date_start, i),
                                   time_start: 480,
                                   calculating: false,
                                   details: []
                              });
                         }
                    },

                    addPlaceToTrip: function(place, didx) {
                         var _this = this;
                         var duplicate = false
                         _this.trip[didx].details.forEach(p => {
                              if(p.slug == place.slug) {
                                   duplicate = true
                                   toastMessage('error', 'Địa điểm đã có trong lịch trình')
                              }
                         })
                         
                         if(!duplicate) {
                              _this.calDistanceBetweenLastPlaceInTripWithNewPlace(place, didx);
                              _this.toggleListPlace = false;
                         }
                    },

                    calDistanceBetweenLastPlaceInTripWithNewPlace: function(place, didx) {
                         var _this = this;
                         var coordsStr = '';
                         var listPlaceOfDay = _this.trip[didx].details;
                         var newPlace = _this.normalizePlaceData(place);

                         if (listPlaceOfDay.length >= 1) {
                              _this.showOverlayProcessSchedule(didx)
                              var lastPlace = _this.trip[didx].details[listPlaceOfDay.length - 1];
                              _this.getRoutesAndDistancesBetweenLocations(lastPlace, newPlace, _this.transferType[0].type, function(summary) {
                                   if (summary == false) {
                                        toastMessage('error', 'Có lỗi sảy ra, vui lòng thử lại');
                                   } else {
                                        lastPlace.distance = summary.distance / 1000;
                                        lastPlace.time_move = summary.travelTime / 60;
                                        newPlace.time_start = _this.getTotalTimeFormFristPlace(didx, listPlaceOfDay.length - 1);
                                        _this.trip[didx].details.push(newPlace);
                                   }

                                   _this.hideOverlayProcessSchedule(didx)
                              })
                         } else {
                              _this.trip[didx].time_start = 480; //480' = 08:am
                              newPlace.time_start = 480; //480' = 08:am
                              _this.trip[didx].details.push(newPlace);
                         }
                    },


                    //transporttype: car | pedestrian
                    getRoutesAndDistancesBetweenLocations: function(waypoint0, waypoint1, transporttype, callback) {
                         var urlApiGetDistances = 'https://route.ls.hereapi.com/routing/7.2/calculateroute.json?apiKey=<?= PlanService::$HERE_KEY ?>' + '&waypoint0=geo!' + waypoint0.lat + ',' + waypoint0.lng + '&waypoint1=geo!' + waypoint1.lat + ',' + waypoint1.lng + '&routeattributes=sm&mode=fastest;' + transporttype;
                         return $.ajax({
                              url: urlApiGetDistances,
                              success: function(data) {
                                   if (data.response.route) {
                                        callback(data.response.route[0].summary);
                                   } else {
                                        callback(false);
                                   }
                              },
                              error: function(msg) {
                                   callback(false);
                              }
                         });
                    },

                    getTotalTimeFormFristPlace(didx, pidx) {
                         var _this = this;
                         var totalTime = 0;
                         var place = _this.trip[didx].details[pidx];
                         totalTime += parseInt(place.time_start) + parseInt(place.time_stay) + parseInt(place.time_move) + parseInt(place.free_time);
                         return totalTime;
                    },

                    normalizePlaceData: function(place) {
                         var placeData = {
                              place_name: place.name,
                              time_start: 480,
                              time_stay: 60,
                              time_move: 0,
                              free_time: 0,
                              id_place: place.id,
                              lat: place.lat,
                              lng: place.lng,
                              path: place.path,
                              date_index: this.dayIndex,
                              note: '',
                              id_type_of_transport: 0,
                              distance: 0,
                              slug: place.slug
                         }

                         return placeData;
                    },

                    removePlaceFromTrip: function(didx, pidx) {
                         var _this = this;
                         _this.trip[didx].details.splice(pidx, 1);
                         if(pidx != _this.trip[didx].details.length - 1) {
                              _this.updateDistanceAndStartTimeOfDate(didx);
                         }
                    },

                    openEditingBox: function(e, didx, pidx, place, box_type) {
                         var _this = this;
                         // Get position of element is clicked
                         var offset = $(e.target).offset();
                         //Reset value for dataOfPlaceEditing
                         if (didx !== _this.dataOfPlaceEditing.didx || pidx !== _this.dataOfPlaceEditing.pidx) {
                              _this.dataOfPlaceEditing = {
                                   didx: didx,
                                   pidx: pidx,
                                   note: place.note,
                                   time_start: place.time_start,
                                   time_stay: place.time_stay,
                                   free_time: place.free_time,
                                   distance: place.distance
                              };
                         }
                         //Check type of element is clicked and open box of this type
                         switch (box_type) {
                              case 'transfer_type':
                                   _this.openTransferTypeBox = true;
                                   break;
                              case 'time_stay':
                                   _this.openStayTimeBox = true;
                                   break;
                              case 'time_start':
                                   _this.openStartTimeBox = true;
                                   break;
                              case 'free_time':
                                   _this.openFreeTimeBox = true;
                                   break;
                              case 'note':
                                   _this.openNoteBox = true;
                                   break;
                         }

                         //Set position for box is opened
                         _this.$nextTick(function() {
                              var ofssetTop = offset.top + 25;
                              var ofssetLeft = offset.left - 10;
                              $('.place-editing-box').css('opacity', 1);
                              $('.place-editing-box').css('top', ofssetTop);
                              $('.place-editing-box').css('left', ofssetLeft);
                         })
                    },

                    updateStartTimeFromIdxToIdx: function(didx, fromidx, toidx, totaltime) {
                         var _this = this;
                         var total_time = totaltime;
                         for (var i = fromidx; i <= toidx; i++) {
                              _this.trip[didx].details[i].time_start = total_time;
                              var place = _this.trip[didx].details[i];
                              total_time += parseInt(place.time_stay) + parseInt(place.free_time) + parseInt(place.time_move);
                         }
                         //update start time of date
                         if (fromidx == 0) {
                              _this.trip[didx].time_start = _this.trip[didx].details[0].time_start;
                         }
                    },

                    chooseTransferType: function(transfer_type) {
                         var _this = this;
                         var didx = _this.dataOfPlaceEditing.didx;
                         var pidx = _this.dataOfPlaceEditing.pidx;
                         _this.trip[didx].details[pidx].id_type_of_transport = transfer_type;

                         //get distance and time move with new transfer type
                         _this.showOverlayProcessSchedule(didx)
                         var currentPlace = _this.trip[didx].details[pidx];
                         var nextPlace = _this.trip[didx].details[pidx + 1];
                         _this.getRoutesAndDistancesBetweenLocations(currentPlace, nextPlace, _this.transferType[transfer_type].type, function(summary) {
                              if (summary == false) {
                                   toastMessage('error', 'Có lỗi sảy ra, vui lòng thử lại');
                              } else {
                                   currentPlace.distance = summary.distance / 1000;
                                   currentPlace.time_move = summary.travelTime / 60;
                                   // nextPlace.time_start = _this.getTotalTimeFormFristPlace(didx, listPlaceOfDay.length - 1);
                              }
                              _this.hideOverlayProcessSchedule(didx)
                         })

                         //close popup and re-calculating start time of places after this
                         _this.openTransferTypeBox = false;
                         if (!_this.isLastPlaceInDate(didx, pidx)) {
                              var totaltime = _this.getTotalTimeFormFristPlace(didx, pidx);
                              _this.updateStartTimeFromIdxToIdx(didx, pidx + 1, _this.trip[didx].details.length - 1, totaltime);
                         }
                    },

                    savePlaceNote: function() {
                         var _this = this;
                         _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].note = _this.dataOfPlaceEditing.note;
                         _this.openNoteBox = false;
                    },

                    saveStayTime: function() {
                         var _this = this;
                         var hour = $('input#stay-time-hour').val();
                         var minute = $('input#stay-time-minute').val();
                         var old_stay_time = _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].time_stay;
                         var new_stay_time = convertTimeToMinute(hour, minute);
                         if (old_stay_time != new_stay_time) {
                              _this.dataOfPlaceEditing.time_stay = new_stay_time;
                              _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].time_stay = new_stay_time;
                              _this.updateTripAfterChangeStayOrFreeTimeOfPlace(_this.dataOfPlaceEditing.didx, _this.dataOfPlaceEditing.pidx);
                         }
                         _this.openStayTimeBox = false;
                    },

                    saveFreeTime: function() {
                         var _this = this;
                         var hour = $('input#free-time-hour').val();
                         var minute = $('input#free-time-minute').val();
                         var old_free_time = _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].free_time;
                         var new_free_time = convertTimeToMinute(hour, minute);
                         if (old_free_time != new_free_time) {
                              _this.dataOfPlaceEditing.free_time = new_free_time;
                              _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].free_time = new_free_time;
                              _this.updateTripAfterChangeStayOrFreeTimeOfPlace(_this.dataOfPlaceEditing.didx, _this.dataOfPlaceEditing.pidx);
                         }
                         _this.openFreeTimeBox = false;
                    },

                    updateTripAfterChangeStayOrFreeTimeOfPlace: function(didx, pidx) {
                         var _this = this;
                         var totaltime = _this.getTotalTimeFormFristPlace(didx, pidx);
                         if (!_this.isLastPlaceInDate(didx, pidx)) {
                              _this.updateStartTimeFromIdxToIdx(didx, pidx + 1, _this.trip[didx].details.length - 1, totaltime);
                         }
                    },

                    saveStartTime: function() {
                         var _this = this;
                         var hour = $('input#start-time-hour').val();
                         var minute = $('input#start-time-minute').val();
                         var old_start_time = _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].time_start;
                         var new_start_time = convertTimeToMinute(hour, minute);
                         if (old_start_time != new_start_time) {
                              _this.dataOfPlaceEditing.time_start = new_start_time;
                              _this.trip[_this.dataOfPlaceEditing.didx].details[_this.dataOfPlaceEditing.pidx].time_start = new_start_time;
                              _this.updateTripAfterChangeStartTimeOfPlace(_this.dataOfPlaceEditing.didx, _this.dataOfPlaceEditing.pidx, old_start_time, new_start_time);
                         }
                         _this.openStartTimeBox = false;
                    },

                    updateTripAfterChangeStartTimeOfPlace: function(didx, pidx, old_start_time, new_start_time) {
                         var _this = this;
                         if (!_this.isFirstPlaceInDate(didx, pidx)) {
                              if (new_start_time > old_start_time) {
                                   _this.trip[didx].details[pidx - 1].free_time = new_start_time - old_start_time;
                              }
                              if (new_start_time < old_start_time) {
                                   var totaltime = _this.trip[didx].details[0].time_start - (old_start_time - new_start_time);
                                   _this.updateStartTimeFromIdxToIdx(didx, 0, pidx - 1, totaltime);
                              }
                         }

                         if (!_this.isLastPlaceInDate(didx, pidx)) {
                              var totaltime = _this.getTotalTimeFormFristPlace(didx, pidx);
                              _this.updateStartTimeFromIdxToIdx(didx, pidx + 1, _this.trip[didx].details.length - 1, totaltime);
                         }
                    },

                    updateDistanceAndStartTimeOfDate: function(didx) {
                         var _this = this;
                         var coords = [];
                         if (_this.trip[didx].details.length == 0) {
                              return;
                         } else if (_this.trip[didx].details.length == 1) {
                              _this.trip[didx].details[0].time_start = _this.trip[didx].time_start;
                         } else if (_this.trip[didx].details.length > 1) {
                              _this.showOverlayProcessSchedule(didx)
                              var promise = $.when();
                              _this.trip[didx].details.forEach((place, index) => {
                                   if(index < _this.trip[didx].details.length - 1) {
                                        promise = promise.then(function() { 
                                             var prePlace = _this.trip[didx].details[index]
                                             var nextPlace = _this.trip[didx].details[index + 1]
                                             
                                             return _this.getRoutesAndDistancesBetweenLocations(prePlace, nextPlace, _this.transferType[prePlace.id_type_of_transport].type, function(summary) {
                                                  if (summary == false) {
                                                       toastMessage('error', 'Có lỗi sảy ra, vui lòng thử lại');
                                                  } else {
                                                       prePlace.distance = summary.distance / 1000;
                                                       prePlace.time_move = summary.travelTime / 60;

                                                       if(index == 0) {
                                                            prePlace.time_start = _this.trip[didx].time_start
                                                       }

                                                       let totalTime = _this.getTotalTimeFormFristPlace(didx, index);
                                                       _this.updateStartTimeFromIdxToIdx(didx, index + 1, _this.trip[didx].details.length - 1, totalTime)
                                                  }
                                             })
                                        });
                                   }
                                   
                              });

                              _this.hideOverlayProcessSchedule(didx)
                         }
                    },

                    removeFreeTimeOfPlace: function(didx, pidx) {
                         var _this = this;
                         _this.trip[didx].details[pidx].free_time = 0;
                         if (!_this.isLastPlaceInDate(didx, pidx)) {
                              var totaltime = _this.getTotalTimeFormFristPlace(didx, pidx);
                              _this.updateStartTimeFromIdxToIdx(didx, pidx + 1, _this.trip[didx].details.length - 1, totaltime);
                         }
                    },

                    isFirstPlaceInDate: function(didx, pidx) {
                         return pidx === 0 ? true : false;
                    },

                    isLastPlaceInDate: function(didx, pidx) {
                         var count_place_in_date = this.trip[didx].details.length;
                         return pidx === count_place_in_date - 1 ? true : false;
                    },

                    savePlan: function() {
                         var _this = this;
                         $.ajax({
                              data: {
                                   trip: _this.trip
                              },
                              type: 'POST',
                              success: function(resp) {
                                   console.log(resp)
                              },
                              error: function(msg) {
                                   console.log(msg)
                              }
                         })
                    }
               }
          })
     })
</script>