<div class="clearfix"></div>
<div id="googft-mapCanvas"></div>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;v=3"></script>
<script type="text/javascript">
    function initialize() {
        google.maps.visualRefresh = true;
        var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
                (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));
        if (isMobile) {
            var viewport = document.querySelector("meta[name=viewport]");
            viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');
        }
        var mapDiv = document.getElementById('googft-mapCanvas');
        mapDiv.style.width = isMobile ? '100%' : '1140px';
        mapDiv.style.height = isMobile ? '100%' : '800px';
        var map = new google.maps.Map(mapDiv, {
            center: new google.maps.LatLng(23.8365086729089, 120.0217749060547),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        layer = new google.maps.FusionTablesLayer({
            map: map,
            heatmap: {enabled: false},
            query: {
                select: "col5",
                from: "19-r6OctgXi0ndRBHfxJkyYOJMGT-QEZb25w6R523",
                where: ""
            },
            options: {
                styleId: 2,
                templateId: 3
            }
        });

        if (isMobile) {
            var legend = document.getElementById('googft-legend');
            var legendOpenButton = document.getElementById('googft-legend-open');
            var legendCloseButton = document.getElementById('googft-legend-close');
            legend.style.display = 'none';
            legendOpenButton.style.display = 'block';
            legendCloseButton.style.display = 'block';
            legendOpenButton.onclick = function () {
                legend.style.display = 'block';
                legendOpenButton.style.display = 'none';
            }
            legendCloseButton.onclick = function () {
                legend.style.display = 'none';
                legendOpenButton.style.display = 'block';
            }
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>