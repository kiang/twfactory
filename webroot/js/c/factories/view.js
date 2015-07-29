$(function () {
    if (factory.latitude && factory.longitude) {
        var factoryLatLng = new google.maps.LatLng(factory.latitude, factory.longitude);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: factoryLatLng,
            scaleControl: true,
            navigationControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: factoryLatLng,
            map: map,
            title: factory.name
        });
    }
});