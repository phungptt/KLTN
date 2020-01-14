<div class='gxmap_create_map_container'>
     <div id='gxmap_create_map' class='col-12 p-0' style="z-index: 99; height: 550px"></div>
</div>

<script type="application/javascript">
     var DATA = {
          map: null,
          layers: {
               base: [],
               overlay: [],
               tripLayers: {}
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
          ],
          transferType: [
               {
                    type: 'car',
                    label: 'Xe ô tô',
                    icon: 'fa fa-car'
               }, {
                    type: 'pedestrian',
                    label: 'Người đi bộ',
                    icon: 'fa fa-walking'
               }, {
                    type: 'bicycle',
                    label: 'Xe đạp',
                    icon: 'fa fa-biking'
               },
          ]
     }

     $(function() {
          initMap();
     })

     function initMap() {
          DATA.map = L.map('gxmap_create_map').setView([10.780196902937137, 106.6872198151157], 13);
          initControl();
     }

     function initControl() {
          DATA.dataBaseLayer.forEach(function(el, idx) {
               DATA.layers.base[el.attribution] = L.tileLayer.wms(el.domain, el);
               if (idx === 0) {
                    DATA.map.addLayer(DATA.layers.base[el.attribution]);
               };
          })
          DATA.controls.controllayer = L.control.layers(DATA.layers.base);
          DATA.controls.controllayer.addTo(DATA.map);
     }
</script>