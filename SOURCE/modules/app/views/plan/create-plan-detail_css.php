<style>
     .create-plan-detail .banner-section .banner-img {
          background-image: url('<?= \Yii::$app->homeUrl ?>resources/images/plan-detail-banner.jpg');
     }

     .imagebox:hover .box-header .box-image:after {
          opacity: 0;
     }

     .btn-more {
          text-align: left;
     }

     .imagebox .box-imagebox {
          margin: 20px 0;
     }

     .create-plan-detail .trip-panel-detail {
          width: 100%;
     }

     .create-plan-detail .trip-panel-detail .trip-list {
          width: auto;
          white-space: nowrap;
          overflow-x: scroll;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item {
          width: 500px;
          display: inline-block;
          vertical-align: top;
          border: 1px solid #eee;
          margin: 15px;
          padding: 10px;
          border-radius: 15px;
          box-shadow: 0px 7px 16px 0px rgba(0, 0, 0, 0.09);
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .day-of-trip {
          margin: 10px;
          padding: 15px;
          border-radius: 15px;
          background-color: #4ca1af;
          color: #fff;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .day-of-trip span {
          font-size: 14px;
          font-weight: 600;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap {
          margin: 10px 0;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list li {
          padding: 0 15px;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended {
          position: relative;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started .border,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended .border {
          border: 1.5px solid #b7c0cd;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 20px;
          z-index: 6;
          position: relative;
          background-color: white;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started .grow-full-width,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended .grow-full-width {
          margin: 0 15px;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started .grow-full-width span,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended .grow-full-width span {
          font-size: 12px;
          font-weight: 600;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started .grow-full-width .date-started,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended .grow-full-width .date-started {
          color: #8a99ad;
          font-size: 10px;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-started::after,
     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended::after {
          left: 18px;
          top: 64px;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-traveled-info::after {
          position: absolute;
          content: '';
          display: block;
          top: 0;
          bottom: 0;
          border: 0;
          border-left: 2px solid #b7c0cd;
          width: 2px;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .js-step {
          position: relative;
          padding: 20px 0;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .js-step::after {
          position: absolute;
          content: '';
          display: block;
          top: 0;
          bottom: 0;
          border: 0;
          border-left: 2px solid #b7c0cd;
          width: 2px;
          left: 33px;
          z-index: -10;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .js-step .step-list-step {
          padding: 0 10px;
          z-index: 2;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .js-step .card-item {
          position: relative;
          background: white;
          padding: 24px;
          border-radius: 12px;
          border: 1px solid #e7eaee;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator {
          position: relative;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content {
          position: relative;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content .add-step-empty-trip-button {
          background: none;
          border: 0;
          position: relative;
          padding: 10px 0 25px;
          width: 100%;
          height: auto;
          text-align: left;
          overflow: hidden;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content .add-step-empty-trip-button::before {
          position: absolute;
          content: '';
          display: block;
          border-left: 2px solid #b7c0cd;
          top: 0;
          bottom: 50%;
          left: 18px;
          z-index: 1;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content .add-step-empty-trip-button::after {
          position: absolute;
          content: '';
          display: block;
          border-left: 2px dashed #b7c0cd;
          bottom: 0;
          top: 50%;
          left: 19px;
          z-index: 1;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content .add-step-empty-trip-button .add-step-empty-trip-button-icon {
          height: 48px;
          width: 48px;
          border-radius: 50%;
          margin-right: 20px;
          background-color: #ff796b;
          position: relative;
          z-index: 2;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-list-past-future-separator .step-list-past-future-separator-content .add-step-empty-trip-button .add-step-empty-trip-button-text {
          border-radius: 15px;
          padding: 0 10px;
          font-size: 12px;
          font-weight: 600;
          border: 1px solid transparent;
          box-shadow: 0px 0 12px 0px #ffd16b;
          color: #000;
     }

     .create-plan-detail .trip-panel-detail .trip-list__item .trip-wrap .step-list .step-timeline-ended {
          position: relative;
          display: flex;
          align-items: center;
     }

     .create-plan-detail .step-editor-location-info {
          opacity: 0;
          visibility: hidden;
          height: 0;
     }

     .create-plan-detail .step-editor-location-info.show {
          opacity: 1;
          visibility: visible;
          height: auto;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field {
          margin-bottom: 16px;
          font-size: 14px;
          line-height: 1.5;
          display: flex;
          align-items: flex-start;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__label {
          width: 160px;
          min-width: 160px;
          max-width: 160px;
          white-space: nowrap;
          margin-top: 16px;
          font-weight: 600;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .date-picker {
          width: 250px;
          margin-right: 15px;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker {
          position: relative;
          width: 110px;
          cursor: pointer;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker .time-picker-icon {
          position: absolute;
          top: 7px;
          bottom: 0;
          right: 7px;
          font-size: 24px;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker .time-picker-popup {
          position: absolute;
          top: 52px;
          left: 50%;
          width: 200px;
          margin-left: -100px;
          background: #4b5a6c;
          border-radius: 4px;
          z-index: 100;
          padding: 16px;
          display: none;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker .time-picker-popup.show {
          display: block;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker .time-picker-popup::before {
          left: 50%;
          margin-left: -8px;
          top: -8px;
          border-radius: 4px 0 0 0;
     }

     .create-plan-detail .step-editor-location-info .horizontal-field__content .time-picker .time-picker-popup .time-picker-separator {
          margin: 0 8px;
          color: #fff;
     }

     .create-plan-detail .step-pick-location.hide {
          display: none;
     }

     .transfer-type {
          background: #fff;
          font-weight: bold;
     }
     .place-text {
          position: relative;
     }
     .place-editing-box {
          box-shadow: 0px 2px 4px 0px rgba(34, 36, 38, 0.12),
               0px 2px 10px 0px rgba(34, 36, 38, 0.15);
          border: 1px solid rgba(0, 0, 0, .125);
          border-radius: .1875rem;
          background: #fff;
          opacity: 0;
          animation: 1s ease;
          z-index: 100;
     }

     .place-editing-box:before {
          top: -0.30714286em;
          left: 1em;
          right: auto;
          bottom: auto;
          margin-left: 0em;
          box-shadow: -1px -1px 0px 0px #bababc;
          position: absolute;
          content: '';
          width: 0.71428571em;
          height: 0.71428571em;
          background: #FFFFFF;
          -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
          z-index: 2;
     }

     .btn-box-custom {
          padding: .1875rem .6125rem;
     }
</style>

<script>
     function convertTimeToMinute(hour, minute) {
          return parseInt(hour) * 60 + parseInt(minute);
     }

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

     function formatDate(date) {
          let dd = date.getDate();
          let mm = date.getMonth() + 1;
          let yyyy = date.getFullYear();

          dd = dd < 10 ? '0' + dd : dd;
          mm = mm < 10 ? '0' + mm : mm;
          return dd + '/' + mm + '/' + yyyy;
     }
</script>