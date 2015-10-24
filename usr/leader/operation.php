<?php
session_start();
include "../../database/connect.class.php";
$db = new database();
$db->connect();

require ("../../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();
$title = $conf->getTitle();

require_once "../../system/check_session.php";

$pid = '';
if(isset($_GET['req_id'])){
  $pid = $_GET['req_id'];
}

$strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_id = '%s' ",mysql_real_escape_string($pid));
$result = $db->select($strSQL,false,true);

$fUser = '';
if(!$result){
  header('');
  exit();
}else{
  $fUser = $result[0]['alt_username'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php print $title; ?></title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/font-awesome/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/social-buttons.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../core/libraries/seven7/stylesheets/dropzone.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../core/libraries/seven7/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/jquery/jquery-ui.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/raphael.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/selectivizr-min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/fullcalendar.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/gcal.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/datatable-editable.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/excanvas.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/isotope_extras.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/select2.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/styleswitcher.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/wysiwyg.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/typeahead.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/summernote.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.validate.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/typeahead.js" type="text/javascript"></script>
    <!-- <script src="../../core/libraries/seven7/javascripts/spin.min.js" type="text/javascript"></script> -->
    <script src="../../core/libraries/seven7/javascripts/ladda.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/moment.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/mockjax.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/bootstrap-editable.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/xeditable-demo-mock.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/xeditable-demo.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/daterange-picker.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/date.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/fitvids.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/dropzone.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/main.js" type="text/javascript"></script>
    <script src="../../core/libraries/seven7/javascripts/respond.js" type="text/javascript"></script>
    <script type="text/javascript" src="core/map/mapscript_incase.js"></script>
    <script src="../../core/libraries/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../core/libraries/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="../../core/css/master.css" media="screen" charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img width="34" height="34" src="../../images/map-icon.png" />John Smith<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <i class="fa fa-user"></i>My Account</a>
                  </li>
                  <li><a href="#">
                    <i class="fa fa-gear"></i>Account Settings</a>
                  </li>
                  <li><a href="login1.html">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php">
            <div style="padding-top: 10px; font-size: 1.3em; text-align:center; color: #06c; padding-left: 120px;">
            <strong>DMIS </strong>  <font color="#888" style="font-size: 1.0em; font-weight: light;">U-tapao cathment</font>
            </div>
          </a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a href="index.php">
                  <span aria-hidden="true" class="se7en-home"></span>หน้าหลัก
                </a>
              </li>
              <!-- <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-tables"></span>ตารางข้อมูล<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="tables.html">Basic tables</a>
                  </li>
                  <li>
                    <a href="datatables.html">DataTables</a>
                  </li>
                  <li><a href="datatables-editable.html">
                    <div class="notifications label label-warning">
                      New
                    </div>
                    <p>
                      Editable DataTables
                    </p></a>
                  </li>
                </ul>
              </li> -->
              <!-- <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-pages"></span>เพิ่มข้อมูลอื่นๆ<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="chat.html">
                    <span class="notifications label label-warning">New</span>
                    <p>
                      Chat
                    </p></a>
                  </li>
                </ul>
              </li> -->
              <!-- <li><a href="charts.html">
                <span aria-hidden="true" class="se7en-charts"></span>รายงาน</a>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            ประสานงาน
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumb">
              <li>
                <a href="index.php"></a><i class="fa fa-home"></i>
              </li>
              <li class="active">
                ประสานงาน
              </li>
            </ul>
          </div>
        </div>
        <!-- End row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
              <div class="heading tabs">
                <i class="fa fa-sitemap"></i>
                Operation
                <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>ข้อมูลเบื้องต้น</span></a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>การประสานต่อ</span></a>
                  </li>
                  <!-- <li>
                    <a data-toggle="tab" href="#tab3"><i class="fa fa-paper-clip"></i><span>ประวัติการแจ้ง</span></a>
                  </li> -->
                </ul>
              </div>
              <div class="tab-content padded" id="my-tab-content">
                <div class="tab-pane active" id="tab1">
                  <p>
                  </p>
                  <div class="row">
                    <div class="col-md-6">
                      <h3>
                        ข้อมูลเบื้องต้น
                      </h3>
                      <div class="row">
                        <div class="col-sm-5">
                          <strong>วันที่แจ้ง</strong>
                        </div>
                        <div class="col-sm-5">
                          <?php print $result[0]['alt_date_ent']; ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>เวลาที่แจ้ง</strong>
                        </div>
                        <div class="col-sm-5">
                          <?php print $result[0]['alt_time_ent']; ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>ชื่อผู้แจ้ง</strong>
                        </div>
                        <div class="col-sm-5">
                        <?php print $result[0]['alt_name']; ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>หมายเลชขโทรศัพท์</strong>
                        </div>
                        <div class="col-sm-5" style="color: #06c;">
                          <?php print $result[0]['alt_phone']; ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>ระดับความเร่งด่วน</strong>
                        </div>
                        <div class="col-sm-5">
                        <?php
                            switch($result[0]['alt_level']){
                              case 'severe': print "<font color=red>เร่งด่วนมาก</font>"; break;
                              case 'urgen': print "<font color=orange>เร่งด่วน</font>"; break;
                              case 'common': print "<font color=#06c>ทั่วไป</font>"; break;
                            }
                        ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>ความต้องการ</strong>
                        </div>
                        <div class="col-sm-5">
                            <?php
                            if(($result[0]['alt_food']!='No') || ($result[0]['alt_drug']!='No')){
                              if($result[0]['alt_food']=='Yes'){ print "- อาหาร<br>";}
                              if($result[0]['alt_drug']=='Yes'){ print "- ยารักษาโรค<br>";}
                            }else{
                              print "-";
                            }
                            ?>
                        </div>
                        <div class="col-sm-5">
                          <strong>ข้อความ/อื่นๆ</strong>
                        </div>
                        <div class="col-sm-5">
                          <?php  print $result[0]['alt_other_msg']; ?>
                        </div>
                      </div>

                    </div>
                    <!-- End col lg 5 -->
                    <div class="col-lg-6">
                      <h3>
                        ข้อมูลสถานที่โดยสังเขป
                      </h3>
                      <div class="row">
                        <div class="col-md-5">
                          <strong>ตำแหน่ง</strong>
                        </div>
                        <div class="col-md-5">
                          <?php  print $result[0]['alt_place']; ?>
                        </div>
                        <div class="col-md-5">
                          <strong>ละติจูด</strong>
                        </div>
                        <div class="col-md-5" id="la">
                          <?php  print $result[0]['alt_lat']; ?>
                        </div>
                        <div class="col-md-5">
                          <strong>ลองติจูด</strong>
                        </div>
                        <div class="col-md-5" id="lo">
                          <?php  print $result[0]['alt_lng']; ?>
                        </div>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <!-- End row -->

                  <div class="row">
                    <h3>แผนที่</h3>
                    <div class="col-lg-12" style="height: 400px; background: #ccc;" id="map-canvas2">

                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2">
                  <h3>
                    การประสานงานต่อ
                  </h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="widget-container fluid-height clearfix">
                        <div class="heading">
                          <i class="fa fa-user"></i>เลือกผู้ประสานงาน
                        </div>
                        <div class="widget-content padded clearfix">
                          <form action="#" class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-md-2">รหัสการแจ้งเตือน</label>
                              <div class="col-md-7">
                                <input class="form-control" placeholder="Text" type="text" name="pid" id="pid" readonly value="<?php print $pid;?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">สถานะปัจจุบัน</label>
                              <div class="col-md-7">
                                <input class="form-control" placeholder="Text" type="text" name="cstat" id="cstat" readonly value="<?php print $result[0]['alt_stage'];?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">สถานะต่อไป</label>
                              <div class="col-md-7">
                                <select class="form-control" name="inst" id="inst">
                                  <option value="1">รับแจ้ง</option>
                                  <option value="2" <?php if($result[0]['alt_stage']==1){print "selected";} ?>>อยู่ระหว่างประสานงาน/ช่วยเหลือ</option>
                                  <option value="3" <?php if($result[0]['alt_stage']==2){print "selected";} ?>>ช่วยเหลือเรียบร้อย</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">เลือกศูนย์ประสานงาน</label>
                              <div class="col-md-4">
                                <select class="select2able" name="inst-select" id="inst-select">
                                  <option value="">เลือกทั้งหมด</option>
                                  <?php
                                  $strSQL = sprintf("SELECT * FROM ".$prefix."institute WHERE inst_status = '%s' order by inst_name ",mysql_real_escape_string('Yes'));
                                  $resultinst = $db->select($strSQL,false,true);

                                  if($resultinst){
                                    foreach($resultinst as $v){
                                      ?>
                                      <option value="<?php print $v['inst_id']; ?>"><?php print $v['inst_name'];?></option>
                                      <?php
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                              <!-- <div class="col-md-2" style="padding-top: 0px;">
                                <button type="button" name="btnSearchStaff" id="btnSearchStaff" class="ms-btn btn-ms-map2" style="width: 150px; margin-top: 0px;"><i class="fa fa-search"></i> ค้นหา</button>
                              </div> -->
                            </div>
                          </div>
                          <span id="mySpan"></span>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="widget-container fluid-height clearfix">
                                <div class="heading">
                                  <i class="fa fa-table"></i>ประวัติการประสานงาน
                                </div>
                                <div class="widget-content padded clearfix">
                                  <table class="table">
                                    <thead>
                                      <th>
                                        #
                                      </th>
                                      <th>
                                        ชื่อผู้ประสาน
                                      </th>
                                      <th>
                                        วันที่
                                      </th>
                                      <th>
                                        เวลา
                                      </th>
                                      <th>
                                        สถานะ
                                      </th>
                                      <th>
                                        &nbsp;
                                      </th>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <?php print "1"; ?>
                                        </td>
                                        <td>
                                          <?php print $result[0]['alt_username']; ?>
                                        </td>
                                        <td>
                                          <?php print $result[0]['alt_date_ent']; ?>
                                        </td>
                                        <td>
                                          <?php print $result[0]['alt_time_ent']; ?>
                                        </td>
                                        <td class="hidden-xs">
                                          <span class="label label-danger">รับแจ้ง</span>
                                        </td>
                                        <td>
                                          &nbsp;
                                        </td>
                                      </tr>
                                      <?php
                                      $strSQL = sprintf("SELECT * FROM ".$prefix."transection WHERE tr_alt_id = '%s' order by tr_id ",mysql_real_escape_string($pid));
                                      $resulttransection = $db->select($strSQL,false,true);

                                      if($resulttransection){
                                        $d = 2;
                                        foreach($resulttransection as $v){
                                          ?>
                                          <tr>
                                            <td>
                                              <?php print $d; ?>
                                            </td>
                                            <td>
                                              <?php print $v['tr_assignfrom']."->".$v['tr_assignto']; ?>
                                            </td>
                                            <td class="hidden-xs">
                                              <?php print $v['tr_date']; ?>
                                            </td>
                                            <td>
                                              <?php print $v['tr_time']; ?>
                                            </td>
                                            <td>
                                              <?php
                                              switch ($v['tr_tostage']) {
                                                case '2':
                                                  ?><span class="label label-warning">กำลังประสาน/ช่วยเหลือ</span><?php
                                                  break;
                                                case '3':
                                                    ?><span class="label label-success">ช่วยเหลือเสร็จสิ้น</span><?php
                                                    break;
                                                default:
                                                  # code...
                                                  break;
                                              }
                                              ?>
                                            </td>
                                          </tr>
                                          <?php
                                          $d++;
                                        }
                                      }else{
                                        // print $strSQL;
                                      }
                                      ?>

                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                      <!-- End col-md-6 -->
                  </div>
                  <!-- End row -->
                </div>
            </div>
          </div>
        </div>
        <!-- End row -->
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
            A Prototype of Disaster Data Management System in the U-Tapao Cathment using Google Map - http://ictcluster.sci.psu.ac.th/dmis
<br>สาขาเทคโนโลยีสารสนเทศและการสื่อสาร คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์, Research and Development Office (RDO)
          </div>
        </div>
      </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAewI1LswH0coZUPDe8Pvy39j4sbxmgCZU&callback=initMap" async defer></script>
    <script type="text/javascript">
      $(document).ready(function() {
        doCallAjax('');

        $('#inst-select').change(function(){
          var inst = $('#inst-select').val();
          // alert('inst-select')
          doCallAjax(inst);
        });
        // $('#btnSearchStaff').click(function(){
        //   var inst = $('#inst-select').val();
        //   // alert('inst-select')
        //   doCallAjax(inst);
        // });
      });
    </script>
    <script type="text/javascript">
      var HttPRequest = false;

      function doCallAjax(inst) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  }

		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

			var url = 'system/liststaff.php';
			var pmeters = 'institute_id='+inst;
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// HttPRequest.setRequestHeader("Content-length", pmeters.length);
			// HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);


			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }

			}

	   }

     function assignWork(user,fullname){
       swal({
         title: "ยืนยันการมอบหมายงาน?",
         text: "คุณต้องการให้ " + fullname + "ประสานความช่วยเหลือ?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "ยืนยัน!",
         closeOnConfirm: false
       }, function(){
        //  swal("Deleted!", "Your imaginary file has been deleted.", "success");
          $.post("system/update_alert.php", {
            pid: $('#pid').val(),
            nextStat: $('#inst').val(),
            user: user
            },
            function(result){
              if(result=='Y'){
                // swal("บันทึกข้อมูลเรียบร้อย!", "คลิ๊ก OK เพื่อกลับสู่หน้าหลัก!", "success");
                swal({
                  title: "บันมึกข้อมูลเรียบร้อย",
                  text: "คลิ๊ก OK เพื่อกลับสู่หน้าหลัก",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK!",
                   closeOnConfirm: false
                 }, function(){
                   window.location = 'index.php';
                 });
              }else{
                swal("ขออภัย!", "การบันทึกข้อมูลล้มเหลว!", "warning");
              }
            }
          );
          return false;
       });
     } //End function
    </script>
  </body>
</html>
