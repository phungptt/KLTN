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

     function initExtends() {
          initDragMarker(null);
     };

     function initGoogleLayer() {
          DATA.layers.base['Google'] = L.tileLayer('https://{s}.google.com/vt/lyrs=' + 'r' + '&x={x}&y={y}&z={z}', {
               maxZoom: 26,
               subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
          });
          DATA.layers.base['Google'].addTo(DATA.map);
     };

     function initDragMarker(coords) {
          coords = coords === null ? [10.780196902937137, 106.6872198151157] : coords;

          MARKER = L.marker(coords, {
               draggable: true
          }).bindPopup('<p>Move the marker or manually enter in the <b>Lat</b> and <b>Lng</b> below to update your image coordinates</p>');
          MARKER.addTo(DATA.map);
          initBindingMarkerAndGeometryInput();
     };

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
     };
</script>