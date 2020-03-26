<style>
  .plan-trip-detail .banner-section .banner-img {
    position: relative;
    background-image: url("../../resources/images/plan-detail-banner.jpg");
  }

  .plan-trip-detail .plan-view__sidebar .nav-link.active {
    background-color: unset;
  }

  .plan-trip-detail .plan-view__sidebar .nav-link.active .day-title {
    color: #4ca1af;
  }

  .plan-trip-detail .plan-view__sidebar .nav-link.active .cloudshadow,
  .plan-trip-detail .plan-view__sidebar .nav-link.active .cloudshadow:after,
  .plan-trip-detail .plan-view__sidebar .nav-link.active .cloudshadow:before {
    -webkit-box-shadow: 4px 7px 16px -3px #4ca1af;
    box-shadow: 4px 7px 16px -3px #4ca1af;
  }

  .plan-trip-detail .plan-view__sidebar .day-title {
    text-align: center;
    z-index: 100;
    position: absolute;
    top: 35px;
    left: 0;
    right: 0;
    font-weight: 600;
  }

  .plan-trip-detail .plan-view__sidebar .cloud,
  .plan-trip-detail .plan-view__sidebar .cloudshadow {
    width: 120px;
    height: 50px;
    background: #fff;
    border-radius: 100px;
    position: relative;
    margin: 20px 0;
  }

  .plan-trip-detail .plan-view__sidebar .cloud:after,
  .plan-trip-detail .plan-view__sidebar .cloud:before,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:after,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:before {
    content: '';
    position: absolute;
    background: #fff;
    z-index: 1;
  }

  .plan-trip-detail .plan-view__sidebar .cloudshadow,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:after,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:before {
    margin: 0;
    -webkit-box-shadow: 4px 7px 16px 5px rgba(0, 0, 0, 0.09);
    box-shadow: 4px 7px 16px 5px rgba(0, 0, 0, 0.09);
    z-index: -99;
  }

  .plan-trip-detail .plan-view__sidebar .cloud:after,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:after {
    width: 60px;
    height: 60px;
    top: -26px;
    left: 47px;
    border-radius: 50px;
  }

  .plan-trip-detail .plan-view__sidebar .cloud:before,
  .plan-trip-detail .plan-view__sidebar .cloudshadow:before {
    width: 40px;
    height: 40px;
    top: -17px;
    right: 65px;
    border-radius: 200px;
  }

  .plan-trip-detail .plan-view__content {
    width: 100%;
    height: 100%;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap {
    overflow-x: auto;
    position: relative;
    height: 600px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item {
    position: relative;
    padding: 12px 25px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item:last-child .line-connect {
    height: -webkit-calc(28px + 8px);
    height: calc(28px + 8px);
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .time-moving {
    background-color: #fff;
    color: #80868b;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .time-moving a {
    font-size: 12px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .time-moving a .time-moving-text {
    padding: 0 10px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .line-connect {
    height: 100%;
    top: 0;
    background-color: rgba(0, 0, 0, 0.12);
    left: 10px;
    position: absolute;
    width: 2px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .line-connect:first-of-type {
    height: -webkit-calc(100% - 12px);
    height: calc(100% - 12px);
    top: 12px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .line-connect:last-child {
    height: -webkit-calc(28px + 8px);
    height: calc(28px + 8px);
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .content-view .title-name {
    font-size: 18px;
    font-weight: 600;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .content-view .content-detail {
    font-size: 12px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .content-view .content-detail .text-detail {
    -webkit-box-flex: 1;
    -webkit-flex: 1 0 0px;
    -ms-flex: 1 0 0px;
    flex: 1 0 0px;
  }

.day-item img {
  width: 60px;
}
  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .content-view .content-detail img {
    border-radius: 8px;
    margin-left: 15px;
    width: 100px;
    height: 100px;
  }

  .plan-trip-detail .plan-view__content .day-view-wrap .day-plan-list__item .step {
    background-color: #4ca1af;
    border: 2px solid #4ca1af;
    border-radius: 26px;
    color: #fff;
    display: block;
    font-size: 12px;
    height: 20px;
    left: 0;
    line-height: 18px;
    position: absolute;
    text-align: center;
    width: 20px;
  }

  .image-object-on-map {
    border: 3px solid #2196f3;
    object-fit: cover;
    position: relative;
  }

  .image-object-on-map:before {
    content: ' ';
    display: block;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translate(-50%, 3px);
    width: 0;
    height: 0;
    border: 5px solid transparent;
    border-top-color: #2196f3;
  }

  .image-object-on-map img {
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

  .count-cluster {
    position: absolute;
    top: 0;
    right: 0;
    padding: 1px 5px;
    background: #000;
    color: #fff;
    border-radius: 5px;
    transform: translate(70%, -70%);
    font-size: .7rem;
  }
</style>

<script>
  function convertMinuteToTime(minute, type) {
    var hour = Math.floor(minute / 60);
    var min = Math.floor(minute % 60);
    var time = '';
    if (type === 'range') {
      if (hour !== 0) {
        time += hour + 'h';
      }
      if (min !== 0) {
        time += min + "'";
      }
    }
    if (type === 'oclock') {
      hour = hour >= 24 ? hour % 24 : hour;
      hour = hour < 10 ? '0' + hour : hour;
      min = min < 10 ? '0' + min : min;
      time += hour + ':' + min;
    }
    return time;
  }
</script>