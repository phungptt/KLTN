<div class='gxmap_create_map_container h-100'>
     <div style="height: calc(100% - 50px);">
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
          if (!DATA.map) {
               initMap();
               $('.geocoder-control').addClass('geocoder-control-expanded');
          }
     });

     function initMap() {
          DATA.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 13);
          initControl();
          initExtends();
     };

     function initControl() {
          initGoogleLayer();
     };

     function initGoogleLayer() {
          DATA.layers.base['Google'] = L.tileLayer('https://{s}.google.com/vt/lyrs=' + 'r' + '&x={x}&y={y}&z={z}', {
               maxZoom: 26,
               subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
          });
          DATA.layers.base['Google'].addTo(DATA.map);
     };

     function initPlacesLayer(places, fitBounds = false) {
          PruneCluster.Cluster.ENABLE_MARKERS_LIST = true
          imagesLayer = new PruneClusterForLeaflet();

          var markers = [];
          var arrBounds = [];
          for (var i = 0; i < images.length; ++i) {
               var img = images[i];
               var marker = new PruneCluster.Marker(img['lat'], img['lng']);
               arrBounds.push([img['lat'], img['lng']]);

               marker.data.ID = img['id'];
               marker.data.name = img['name'] ? img['name'] : 'No title';
               marker.data.author = img['author'];
               marker.data.created_by = img['created_by'];
               marker.data.created_at = img['created_at'];
               marker.data.path = img['path'];

               var imgIcon = '<img src="' + img['path'] + '" id="image-object-on-map-' + img['id'] + '">';
               marker.data.icon = L.divIcon({
                    html: imgIcon,
                    className: 'image-object-on-map position-relative',
                    iconSize: [44, 44],
                    iconAnchor: [22, 49],
                    popupAnchor: [0, -40]
               });

               marker.data.popup = contentImagePopup(img['path'], marker.data);

               markers.push(marker);
               imagesLayer.RegisterMarker(marker);
          }

          imagesLayer.BuildLeafletClusterIcon = function(cluster) {
               var count = cluster.population;
               var marker = cluster.lastMarker;

               var imgIcon = '<img src="' + marker.data.path + '" id="image-object-on-map-' + marker.data.ID + '"><span class="count-cluster">' + count + '</span>';
               return L.divIcon({
                    html: imgIcon,
                    className: 'image-object-on-map position-relative',
                    iconSize: [48, 48],
                    iconAnchor: [24, 53],
                    popupAnchor: [0, -44]
               });
          };

          DATA.map.addLayer(imagesLayer);
          if (fitBounds) {
               DATA.map.fitBounds(arrBounds, {
                    padding: [100, 100]
               });
          }
     }
</script>