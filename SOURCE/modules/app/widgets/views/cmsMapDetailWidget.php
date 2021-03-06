<div class='gxmap_create_map_container h-100'>
    <div class='row m-0 h-100'>
        <div id='gxmap_create_map' class='col-12 p-0 h-100' style="z-index: 99"></div>
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

    var lat = '<?= $lat ? $lat : '' ?>';
    var lng = '<?= $lng ? $lng : '' ?>';
    $(function() {
        if(!DATA.map) {
            initMap();
        }
    });

    function initMap() {
        DATA.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 3);
        initLayer();
        initControl();
        initMarker();
    }

    function initLayer() {
        initVectorLayer();
    }

    function initControl() {
        initGoogleLayer();
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

    function initMarker() {
        if(lat !== '' && lng !== '') {
            var iconOption = L.icon({
                iconUrl: '<?= Yii::$app->homeUrl . "resources/images/marker_hcmgis.png" ?>',
                iconSize:     [32, 32],
                iconAnchor:   [16, 32],
                popupAnchor:  [0, -20]
            });
            var marker = new L.marker([lat, lng], {icon: iconOption}).addTo(DATA.map);
            DATA.map.setView([lat, lng], 15);
        }
    }
</script>