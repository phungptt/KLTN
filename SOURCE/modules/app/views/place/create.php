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
<section class="flat-listing">
    <div class="content" id="create-place-page">
        <div class="container">
            <div class="choose-type-location text-center">
                <div class="title text-16 text-bold">Chọn loại địa điểm</div>
                <div class="d-flex justify-content-center my-3">
                    <a href="javascript:void(0)" class="btn btn-choose line-center" @click="showAFunc()">
                        <span>Tham quan</span>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-choose line-center mx-5" @click="showBFunc()">
                        <span>Ăn uống</span>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-choose line-center" @click="showCFunc()">
                        <span>Nghỉ ngơi</span>
                    </a>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12" v-bind:class="{showA: showA}" style="display:none">
                    <?php $form = ActiveForm::begin([
                        'id' => 'create-place-form',
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-listing'
                        ]
                    ]) ?>
                    <!--Start form -->
                    <div class="inner-box style3">
                        <label for="">Ảnh bìa</label>
                        <div class="browse image-upload-wrap h-100">
                            <p>Kéo hoặc thả file tại đây</p>
                            <span>hoặc</span>
                            <div class="upload">
                                <span>Tải ảnh</span>
                                <input class="file-upload-input" type='file' @change="readFileInfo" name="UploadImage[imageFile]" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
                        <div class="file-upload-content h-100" style="display: none">
                            <div class="d-flex flex-column align-items-center h-100">
                                <img class="file-upload-image w-auto" src="#" alt="HCMGIS GeoTag Image" style="height: 360px; object-fit: cover">
                                <h6 class="image-title-wrap text-danger mb-0 cursor-pointer font-weigth-bold" @click="removeImage" style="line-height: 20px; margin: 10px 0"><i class="icon-cross mr-1"></i>Xóa ảnh</h6>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="inner-box form">
                        <div class="wrap-listing">
                            <?= $form->field($model, 'name')->textInput()->label('Tên địa điểm tham quan') ?>
                        </div>
                        <div class="wrap-listing">
                            <div class="one-half">
                                <label for="">Thời gian mở cửa</label>
                                <input type="time" name="Place[time_open]">
                            </div>
                            <div class="one-half">
                                <label for="">Thời gian đóng cửa</label>
                                <input type="time" name="Place[time_closed]">
                            </div>
                        </div>
                        <div class="wrap-listing">
                            <?= $form->field($model, 'short_description')->textInput()->label('Mô tả ngắn') ?>
                        </div>
                        <div class="wrap-listing">
                            <?= $form->field($model, 'description')->textarea(['rows' => 10])->label('Mô tả') ?>
                        </div>
                        <div class="wrap-listing">
                            <?= $form->field($model, 'id_destination')->dropDownList(['Đà Lạt', 'Hồ Chí Minh'], [])->label('Điểm đến') ?>
                        </div>
                        <div class="wrap-listing">
                            <?= $form->field($model, 'address')->textInput()->label('Địa chỉ') ?>
                        </div>
                        <div class="pdmap style2" style="height: 400px;">
                            <?= CMSMapControlWidget::widget() ?>
                        </div>

                    </div>
                    <div class="inner-box style3">
                        <label for="">Hình ảnh mô tả địa điểm</label>
                        <div class="browse images-relate-upload-wrap" v-cloak>
                            <div class="list-images-relate-wrap row w-100 overflow-auto mx-0 mb-0 mt-2 p-2" style="height: 300px;">
                                <div class="image-relate-item position-relative col-12 col-sm-6 col-md-3" v-for="(img, idx) in imagesRelate">
                                    <img :src="img" alt="">
                                </div>
                            </div>
                            <div class="upload line-center">
                                <span class="mx-2" onclick="$('#images-relate-upload-input').trigger( 'click')">Tải ảnh</span>
                                <span @click="removeImageRelate" v-if="imagesRelate.length > 0" style="background-color: #F44336;"> Xóa ảnh</span>
                                <input type="file" id="images-relate-upload-input" accept=".png, .jpg, .jpeg" name="UploadImages[imageFiles][]" multiple @change="readRelate">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-form-listing w-100">Lưu địa điểm</button>
                    <?php $form->end() ?>
                    <!--End form-->
                </div>
                <div class="col-md-12" v-bind:class="{showB: showB}" style="display:none">
                    <?php $form = ActiveForm::begin([
                        'id' => 'create-place-form',
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-listing'
                        ]
                    ]) ?>
                    <!--Start form -->
                    <div class="inner-box style3">
                        <label>Ảnh bìa</label>
                        <div class="browse">
                            <p>Kéo hoặc thả file tại đây</p><span>hoặc</span>
                            <div class="upload"><span>Tải ảnh</span>
                                <input type="file" name="upload-file">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="inner-box form">
                        <div class="wrap-listing your-email">
                            <label>Tên địa điểm ăn uống</label>
                            <input type="email" name="email" placeholder="">
                        </div>
                        <div class="wrap-listing">
                            <label>Mô tả ngắn</label>
                            <input type="email" name="yourname" placeholder="Mô tả ngắn">
                        </div>
                        <div class="clearfix"></div>
                        <div class="wrap-listing">
                            <label>Địa chỉ</label>
                            <input type="email" name="yourname" placeholder="Địa chỉ">
                        </div>
                        <div class="wrap-listing">
                            <div class="one-half">
                                <label>Lat</label>
                                <input type="text" name="lat">
                            </div>
                            <div class="one-half">
                                <label>Lng</label>
                                <input type="text" name="lng">
                            </div>
                        </div>
                        <div class="pdmap style2" id="flat-map"></div>
                        <div class="wrap-listing">
                            <div class="one-half">
                                <label>Giá thấp nhất</label>
                                <input type="text" name="min-price">
                            </div>
                            <div class="one-half">
                                <label>Giá cao nhất</label>
                                <input type="text" name="max-price">
                            </div>
                        </div>
                        <div class="wrap-listing">
                            <label>Mô tả</label>
                            <textarea placeholder="Nhập mô tả về điểm đến"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="inner-box style3">
                        <label>Hình ảnh mô tả địa điểm</label>
                        <div class="browse">
                            <p>Kéo hoặc thả file tại đây</p><span>hoặc</span>
                            <div class="upload"><span>Tải ảnh</span>
                                <input type="file" name="upload-file">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <button class="submit-form-listing w-100">Thêm địa điểm</button>
                    <?php $form->end() ?>
                    <!--End form-->
                </div>
                <div class="col-md-12 create-hotel-form" v-bind:class="{showC: showC}" style="display:none">
                    <?php $form = ActiveForm::begin([
                        'id' => 'create-place-form',
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-listing create-form'
                        ]
                    ]) ?>
                    <!--Start form -->
                        <div class="inner-box style3">
                            <label>Ảnh bìa</label>
                            <div class="browse">
                                <p>Kéo hoặc thả file tại đây</p><span>hoặc</span>
                                <div class="upload"><span>Tải ảnh</span>
                                    <input type="file" name="upload-file">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="inner-box form">
                            <div class="wrap-listing your-email">
                                <label>Tên địa điểm nghỉ ngơi</label>
                                <input type="email" name="email" placeholder="">
                            </div>
                            <div class="wrap-listing">
                                <label>Mô tả ngắn</label>
                                <input type="email" name="yourname" placeholder="Mô tả ngắn">
                            </div>
                            <div class="clearfix"></div>
                            <div class="wrap-listing">
                                <label>Địa chỉ</label>
                                <input type="email" name="yourname" placeholder="Địa chỉ">
                            </div>
                            <div class="wrap-listing">
                                <div class="one-half">
                                    <label>Lat</label>
                                    <input type="text" name="lat">
                                </div>
                                <div class="one-half">
                                    <label>Lng</label>
                                    <input type="text" name="lng">
                                </div>
                            </div>
                            <div class="pdmap style2" id="flat-map"></div>
                            <div class="wrap-listing">
                                <label>Mô tả</label>
                                <textarea placeholder="Nhập mô tả về điểm đến"></textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="inner-box">
                            <div class="room-list">
                                <div class="room-list__item">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-plus"><i class="fa fa-plus"></i></div>
                                        <div class="text-20 title">Loại phòng </div>
                                    </div>
                                    <div class="wrap-listing">
                                        <label>Tên loại phòng</label>
                                        <select name="type-of-room">
                                            <option value="">Phòng Standard</option>
                                            <option value="">Phòng Superior</option>
                                            <option value="">Phòng Deluxe</option>
                                            <option value="">Phòng Suite</option>
                                            <option value="">Phòng Executive Suite</option>
                                            <option value="">Phòng Dorm</option>
                                        </select>
                                    </div>
                                    <div class="wrap-listing">
                                        <label>Số lượng khách</label>
                                        <select name="people-contain">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="wrap-listing">
                                        <label>Giá </label>
                                        <input type="number" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="d-inline-block"> <a class="room-list__add-item" href="#" v-on:click="addRoom">
                                    <div class="icon-plus"><i class="fa fa-plus"></i></div>Thêm loại phòng
                                </a></div>
                        </div>
                        <div class="inner-box style3">
                            <label>Hình ảnh mô tả địa điểm</label>
                            <div class="browse">
                                <p>Kéo hoặc thả file tại đây</p><span>hoặc</span>
                                <div class="upload"><span>Tải ảnh</span>
                                    <input type="file" name="upload-file">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <button class="submit-form-listing w-100">Thêm địa điểm</button>
                    <?php $form->end() ?>
                    <!--End form-->
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(function() {
        var vueinstance = new Vue({
            el: '#create-place-page',
            data: {
                imagesRelate: [],
                showA: false,
                showB: false,
                showC: false
            },
            methods: {
                addRoom: function(event) {
                    
                },
                showAFunc: function(event) {
                    this.showA = true;
                    this.showB = false;
                    this.showC = false;
                },
                showBFunc: function(event) {
                    this.showA = false;
                    this.showB = true;
                    this.showC = false;
                },
                showCFunc: function(event) {
                    this.showA = false;
                    this.showB = false;
                    this.showC = true;
                },
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
                            if (index >= input.files.length) return;
                            var file = input.files[index];
                            reader.onload = function(e) {
                                _this.imagesRelate.push(e.target.result)
                                readFile(index + 1)
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
        });
        
    })
</script>