<style>
  .user-profile .user-tab-menu {
    position: relative;
    padding-bottom: 20px;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar {
    position: relative;
    max-width: 205px;
    margin: 0 auto;
    padding: 50px 0 0;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 70px;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-edit input {
    display: none;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-edit input+label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    -webkit-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-edit input+label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-edit input+label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;
    top: 5px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-preview {
    background: #fff;
    width: 192px;
    height: 192px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
  }

  .user-profile .user-tab-menu .profile-head .profile-avatar .avatar-preview>div {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  .user-profile .user-tab-menu .profile-head .profile-info {
    color: #fff;
  }

  .user-profile .user-tab-menu .profile-head .profile-info__name {
    margin-top: 8px;
    font-size: 20px;
    line-height: 1.5;
    font-weight: 600;
  }

  .user-profile .user-tab-menu .profile-head .profile-controls {
    display: block;
    width: 100%;
    z-index: 10;
    margin-top: 40px;
  }

  .user-profile .user-tab-menu .profile-head .profile-controls li {
    width: 33%;
    float: left;
    text-align: center;
    color: #e2e2e2;
    font-size: 15px;
  }

  .user-profile .user-tab-menu .profile-head .profile-controls li:nth-child(2) {
    border-left: solid 1px rgba(255, 255, 255, 0.3);
    border-right: solid 1px rgba(255, 255, 255, 0.3);
  }

  .user-profile .user-tab-menu .profile-head .profile-controls li a.active,
  .user-profile .user-tab-menu .profile-head .profile-controls li a:hover {
    color: #fff;
  }

  .user-profile .profile-content-section .profile-body {
    background-color: #f3f5f7;
  }

  .user-profile .profile-content-section .profile-body .user-section-card {
    border: 1px solid #e7eaee;
    background: white;
    border-radius: 60px;
    margin-top: 16px;
    font-size: 12px;
    line-height: 1.33;
    color: #8a99ad;
    padding: 24px
  }

  .user-profile .profile-content-section .profile-body .user-section-card .country-block__content .title {
    font-size: 24px;
    font-weight: 600;
    color: #000;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block {
    margin: 8px;
    width: -webkit-calc(100%/3 - 16px);
    width: calc(100%/3 - 16px);
    position: relative;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block>a>div {
    display: block;
    position: relative;
    overflow: hidden;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .des-wrap img {
    border-radius: 10px;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .des-wrap .des-content {
    position: absolute;
    top: 70%;
    left: 20px;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .des-wrap .des-content__name {
    font-size: 20px;
    font-weight: 600;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .dailist-sub-menu {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0.5;
    background-color: #000;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    padding: 7px 15px;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .dailist-sub-menu i {
    color: #fff;
    font-size: 16px;
  }

  .user-profile .profile-content-section .profile-body #user-plan .plan-section .destination-block .list {
    display: none;
    position: absolute;
    top: 45px;
    right: -25px;
    z-index: 999;
    width: auto;
    margin: 0;
    padding: 10px;
    list-style: none;
    background: #fff;
    color: #333;
    border-radius: 5px;
    -webkit-box-shadow: 0 0 5px #999;
    box-shadow: 0 0 5px #999;
  }

  .user-profile .profile-content-section .profile-body .user-section-card .title {
    font-size: 24px;
    font-weight: 600;
    color: #000;
  }

  .account-profile form.form-listing .inner-box.form {
    border-radius: 60px;
  }
  .account-profile .form-group {
    margin-bottom: 15px;
    position: relative;
  }

  .account-profile .form-group .input-wrap.margin{
    margin-left: 20%;
  }

  .account-profile .form-group .input-wrap.margin .btn-update {
    width: 176px;
    height: 40px;
  }

  .account-profile form.form-listing .form-group label {
    float: left;
    width: 20%;
    font-size: 14px;
    margin-bottom: 0;
    font-weight: 600;
    line-height: 34px;
  }

  .account-profile .form-group::before,
  .account-profile .form-group::after {
    display: table;
    content: "";
    clear: both;
  }

  .account-profile form.form-listing .form-group .input-wrap {
    float: left;
    width: 405px;
    height: 40px
  }
  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label {
    display: flex;
    white-space: nowrap;
  }
  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    right: 0;
    bottom: 0;
    left: 0;
    height: 30px;
    width: 30px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    outline: none;
    position: relative;
    z-index: 1000;
  }

  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input:checked {
    background: #4ca1af;
  }

  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input::before {
    position: absolute;
    left: 9px;
    content: '✔';
    display: inline-block;
    font-size: 16px;
    text-align: center;
    top: 3px;
  }

  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input::after {
    animation: click-wave 0.65s;
    background: #40e0d0;
    content: '';
    display: block;
    position: relative;
    z-index: 100;
  }

  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input.radio {
    border-radius: 50%;
  }

  .account-profile form.form-listing .form-group.gender-select-wrap .input-wrap label .option-input.radio::after {
    border-radius: 50%;
  }

  @keyframes click-wave {
    0% {
      height: 40px;
      width: 40px;
      opacity: 0.35;
      position: relative;
    }

    100% {
      height: 200px;
      width: 200px;
      margin-left: -80px;
      margin-top: -80px;
      opacity: 0;
    }
  }
</style>