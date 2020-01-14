<?php 
use app\modules\app\APPConfig;
?>

<div class='gxmap_create_map_container h-100'>
     <div id='gxmap_create_map' class='col-12 p-0 h-100' style="z-index: 99"></div>
</div>

<script type="application/javascript">
     var DATA = {
          map: null,
          layers: {
               base: [],
               overlay: [],
               placesLayer: null
          },
          icons: {},
          controls: {},
          markers: {},
          dataBaseLayer: [
               {
                    domain: 'http://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
                    minZoom: 0,
                    maxZoom: 22,
                    attribution: 'Google Maps'
               }, {
                    domain: 'http://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
                    minZoom: 0,
                    maxZoom: 22,
                    attribution: 'Google Satellite'
               }, {
                    domain: 'http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',
                    minZoom: 0,
                    maxZoom: 22,
                    attribution: 'Google Satellite Hybrid'
               }, {
                    domain: 'http://server.arcgisonline.com/arcgis/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    minZoom: 0,
                    maxZoom: 22,
                    attribution: 'Esri Street'
               }
          ]
     };

     $(function() {
          if (!DATA.map) {
               initMap();
               $('.geocoder-control').addClass('geocoder-control-expanded');
          }
     });

     function initMap() {
          DATA.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 13);
          initControl();
          // initExtends();
     };

     function initControl() {
          DATA.dataBaseLayer.forEach(function(el, idx) {
               DATA.layers.base[el.attribution] = L.tileLayer.wms(el.domain, el);
               if (idx === 0) {
                    DATA.map.addLayer(DATA.layers.base[el.attribution]);
               };
          })
          DATA.controls.controllayer = L.control.layers(DATA.layers.base);
          DATA.controls.controllayer.addTo(DATA.map);
     };

     function initPlacesLayer(places, fitBounds = false) {
          if(DATA.map.hasLayer(DATA.layers.placesLayer)) {
               DATA.map.removeLayer(DATA.layers.placesLayer);
               DATA.markers = {};
          }

          PruneCluster.Cluster.ENABLE_MARKERS_LIST = true
          DATA.layers.placesLayer = new PruneClusterForLeaflet();

          var markers = [];
          var arrBounds = [];
          for(var key in places) {
               var place = places[key];
               DATA.markers[place['id_place']] = new PruneCluster.Marker(place['lat'], place['lng']);
               arrBounds.push([place['lat'], place['lng']]);

               DATA.markers[place['id_place']].data.ID = place['id_place'];
               DATA.markers[place['id_place']].data.name = place['name'] ? place['name'] : 'No title';
               DATA.markers[place['id_place']].data.address = place['address'];
               DATA.markers[place['id_place']].data.slug = place['slug'];
               DATA.markers[place['id_place']].data.path = place['path'];
               DATA.markers[place['id_place']].data.place_type = place['id_type_of_place'];

               var placeIcon = '<img src="' + place['path'] + '" id="image-object-on-map-' + place['id_place'] + '">';
               DATA.markers[place['id_place']].data.icon = L.divIcon({
                    html: placeIcon,
                    className: 'image-object-on-map position-relative',
                    iconSize: [44, 44],
                    iconAnchor: [22, 49],
                    popupAnchor: [0, -40]
               });

               DATA.markers[place['id_place']].data.popup = contentImagePopup(place['path'], DATA.markers[place['id_place']].data);

               markers.push(DATA.markers[place['id_place']]);
               DATA.layers.placesLayer.RegisterMarker(DATA.markers[place['id_place']]);
          }

          DATA.layers.placesLayer.BuildLeafletClusterIcon = function(cluster) {
               var count = cluster.population;
               var marker = cluster.lastMarker;

               var placeIcon = '<img src="' + marker.data.path + '" id="image-object-on-map-' + marker.data.ID + '"><span class="count-cluster">' + count + '</span>';
               return L.divIcon({
                    html: placeIcon,
                    className: 'image-object-on-map position-relative',
                    iconSize: [48, 48],
                    iconAnchor: [24, 53],
                    popupAnchor: [0, -44]
               });
          };

          DATA.map.addLayer(DATA.layers.placesLayer);
          if (fitBounds) {
               DATA.map.fitBounds(arrBounds, {
                    padding: [100, 100]
               });
          }
     }

     function contentImagePopup(path, data) {
          var urldetail = '<?= Yii::$app->homeUrl ?>app/place/' + (data.place_type == 0 ? 'hotel-detail' : (data.place_type == 1 ? 'food-detail' : 'visit-location-detail')) + '?slug=' + data.slug;
          var html = '<div class="d-flex flex-column align-items-center">'
          html += '<a href="' + urldetail + '"><h5 class="mb-0 font-weight-bold">' + data.name + '</h5></a>';
          html += '<p class="text-muted mt-1 mb-2">' + data.address + '</p>';
          html += '<a href="' + urldetail + '"><img src="' + path + '" style="width: 270px; height: 170px; object-fit:cover"></a>';
          html += '</div>'
          return html;
    }
</script>