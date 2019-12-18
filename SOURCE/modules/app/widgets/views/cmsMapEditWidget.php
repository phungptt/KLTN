<style>
    .geocoder-control.leaflet-control,
    .geocoder-control.geocoder-control-expanded,
    .geocoder-control-suggestions.leaflet-bar,
    .geocoder-control-input.leaflet-bar {
        width: 400px !important;
    }

    .geocoder-control.leaflet-control {
        position: absolute;
        top: 0;
        right: 0;
        transform: translateX(105%);
        height: 34px;
        margin-left: 0px;
    }

    .geocoder-control-input.leaflet-bar {
        height: 34px;
    }
</style>
<div class='gxmap_create_map_container mb-3'>
    <div class='row m-0'>
        <div id='gxmap_create_map' class='col-12' style="height: 350px !important;z-index: 99;"></div>
    </div>
    <?php if($useInputOfWidget): ?>
    <div class="row form-group mt-3 mx-0">
        <div class="col-3 col-md-1 col-form-label">
            <span class="font-weight-semibold">Latitude</span>
        </div>
        <div class="col-9 col-md-5">
            <input class="form-control" id='geom_lat' name="geom_lat" type="text" />
        </div>
        <div class="col-3 col-md-1 col-form-label">
            <span class="font-weight-semibold">Longitude</span>
        </div>
        <div class="col-9 col-md-5">
            <input class="form-control" id='geom_lng' name="geom_lng" type="text" />
        </div>
    </div>
    <?php endif; ?>
</div>

<script type="application/javascript">
    var DATA = {
        layers: {
            base: [],
            overlay: []
        },
        icons: {},
        controls: {},
        currentLatlng: null,
    };

    var lat = <?= $model->lat ? $model->lat : 'undefined' ?>,
        lng = <?= $model->lng ? $model->lng : 'undefined' ?>,
        initLocation = lat === undefined ? null : [lat, lng],
        defaulLocation = [10.762622, 106.660172];

    $(function() {
        $(window).on('load', function() {
            initMap();
        });

        $('.geocoder-control').addClass('geocoder-control-expanded');
    });

    function initMap() {
        DATA.map = L.map('gxmap_create_map').setView(defaulLocation, 17);
        initLayer();
        initControl();
        initExtends();
    }

    function initLayer() {
        // initLocationGPS();
        initVectorLayer();
    }

    function initControl() {
        initGoogleLayer();
        initSearchControl();
    }

    function initSearchControl() {
        L.control.scale().addTo(DATA.map);
        var searchControl = new L.esri.Controls.Geosearch().addTo(DATA.map);
        searchControl.on('results', function(data) {
            for (var i = data.results.length - 1; i >= 0; i--) {
                if (MARKER != undefined) {
                    DATA.map.removeLayer(MARKER);
                    initDragMarker(data.results[i].latlng);
                };
            }
        });
    }

    function initVectorLayer() {
        DATA.layers.vectorlayers = L.layerGroup();
        DATA.layers.vectorlayers.addTo(DATA.map);
    }

    function initGoogleLayer() {
        DATA.layers.base['Google'] = L.tileLayer('https://{s}.google.com/vt/lyrs=' + 'r' + '&x={x}&y={y}&z={z}', {
            maxZoom: 26,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        DATA.layers.base['Google'].addTo(DATA.map);
    }

    function initDragMarker(coords) {
        coords = coords === null ? defaulLocation : coords;
        MARKER = L.marker(coords, {
            draggable: true
        });
        MARKER.addTo(DATA.map);
        DATA.map.setView(coords, 17);
        initBindingMarkerAndGeometryInput();
    }

    function initClickToMapEvent() {
        DATA.map.on('click', function(e) {
            if (MARKER != undefined) {
                DATA.map.removeLayer(MARKER);
                initDragMarker(e.latlng);
            };
        })
    }

    function initBindingMarkerAndGeometryInput() {
        var inlat = $('#geom_lat');
        var inlng = $('#geom_lng');

        var latlng = MARKER.getLatLng();
        inlat.val(latlng.lat);
        inlng.val(latlng.lng);

        inlat.on('change', function() {
            MARKER.setLatLng([inlat.val(), inlng.val()]);
        });

        inlng.on('change', function() {
            MARKER.setLatLng([inlat.val(), inlng.val()]);
        })

        MARKER.on('dragend', function(e) {
            var latlng = e.target._latlng;
            inlat.val(latlng.lat);
            inlng.val(latlng.lng);
        })
    }


    function initExtends() {
        initDragMarker(initLocation);
        initClickToMapEvent();
    }
</script>