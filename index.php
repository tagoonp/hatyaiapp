<?php
include "database/connect.class.php";
$db = new database();
$db->connect();

require ("configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();
$title = $conf->getTitle();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php print $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="core/css/master.css" media="screen" charset="utf-8">

    <script src="core/js/jquery-1.9.1.js"></script>
    <script src="core/js/jquery.js"></script>
    <script src="core/js/jquery.min.js"></script>
    <script type="text/javascript" src="core/map/mapscript.js"></script>
    <link rel="stylesheet" href="core/libraries/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="core/libraries/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="core/libraries/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script src="core/libraries/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="core/libraries/sweetalert/dist/sweetalert.css">
  </head>
  <body Onload="bodyOnload();">
    <div class="topPanel">
      ปัจจุบันมีการแจ้งเตือนล่าสุด
       <?php
      $strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_stage = '%s' ",mysql_real_escape_string(1));
      $result = $db->select($strSQL,false,true);

      if($result){
        print sizeof($result);
      }else{
        print "0";
      }
      ?> รายการ&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
    </div>
    <div class="leftPanel">
      <!-- <button type="button" name="button" class="ms-btn btn-ms-map border-shadow1" style="font-size: 0.9em;" title="เพิ่มการแจ้งเตือน"><i class="fa fa-plus-circle"></i></button> -->
      <button type="button" name="button" id="btnDisplay" class="ms-btn btn-ms-map border-shadow1" style="font-size: 0.9em;margin-top: 5px;" title="การตั้งค่า"><i class="fa fa-cogs"></i></button>
      <!-- <button type="button" name="button" class="ms-btn btn-ms-map2 border-shadow1" style="font-size: 0.9em; margin-top: 5px;" title="รายงานรูปแบบกราฟ"><i class="fa fa-bar-chart"></i></button> -->
    </div>
    <div class="bbb">
      <div class="register_panel_title" style="font-size: 0.8em; padding: 0px;">
        <div class="" style="width:100%; background: url('images/bg_alpha1.png'); color: #fff; ">
          <div class="" style="padding: 10px; font-size: 1.4em;">
            การแสดงผล
          </div>
        </div>
      </div>
      <div class="register_panel" style="font-size: 0.8em; padding: 0px; height: 270px;">
        <form class="" name="registForm" id="registForm">
          <div class="" style="padding: 10px; font-size: 1.3em;">
            <table width="900" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding-top:10px;" width="310" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td style="padding-top:0px;">
                        <label for="txtReqname"><strong>การแสดงผล Overlay</strong> </label><br>
                        <div class="" style="padding-top:5px; padding-left: 20px;">
                          <input type="checkbox" name="chb[]" value="food" class="cb1" id="cb1x" checked >
                          <label for="cb1">ทั้งหมด</label><br>
                          <input type="checkbox" name="chb[]" value="drug" class="cb1" id="cb2x" checked >
                          <label for="cb2"><font color="red">สถานะการแจ้ง/ร้องขอ</font></label><br>
                          <input type="checkbox" name="chb[]" value="other" class="cb1" id="cb3x" checked >
                          <label for="cb3"><font color="#FF9500">กำลังดำเนินการช่วยเหลือ</font></label><br>
                          <input type="checkbox" name="chb[]" value="other" class="cb1" id="cb4x" checked >
                          <label for="cb4"><font color="#30A200">ช่วยเหลือแล้ว</font></label><br>
                          <input type="checkbox" name="chb[]" value="other" class="cb1" id="cb5x" checked >
                          <label for="cb5"><font color="#0A72C8">ช่วยเหลือแล้วเกิน 4 ชั่วโมง</font></label><br>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:20px;">
                        <label for="txtReqname"><strong>Overlay อื่นๆ</strong> </label><br>
                        <div class="" style="padding-top:5px; padding-left: 20px;">
                          <input type="checkbox" name="chb[]" value="food" class="cb1" id="cb6x" >
                          <label for="cb6">ศูนย์ประสานงาน</label><br>
                          <input type="checkbox" name="chb[]" value="drug" class="cb1" id="cb7x">
                          <label for="cb7">บ้านพี่เลี้ยง</label><br>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>

        </form>
      </div>
    </div>
    <div id="map-canvas"></div>
  </body>
  <!-- Bottom panel -->
  <div class="bottom-panel border-shadow1">
    <div class="row-master">
      <div class="master-col-6" style="padding-top:5px; padding-bottom: 0px;">
        <div>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr style="font-size: 1.0em;">
              <td width="45">
                <div class="" style="padding-top: 10px; padding-left:10px;">
                  <img src="images/dmis-logo.png" alt="" />
                </div>
              </td>
              <td align="center" width="100" style="padding-top: 10px;">
                <a href="about.html" class="link-b">เกี่ยวกับเรา</a>
              </td>
              <td align="center" width="150" style="padding-top: 10px;">
                Mobile application
              </td>
              <td align="center" width="100" style="padding-top: 10px;">
                <a href="developer.html" class="link-b">ผู้พัฒนา</a>
              </td>
              <td>
                &nbsp;
              </td>
              <td width="140" style="padding-top: 10px;">
                <a id="single_image" href="login.html">
                  <button type="button" name="button" class="ms-btn btn-ms-primary border-shadow1">เข้าสู่ระบบ</button>
                </a>
              </td>
              <td width="60" style="padding-top: 5px;">
                <img src="images/Prince_of_Songkla_University_Emblem.png" alt="" width="40" />
              </td>
              <td width="50" style="padding-top: 5px;">
                <img src="images/trf-logo.png" alt="" width="30" />
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAewI1LswH0coZUPDe8Pvy39j4sbxmgCZU&callback=initMap" async defer></script>
  <!-- End bottom panel -->
  <script type="text/javascript">
      function doLoop()
      {
        bodyOnload();
      }

      function bodyOnload()
      {
        // doCallAjax('CustomerID')
        checkNewrecord();
        checkNewrecord2();
        setTimeout("doLoop();",10000);
      }

      function checkNewrecord(){
        $.post("system/check_new_record.php", {

          },
          function(result){
            // alert(numrow1);
            if(numrow1!=result){
              location.reload();
            }
          }
        );
      }

      function checkNewrecord2(){
        $.post("system/check_new_record2.php", {

          },
          function(result){
            if(numrow2!=result){
              location.reload();
            }
          }
        );
      }
      
      $(document).ready(function() {
        // Interval checking

      	/* This is basic - uses default settings */
      	$("a#single_image").fancybox();

        $('#btnLogin').click(function(){
          //alert('a');
        });

        $('#btnDisplay').click(function(){
          if($('.aaa').show()){
            $('.aaa').hide();
          }
          $('.bbb').slideToggle();
        });

        $('#cb1x').click(function(){
          if($("#cb1x").is(':checked')){
            if(my_Marker_r.length>0){
                for(i=0;i<my_Marker_r.length;i++){
                    my_Marker_r[i].setMap(map);
                }
            }

            if(my_Marker_y.length>0){
                for(i=0;i<my_Marker_y.length;i++){
                    my_Marker_y[i].setMap(map);
                }
            }

            if(my_Marker_g.length>0){
                for(i=0;i<my_Marker_g.length;i++){
                    my_Marker_g[i].setMap(map);
                }
            }

            if(my_Marker_b.length>0){
                for(i=0;i<my_Marker_b.length;i++){
                    my_Marker_b[i].setMap(map);
                }
            }

          }else{
            if(my_Marker_r.length>0){
                for(i=0;i<my_Marker_r.length;i++){
                    my_Marker_r[i].setMap(null);
                }
            }

            if(my_Marker_y.length>0){
                for(i=0;i<my_Marker_y.length;i++){
                    my_Marker_y[i].setMap(null);
                }
            }

            if(my_Marker_g.length>0){
                for(i=0;i<my_Marker_g.length;i++){
                    my_Marker_g[i].setMap(null);
                }
            }

            if(my_Marker_b.length>0){
                for(i=0;i<my_Marker_b.length;i++){
                    my_Marker_b[i].setMap(null);
                }
            }
          }
        });

        $('#cb2x').click(function(){
          if($("#cb2x").is(':checked')){
            if(my_Marker_r.length>0){
                for(i=0;i<my_Marker_r.length;i++){
                    my_Marker_r[i].setMap(map);
                }
            }
          }else{
            if(my_Marker_r.length>0){
                for(i=0;i<my_Marker_r.length;i++){
                    my_Marker_r[i].setMap(null);
                }
            }
          }
        });

        $('#cb3x').click(function(){
          if($("#cb3x").is(':checked')){
            if(my_Marker_y.length>0){
                for(i=0;i<my_Marker_y.length;i++){
                    my_Marker_y[i].setMap(map);
                }
            }
          }else{
            if(my_Marker_y.length>0){
                for(i=0;i<my_Marker_y.length;i++){
                    my_Marker_y[i].setMap(null);
                }
            }
          }
        });

        $('#cb4x').click(function(){
          if($("#cb4x").is(':checked')){
            if(my_Marker_g.length>0){
                for(i=0;i<my_Marker_g.length;i++){
                    my_Marker_g[i].setMap(map);
                }
            }
          }else{
            if(my_Marker_g.length>0){
                for(i=0;i<my_Marker_g.length;i++){
                    my_Marker_g[i].setMap(null);
                }
            }
          }
        });

        $('#cb5x').click(function(){
          if($("#cb5x").is(':checked')){
            if(my_Marker_b.length>0){
                for(i=0;i<my_Marker_b.length;i++){
                    my_Marker_b[i].setMap(map);
                }
            }
          }else{
            if(my_Marker_b.length>0){
                for(i=0;i<my_Marker_b.length;i++){
                    my_Marker_b[i].setMap(null);
                }
            }
          }
        });

        $('#cb6x').click(function(){
          if($("#cb6x").is(':checked')){
            if(my_Marker_inst.length>0){
                for(i=0;i<my_Marker_inst.length;i++){
                    my_Marker_inst[i].setMap(map);
                }
            }
          }else{
            if(my_Marker_inst.length>0){
                for(i=0;i<my_Marker_inst.length;i++){
                    my_Marker_inst[i].setMap(null);
                }
            }
          }
        });
      });
  </script>
</html>
