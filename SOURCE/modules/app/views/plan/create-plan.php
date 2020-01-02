<?php

use kartik\form\ActiveForm;
use kartik\date\DatePicker;

include('create-plan_css.php');
?>
<div class="create-plan" id="create-plan-page">
     <section class="page-title parallax parallax1">
          <div class="container">
               <div class="row">
                    <div class="col-md-12">
                         <div class="page-title-heading"> Tạo lịch trình
                         </div>
                         <ul class="breadcrumbs">
                              <li> <a href="#" title="Trang chủ">Trang chủ</a><span class="arrow_right"></span></li>
                              <li>Tạo lịch trình</li>
                         </ul>
                    </div>
               </div>
          </div>
          <div class="overlay"></div>
     </section>
     <section class="create-plan-content">
          <div class="container">
               <div class="row align-items-center my-5">
                    <div class="col-lg-6">
                         <img src="<?= Yii::$app->homeUrl ?>resources/images/page/create-plan/create-plan.png" alt="">
                    </div>
                    <div class="col-lg-6">
                         <?php $form = ActiveForm::begin([
                              'id' => 'create-plan-form',
                              'tooltipStyleFeedback' => true,
                              'options' => [
                                   'class' => 'form-listing'
                              ]
                         ]) ?>
                         <div class="inner-box">
                              <div class="destination">
                                   <?= $form->field($model, 'id_destination')->dropDownList($destinations, [
                                        'promt' => '-- Chọn điểm đến --'
                                   ])->label('Điểm đến') ?>
                              </div>
                              <div class="calendar-group">
                                   <label for="" class="control-label">Thời gian</label>
                                   <?= DatePicker::widget([
                                   'name' => 'Plan[date_start]',
                                   'value' => date('d-m-yy'),
                                   'name2' => 'Plan[date_end]',
                                   'value2' => date('d-m-yy'),
                                   'type' => DatePicker::TYPE_RANGE,
                                   'separator' => 'đến',
                                   'pluginOptions' => [
                                        'todayHighlight' => true,
                                        'format' => 'dd-mm-yyyy',
                                        'autoclose' => true
                                   ],
                                   ]) ?>
                              </div>
                              <div class="create-plan-btn mb-3">
                                   <div class="btn-more"><a href="#" @click="createPlan">Tạo lịch trình</a></div>
                              </div>
                         </div>
                         <?php ActiveForm::end() ?>
                    </div>
               </div>
          </div>
     </section>
</div>

<script>
     $(function() {
          var destinations = JSON.parse('<?= json_encode($destinations, true) ?>');
          var vm = new Vue({
               el: '#create-plan-page',
               data: {
                    destinations: destinations
               },
               methods: {
                    createPlan: function(e) {
                         e.preventDefault();

                         $.ajax({
                              data: $('#create-plan-form').serialize(),
                              type: 'POST',
                              success: function(resp) {
                                   if(!resp.status) {
                                        toastMessage('error', resp.message)
                                   }
                              },
                              error: function(msg) {
                                   toastMessage('error', msg)
                              }
                         })
                    }
               }
          })
     })
</script>