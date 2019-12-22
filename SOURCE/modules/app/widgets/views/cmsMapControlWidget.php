<div class='gxmap_create_map_container h-100'>
    <div class='row m-0' style="height: calc(100% - 50px);">
        <div id='gxmap_create_map' class='col-12 p-0 h-100' style="z-index: 99"></div>
    </div>
    <div class="row form-group m-0 d-flex align-items-center bg-white" style="height: 50px">
        <div class="col-2 col-md-1 col-form-label">
            <span class="font-weight-semibold">Lat</span>
        </div>
        <div class="col-4 col-md-5">
            <input class="form-control" id='geom_lat' name="lat" type="text" />
        </div>
        <div class="col-2 col-md-1 col-form-label">
            <span class="font-weight-semibold">Lng</span>
        </div>
        <div class="col-4 col-md-5">
            <input class="form-control" id='geom_lng' name="lng" type="text" />
        </div>
    </div>
</div>

<script type="application/javascript">
    var DATA = {
        map: null,
        layers: {
            base: [],
            overlay: []
        },
        icons: {},
        controls: {},
    };

    $(function() {
        if(!DATA.map) {
            initMap();
            $('.geocoder-control').addClass('geocoder-control-expanded');
        }
    });

    function initMap() {
        DATA.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 13);
        initControl();
        initExtends();
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

    function initGoogleLayer() {
        DATA.layers.base['Google'] = L.tileLayer('https://{s}.google.com/vt/lyrs=' + 'r' + '&x={x}&y={y}&z={z}', {
            maxZoom: 26,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        DATA.layers.base['Google'].addTo(DATA.map);
    }

    function initDragMarker(coords) {
        coords = coords === null ? [10.780196902937137, 106.6872198151157] : coords;

        MARKER = L.marker(coords, {
            draggable: true
        }).bindPopup('<p>Move the marker or manually enter in the <b>Lat</b> and <b>Lng</b> below to update your image coordinates</p>');
        MARKER.addTo(DATA.map);
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
        initDragMarker(null);
        initClickToMapEvent();
    }
</script>