<?php 
use app\modules\app\APPConfig;

?>

<div id="devices-map" class="h-100 w-100"></div>

<script type='text/javascript'>
    var DATA = {
        layers: {
            base: [],
            overlay: []
        },
        icons: {},
        controls: {},
        currentLatlng: null
    };
    $(function() {
        initMap();
    });

    function initMap() {
        DATA.map = L.map('app_project_map').setView([10.775655, 106.671866], 13);
        initLayer();
        initControl();
        initExtends();
    }

    function initLayer() {
        initBaseLayer();
        initLocationGPS();
        initVectorLayer();
    }

    function initControl() {
        initLayerControl();
    }

    function initExtends() {
        initDevicesGeoJsonLayer();
    }

    function initLocationGPS() {
        L.control.locate({
            iconElementTag: 'i',
            icon: 'icon-target',
            iconLoading: 'icon-spinner3 spinner'
        }).addTo(DATA.map);
    }

    function initGPSControl() {
        DATA.controls.controlgps = new L.Control.Gps();
        DATA.map.addControl(DATA.controls.controlgps);
        DATA.controls.controlgps.on("gps:located", function (e) {
        });
        if (DATA.currentLatlng != null) {
            DATA.map.flyTo([DATA.currentLatlng.lat, DATA.currentLatlng.lng], 17);
        }
    }

    function initLayerControl() {
        DATA.controls.controllayer = L.control.layers(DATA.layers.base, DATA.layers.overlay);
        DATA.controls.controllayer.addTo(DATA.map);
    }

    function initBaseLayer() {
        DATA.layers.base['Google Maps'] = L.tileLayer('http://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            minZoom: 0,
            maxZoom: 26,
            attribution: 'Google'
        });
    
        DATA.layers.base['Google Satellite'] = L.tileLayer('http://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            minZoom: 0,
            maxZoom: 26,
            attribution: 'Google'
        });

        DATA.layers.base['Google Satellite Hybrid'] = L.tileLayer('http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            minZoom: 0,
            maxZoom: 26,
            attribution: 'Google'
        });

        DATA.layers.base['Google Terrain Hybrid'] = L.tileLayer('http://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
            minZoom: 0,
            maxZoom: 26,
            attribution: 'Google'
        });

        DATA.layers.base['HCMGIS Maps'] = L.tileLayer.wms('https://pcd.hcmgis.vn/geoserver/gwc/service/wms', {
            layers: 'hcm_map:hcm_map_all',
            transparent: true,
            maxZoom: 26,
            format: 'image/png',
            attribution: 'HCMGIS'
        }).addTo(DATA.map);
    }

    function initLocationMarker() {
        DATA.layers.locationMarker = L.marker([0,0]).addTo(DATA.map);
        DATA.icons.locationMarkerIcon = L.divIcon({
            //iconAnchor: [20, 20],
            iconSize: [20,20],
            html: '<div id="icon-markerlocation"></div>'
        });
        DATA.layers.locationMarker.setIcon(DATA.icons.locationMarkerIcon);
        DATA.layers.locationMarker.addTo(DATA.map);
    }

    function initVectorLayer() {
        DATA.layers.vectorlayers = L.layerGroup();
        DATA.layers.vectorlayers.addTo(DATA.map);
    }

    function initProjectGeoJsonLayer() {
        var urlDevicesGeojson = '<?= APPConfig::getUrl('devices/get-geojson') ?>',
            deviceMarkerOptions = {
                radius: 8,
                fillColor: "#4caf50",
                color: "#333",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            };

        $.ajax({
            url: urlDevicesGeojson,
            success: function (data) {
                DATA.layers.devicesLayer = L.geoJSON(data.featureCollection, {
                    pointToLayer: function (feature, latlng) {
                        return L.circleMarker(latlng, deviceMarkerOptions);
                    },
                    onEachFeature: function (feature, layer) {
                        layer.bindPopup(getPopupTemplateOfGeojson(data.mapKeyLabel, feature.properties));
                    }
                });
                DATA.layers.recordlayers.addTo(DATA.map);
            }
        });
    }

    function getPopupTemplateOfGeojson(mapKeyLabel, properties) {
        var result = '';
        return properties['name'];
    }
</script>