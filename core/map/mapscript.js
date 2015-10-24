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
var icon = 'images/marker/clocation.png';
var map;
var GGM;
var limit_show=10; // กำหนดแสดงรายการไม่เกิน
var obj_marker;  // สำหรับเก็บค่าพิกัดและข้อมูลจากฐานข้อมูล
var geocoder;
var my_Marker;
var cMarker;

var infowindow_inst=[];
var infowindow_r=[];
var infowindow_y=[];
var infowindow_g=[];

var infowindowTmp_inst;
var infowindowTmp;
var my_Marker=[];
var my_Marker_r=[];
var my_Marker_y=[];
var my_Marker_g=[];
var my_Marker_b=[];
var my_Marker_inst=[];

var numrow1 = 0;
var numrow2 = 0;

// Initialize map
function initMap() {

    //google.maps = new Object(google.maps);
    // geocoder = new google.maps.Geocoder();
    geocoder = new google.maps.Geocoder();
    // Create a map object and specify the DOM element for display.
    map = new google.maps.Map(document.getElementById('map-canvas'), {
      center: {lat: -34.397, lng: 150.644},
      scrollwheel: true,
      // Apply the map style array to the map.
      styles: styleArray,
      zoom: 14
    });

    // Try W3C Geolocation (Preferred)
    if(navigator.geolocation) {
          browserSupportFlag = true;
          navigator.geolocation.getCurrentPosition(function(position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            cLocation = initialLocation;
            map.setCenter(initialLocation);
            map.panTo(initialLocation);

            cMarker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                icon: cMartkerIcon,
                title:"ตำแหน่งปัจจุบันของคุณ!",
                zoom: 14,
                draggable:true
            });

            // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
            google.maps.event.addListener(cMarker, 'dragend', function() {
                var my_Point = cMarker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
                $("#txtLat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                $("#txtLng").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                $('#txtLat').removeClass('h-required');
                $('#txtLng').removeClass('h-required');
                // เรียกขอข้อมูลสถานที่จาก Google Map
                geocoder.geocode({'latLng': my_Point}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                      $("#txtPlace").val(results[0].formatted_address); //
                    }else if(results[1]){
                      $("#txtPlace").val(results[1].formatted_address); //
                    }
                  } else {
                      // กรณีไม่มีข้อมูล
                    alert("Geocoder failed due to: " + status);
                  }
                });
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

          cMarker = new google.maps.Marker({
              position: cLocation,
              map: map,
              title:"Hello World!"
          });

          map.setCenter(initialLocation);
          // map.panTo(initialLocation);
    }
    // End function
    loadingMarkerAll();
    loadingMarker();
    loadingHistoryAll();
    loadingInstitute();
}

function loadingHistoryAll(){
  $.getJSON( "system/call-history.php", function( data ) {
      numrow2 = data.length;
  });
}

function loadingMarkerAll(){
  $.getJSON( "system/call-marker.php", function( data ) {
      numrow1 = data.length;
  });
}

function loadingInstitute(){
  $.getJSON( "system/call-institute.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){
        var icon = 'images/marker/institute.png';

        var markerLatLng = new google.maps.LatLng(obj_marker[i].inst_lat,obj_marker[i].inst_lng);
        my_Marker_inst[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].inst_name// แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });


        if(my_Marker_inst.length>0){
            for(i=0;i<my_Marker_inst.length;i++){
                my_Marker_inst[i].setMap(null);
            }
        }

      });
  });
}

function loadingMarker(){
  $.getJSON( "system/call-red-marker.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){
        var icon = 'images/marker/redpin.png';

        if(obj_marker[i].alt_level=='common'){
          icon = 'images/marker/redpin.png';
        }else if(obj_marker[i].alt_level=='urgen'){
          icon = 'images/marker/redpin.png';
        }else if(obj_marker[i].alt_level=='severe'){
          icon = 'images/marker/redpin.png';
        }

        var markerLatLng = new google.maps.LatLng(obj_marker[i].alt_lat,obj_marker[i].alt_lng);
        my_Marker_r[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].alt_other_msg // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });



      });
  });

  $.getJSON( "system/call-yellow-marker.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){
        var icon = 'images/marker/ylpin.png';

        var markerLatLng = new google.maps.LatLng(obj_marker[i].alt_lat,obj_marker[i].alt_lng);
        my_Marker_y[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].alt_other_msg // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });



      });

  });

  $.getJSON( "system/call-green-marker.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){

        var icon = 'images/marker/grpin.png';

        var markerLatLng = new google.maps.LatLng(obj_marker[i].alt_lat,obj_marker[i].alt_lng);
        my_Marker_g[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].alt_other_msg // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });



      });

  });

  $.getJSON( "system/call-blue-marker.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){

        var icon = 'images/marker/blpin.png';

        var markerLatLng = new google.maps.LatLng(obj_marker[i].alt_lat,obj_marker[i].alt_lng);
        my_Marker_b[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].alt_other_msg // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });



      });

  });
}

function searchPlace(){ // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
  var AddressSearch=$("#txtPlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
  if(geocoder){ // ตรวจสอบว่าถ้ามี Geocoder Object
    geocoder.geocode({
       address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
    },function(results, status){ // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
          if(status == google.maps.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
            var my_Point=results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
            map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
            cMarker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map
            cMarker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
            // cMarker.panTo(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
            $("#txtLat").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
            $("#txtLng").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value
          }else{
            // ค้นหาไม่พบแสดงข้อความแจ้ง
            alert("Geocode was not successful for the following reason: " + status);
            $("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
           }
    });
  }
}
// End searchplace function
