<?php

use app\modules\app\APPConfig;

?>

<div class="content" id="admin-places-page">
    <div class="container">
        <div class="card">
            <div class="card-header header-elements-inline bg-light">
                <h4 class="card-title font-weight-bold">
                    Danh sách địa điểm
                </h4>
                <div class="header-elements">
                    <a href="<?= APPConfig::getUrl('place/create') ?>" class="btn btn-sm btn-primary">Thêm địa điểm</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên địa điểm</th>
                            <th>Địa chỉ</th>
                            <th>SDT liên hệ</th>
                            <th>Loại địa điểm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(place, index) in places">
                            <td>{{ index++ }}</td>
                            <td>{{ place.name }}</td>
                            <td>{{ place.address }}</td>
                            <td>{{ place.phone_number }}</td>
                            <td>{{ place.id_type_of_place }}</td>
                            <td>
                                <button class="btn btn-sm btn-icon btn-outline-primary">A</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var places = <?= json_encode($places, true) ?>;

        var vm = new Vue({
            el: '#admin-places-page',
            data: {
                places: places
            }, 
            methods: {

            }
        })
    })
</script>