<?php

use app\modules\app\APPConfig;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

include('create-plan_css.php')
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
                              'id' => 'create-plan-form'
                         ]) ?>
                         <div class="destination">
                              <?= $form->field($model, 'id_place')->dropDownList($destinations, [
                                   'promt' => '-- Chọn điểm đến --'
                              ]) ?>
                         </div>
                         <div class="calendar-group">
                              <?= DatePicker::widget([
                                  'model' => $model,
                                  'attribute' => 'date_start',
                                  'attribute2' => 'date_end',
                                  'options' => ['placeholder' => 'Ngày bắt đầu'],
                                  'options2' => ['placeholder' => 'Ngày kết thúc'],
                                  'type' => DatePicker::TYPE_RANGE,
                                  'form' => $form,
                                  'pluginOptions' => [
                                      'format' => 'yyyy-mm-dd',
                                      'autoclose' => true,
                                  ] 
                              ]) ?>
                         </div>
                         <div class="create-plan-btn">
                              <div class="btn-more"><a href="<?= APPConfig::getUrl('plan/create-plan-detail?slug=') ?>" title="">Tạo lịch trình</a></div>
                         </div>
                         <?php ActiveForm::end() ?>
                    </div>
               </div>
          </div>
     </section>
</div>

<script>
     $(function() {
          var destinations = <?= json_encode($destinations, true) ?>;
          var vm = new Vue({
               el: '#create-plan-page',
               data: {
                    destinations: destinations
               }
          })
     })
</script>