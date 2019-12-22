<?php

use kartik\form\ActiveForm;
use app\modules\app\APPConfig;
use app\modules\app\widgets\CMSMapControlWidget;
use app\modules\contrib\gxassets\GxLaddaAsset;
use app\modules\contrib\gxassets\GxLeafletAsset;
use app\modules\contrib\gxassets\GxErsiAutocompleteAsset;

GxLeafletAsset::register($this);
GxErsiAutocompleteAsset::register($this);
GxLaddaAsset::register($this);
include('_create_css.php')
?>

<div class="content" id="create-place-page">
    <div class="container">
        <?php $form = ActiveForm::begin([
            'id' => 'create-place-form'
        ]) ?>
        <div class="row">
            <div class="col-md-6">
                <div style="height: 400px;">
                    <?= CMSMapControlWidget::widget() ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pr-1" style="height: 400px">
                    <div class="image-upload-wrap h-100">
                        <div class="d-flex justify-content-center align-items-center bg-info position-relative h-100" style="border-radius:.1875rem">
                            <input class="file-upload-input h-100" type='file' @change="readFileInfo" name="UploadImage[imageFile]" accept=".png, .jpg, .jpeg" />
                            <div class="drag-text">
                                <h3>Ảnh đại diện </h3>
                            </div>
                        </div>
                    </div>
                    <div class="file-upload-content h-100" style="display: none">
                        <div class="d-flex flex-column align-items-center h-100">
                            <img class="file-upload-image w-auto" src="#" alt="HCMGIS GeoTag Image" style="height: 360px; object-fit: cover">
                            <h6 class="image-title-wrap text-danger mb-0 cursor-pointer font-weigth-bold" @click="removeImage" style="line-height: 20px; margin: 10px 0"><i class="icon-cross mr-1"></i>Xóa ảnh</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="images-relate-upload-wrap form-group mt-3" v-cloak>
                    <span class="btn btn-sm bg-teal cursor-pointer" onclick="$('#images-relate-upload-input').trigger( 'click' )"><i class="icon-upload mr-2"></i>ẢNH VỀ ĐỊA ĐIỂM</span>
                    <span class="btn btn-sm btn-danger cursor-pointer" @click="removeImageRelate" v-if="imagesRelate.length > 0"><i class="icon-trash mr-2"></i> Xóa ảnh</span>
                    <input type="file" id="images-relate-upload-input" accept=".png, .jpg, .jpeg" name="UploadImages[imageFiles][]" multiple @change="readRelate">
                    <div class="list-images-relate-wrap row w-100 overflow-auto mx-0 mb-0 mt-2 p-2" style="height: 300px;">
                        <div class="image-relate-item position-relative col-12 col-sm-6 col-md-3" v-for="(img, idx) in imagesRelate">
                            <img :src="img" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'name')->textInput()->label('Tên địa điểm') ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'short_description')->textInput()->label('Mô tả ngắn') ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 10])->label('Mô tả') ?>    
            </div>
            <div class="col-12">
                <?= $form->field($model, 'phone_number')->textInput()->label('Điện thoại liên hệ') ?>    
            </div>
            <div class="col-12">
                <?= $form->field($model, 'address')->textInput()->label('Địa chỉ') ?>    
            </div>
            <div class="col-12">
                <?= $form->field($model, 'id_destination')->dropDownList(['Đà Lạt', 'Hồ Chí Minh'], [])->label('Điểm đến') ?>    
            </div>
            <div class="col-12">
                <input type="time" class="form-control js-time-picker" name="Place[time_open]">    
            </div>
            <div class="col-12">
                <input type="time" class="form-control js-time-picker" name="Place[time_close]">  
            </div>
            <div class="col-12">
                <button class="form-control btn btn-primary" id="btn-submit" @click="createPlace">Thêm địa điểm</button>   
            </div>
        </div>
        <?php $form->end() ?>
    </div>
</div>

<script>
    $(function() {
        var vueinstance = new Vue({
            el: '#create-place-page',
            data: {
                imagesRelate: []
            },
            methods: {
                readFileInfo: function(event) {
                    var _this = this,
                        input = event.target;

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.image-upload-wrap').hide();
                            $('.file-upload-image').attr('src', e.target.result);
                            $('.file-upload-content').show();
                        };
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        _this.removeImage();
                    }
                },

                removeImage: function() {
                    var _this = this;
                    $('.file-upload-input').val('');
                    $('.file-upload-content').hide();
                    $('.image-upload-wrap').show();
                },

                readRelate: function(event) {
                    var _this = this,
                        input = event.target;
                    if (input.files.length > 0) {
                        var reader = new FileReader();
                        function readFile(index) {
                            if( index >= input.files.length ) return;
                            var file = input.files[index];
                            reader.onload = function(e) {
                                _this.imagesRelate.push(e.target.result)
                                readFile(index+1)
                            }
                            reader.readAsDataURL(file);
                        }
                        readFile(0);
                    }
                },

                removeImageRelate: function() {
                    this.imagesRelate = [];
                    $('.list-images-relate-wrap').empty();
                    $('#images-relate-upload-input').val('');
                },

                createPlace: function(event) {
                    event.preventDefault();
                    var _this = this,
                        ladda = Ladda.create($("#btn-submit")[0]),
                        formData = new FormData($('#create-place-form')[0]);

                    ladda.start();
                    $.ajax({
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        url: '<?= APPConfig::getUrl('place/create') ?>',
                        data: formData,
                        success: function(response) {
                            if (response.status === false) {
                                toastMessage('error', response.message);
                            } else {
                                toastMessage('success', response.message);
                                window.location.reload();
                            }
                            ladda.stop();
                        },
                        error: function() {
                            toastMessage('error', 'Upload failed');
                            ladda.stop();
                        }
                    });
                }
            }
        })
    })
</script>