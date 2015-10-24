// Specify features and elements to define styles.
var styleArray = [
  {
    featureType: "all",
    stylers: [
     { saturation: -80 }
    ]
  },{
    featureType: "road.arterial",
    elementType: "geometry",
    stylers: [
      { hue: "#00ffee" },
      { saturation: 50 }
    ]
  },{
    featureType: "poi.business",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
];
var cLocation;
var initialLocation;
// var psu = new google.maps.LatLng(7.008434, 100.496255);
// var browserSupportFlag =  new Boolean();
var cMartkerIcon = 'images/marker/clocation.png';
var map;
var GGM;
var limit_show=10; // กำหนดแสดงรายการไม่เกิน
var obj_marker;  // สำหรับเก็บค่าพิกัดและข้อมูลจากฐานข้อมูล

// Initialize map
function initMap() {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
      center: {lat: -34.397, lng: 150.644},
      scrollwheel: true,
      // Apply the map style array to the map.
      // styles: styleArray,
      zoom: 10
    });

    // Try W3C Geolocation (Preferred)
    if(navigator.geolocation) {
          browserSupportFlag = true;
          navigator.geolocation.getCurrentPosition(function(position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            cLocation = initialLocation;
            map.setCenter(initialLocation);
            map.panTo(initialLocation);

            var cMarker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                icon: cMartkerIcon,
                title:"ตำแหน่งปัจจุบันของคุณ!"
            });

          }, function() {
            handleNoGeolocation(browserSupportFlag);
          });
    } else { // Browser doesn't support Geolocation
          browserSupportFlag = false;
          handleNoGeolocation(browserSupportFlag);
    }

    function handleNoGeolocation(errorFlag) {
          if (errorFlag == true) {
            alert("Geolocation service failed.");
            initialLocation = psu;
          } else {
            alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
            initialLocation = psu;
          }

          var cMarker = new GGM.Marker({
              position: cLocation,
              map: map,
              title:"Hello World!"
          });

          map.setCenter(initialLocation);
          // map.panTo(initialLocation);
    }
    // End function


}
