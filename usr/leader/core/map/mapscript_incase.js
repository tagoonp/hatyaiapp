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
var cMartkerIcon = '../../images/marker/clocation.png';
var icon = '../../images/marker/clocation.png';
var map;
var GGM;
var limit_show=10; // กำหนดแสดงรายการไม่เกิน
var obj_marker;  // สำหรับเก็บค่าพิกัดและข้อมูลจากฐานข้อมูล
var geocoder;
var my_Marker1;
var cMarker;

var infowindow=[];
var infowindowTmp;
var my_Marker=[];

// Initialize map
function initMap() {

    //google.maps = new Object(google.maps);
    // Create a map object and specify the DOM element for display.
    // alert(lat);
    var lat = $('#la').text();
    var lng = $('#lo').text();

    // alert(lat);
    var markerLatLng = new google.maps.LatLng(lat,lng);
    var icon = '../../images/marker/req_marker.png';

    map = new google.maps.Map(document.getElementById('map-canvas2'), {
       center: markerLatLng,
       scrollwheel: true,
       zoom: 14
    });

    // var markerLatLng = new google.maps.LatLng(obj_marker[i].alt_lat,obj_marker[i].alt_lng);
    my_Marker1 = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                  position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                  map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                  icon : icon
    });

    // End function
    loadingInstitute();
}

function loadingInstitute(){
  $.getJSON( "system/call-institute.php", function( data ) {

      var obj_marker=data;

      $.each(obj_marker,function(i,k){
        var icon = '../../images/marker/institute.png';

        var markerLatLng = new google.maps.LatLng(obj_marker[i].inst_lat,obj_marker[i].inst_lng);
        my_Marker[i] = new google.maps.Marker({ // สร้างตัว marker เป็นแบบ array
                      position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                      icon : icon ,
                      title: obj_marker[i].inst_name// แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });

        //  กรณีนำไปประยุกต์ ดึงข้อมูลจากฐานข้อมูลมาแสดง
        infowindow[i] = new google.maps.InfoWindow({
          content:$.ajax({
              url:'system/instituteDetail.php',//ใช้ ajax ใน jQuery ดึงข้อมูล
              data:'instituteID='+obj_marker[i].inst_id,// ส่งค่าตัวแปร ไปดึงข้อมูลจากฐานข้อมูล
              async:false
          }).responseText
        });

        google.maps.event.addListener(my_Marker[i], 'click', function(){ // เมื่อคลิกตัว marker แต่ละตัว
          if(infowindowTmp){ // ให้ตรวจสอบว่ามี infowindow ตัวไหนเปิดอยู่หรือไม่
                          infowindow[infowindowTmp].close();  // ถ้ามีให้ปิด infowindow ที่เปิดอยู่
          }
          infowindow[i].open(map,my_Marker[i]); // แสดง infowindow ของตัว marker ที่คลิก
          infowindowTmp=i; // เก็บ infowindow ที่เปิดไว้อ้างอิงใช้งาน
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
