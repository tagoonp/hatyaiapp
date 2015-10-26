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
require_once "../../system/check_authen.php";
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
                <img width="34" height="34" src="../../images/map-icon.png" />
                <?php
                  if($resultUserInfo){
                    print $resultUserInfo[0]['prefix_name'].$resultUserInfo[0]['usr_fname']." ".$resultUserInfo[0]['usr_lname'];
                  }
                ?>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <i class="fa fa-user"></i>ข้อมูลส่วนตัว</a>
                  </li>
                  <li><a href="../../system/signout.php">
                    <i class="fa fa-sign-out"></i>ออกจากระบบ</a>
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
            <div style="padding-top: 10px; font-size: 1.3em; text-align:left; color: #888; padding-left: 0px;">
            <font color="#06c" style="font-size: 1.0em; font-weight: light;"><strong>DMIS U-tapao cathment</strong></font> : <small><?php print $resultUserInfo[0]['inst_name']; ?></small>
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
              <li class="dropdown"><a data-toggle="dropdown" href="#" class="current">
                <span aria-hidden="true" class="se7en-pages"></span>เพิ่มข้อมูล<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="management.php">บัญชีผู้ใช้งาน</a>
                  </li>
                  <?php
                  if($resultUserInfo[0]['institute_id']=='01'){
                    ?>
                    <li>
                      <a href="management_marker.php">หมุดประเภทอื่นๆ</a>
                    </li>
                    <?php
                  }
                  ?>
                </ul>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-tables"></span>ตารางข้อมูล<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="tables.html">การร้องขอ</a>
                  </li>
                  <li>
                    <a href="datatables.html">การเข้าใช้งานระบบ</a>
                  </li>
                </ul>
              </li>
              <li><a href="charts.html">
                <span aria-hidden="true" class="se7en-charts"></span>รายงาน</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            เพิ่มข้อมูลหมุด
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumb">
              <li>
                <a href="index.php"></a><i class="fa fa-home"></i>
              </li>
              <li class="active">
                เพิ่มข้อมูลหมุด
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

                <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>เพิ่มหมุดอื่นๆ</span></a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab2"><i class="fa fa-table"></i><span>รายการหมุด</span></a>
                  </li>
                </ul>
              </div>
              <div class="tab-content padded" id="my-tab-content">
                <div class="tab-pane active" id="tab1">
                  <p>
                  </p>
                  <form name="regisuser" id="regisuser" class="form-horizontal">
                  <div class="row">
                    <div class="col-md-6">
                      <h3>
                        ข้อมูลเบื้องต้น
                      </h3>
                      <div class="row">
                        <div class="form-group">
                          <label class="control-label col-md-2">ประเภทสถานที่</label>
                          <div class="col-md-9">
                            <select class="form-control" name="prefix" id="prefix">
                              <option value="01" selected="">ศูนย์ประสานงานช่วยเหลือผู้ประสบภัย</option>
                              <option value="02">บ้านพี่เลี้ยง</option>
                            </select>
                          </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-2">ชื่อสถานที่ <span class="req" id="req1">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" placeholder="กรอกชื่อ" type="text" name="txtName" id="txtName">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-2">หมายเลขโทรศัพท์ <span class="req" id="req3">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" placeholder="กรอกgเฉพาะตัวเลข" type="text"  name="txtPhone" id="txtPhone">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-2">ที่อยู่</label>
                            <div class="col-md-9">
                              <textarea name="address" id="address" rows="4" cols="40" class="form-control"></textarea>
                            </div>
                          </div>
                      </div>

                      <h3>
                        ข้อมูลบัญชีผู้ใช้/หัวหน้า/ผู้ดูแลศูนย์
                      </h3>
                      <div class="row">

                        <div class="form-group">
                          <label class="control-label col-md-2">ชื่อบัญชีผู้ใช้<br>Username</label>
                          <div class="col-md-9">
                            <input class="form-control"  type="text"  name="username" id="username">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2">รหัสผ่าน<br>Password</label>
                          <div class="col-md-9">
                            <input class="form-control"  type="password" name="password" id="password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2">ยืนยันรหันผ่าน<br>Confirm password</label>
                          <div class="col-md-9">
                            <input class="form-control"  type="password" name="password2" id="password2">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2">&nbsp;</label>
                          <div class="col-md-9">
                            <button type="submit" name="btnSaveuser" id="btnSaveuser" class="btn btn-primary" style="width: 100%;">บันทึกข้อมูล</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End col lg 5 -->
                    <div class="col-lg-6">
                      <div class="row" style="padding-top: 50px;">
                        <div class="form-group">
                          <label class="control-label col-md-2">พิกัดละติจูด</label>
                          <div class="col-md-8">
                            <input class="form-control"  type="text"  name="username" id="username">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2">พิกัดลองติจูด</label>
                          <div class="col-md-8">
                            <input class="form-control"  type="text"  name="username" id="username">
                          </div>
                        </div>
                        <h3>แผนที่</h3>
                        <div class="col-lg-12" style="height: 400px; background: #ccc;" id="map-canvas2">
                        </div>
                      </div>
                    <hr>
                  </div>
                  <!-- End row -->
                </div>
                </form>

            </div>

            <!-- End tab1 -->
            <div class="tab-pane" id="tab2">
              <h3>
                บัญชีผู้ใช้งาน
              </h3>
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="widget-container fluid-height clearfix"> -->
                    <!-- <div class="widget-content padded clearfix"> -->
                      <div class="row">
                        <div class="col-md-12">
                          <!-- <div class="widget-container fluid-height clearfix"> -->
                            <div class="heading">
                              <i class="fa fa-table"></i>รายนาม
                            </div>
                            <div class="widget-content padded clearfix">
                              <!-- Data table -->
                              <div class="table-responsive">
                              <table class="table table-bordered table-striped" id="dataTable1">
                                  <thead>
                                    <th class="check-header hidden-xs">
                                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                                    </th>
                                    <th>
                                       </th>
                                    <th>
                                      ชื่อ - สกุล
                                    </th>
                                    <th class="hidden-xs">
                                      หมายเลขโทรศัพท์
                                    </th>
                                    <th class="hidden-xs">
                                      ประเภทบัญชีผู้ใช้
                                    </th>
                                    <th class="hidden-xs">
                                      Status
                                    </th>
                                    <th></th>
                                  </thead>
                                  <tbody>

                                    <?php
                                    $strSQL = sprintf("SELECT * FROM ".$prefix."user a inner join ".$prefix."userinformation b on a.username = b.username
                                              inner join ".$prefix."prefix c on b.usr_prefix = c.id_prefix
                                              inner join ".$prefix."institute d on a.institute_id = d.inst_id
                                              inner join ".$prefix."usertype e on a.usertype_id = e.usertype_id
                                              WHERE a.usertype_id != '01' and a.institute_id in (SELECT institute_id FROM ".$prefix."user WHERE username = '%s' )",mysql_real_escape_string($_SESSION[$sessionName.'sessUsername']));
                                    $resultUserlist = $db->select($strSQL,false,true);
                                    if($resultUserlist){
                                      $c = 1;
                                      foreach($resultUserlist as $v){
                                        ?>
                                        <tr>
                                          <td class="check hidden-xs">
                                            <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                          </td>
                                          <td>
                                            <?php print $c; ?>
                                          </td>
                                          <td>
                                            <?php print $v['prefix_name'].$v['usr_fname']." ".$v['usr_lname']; ?>
                                          </td>
                                          <td class="hidden-xs">
                                            <?php print $v['usr_phone']; ?>
                                          </td>
                                          <td class="hidden-xs">
                                            <?php print $v['usertype_desc_th'] ?>
                                          </td>
                                          <td class="hidden-xs">
                                            <?php
                                            if($v['active_status']=='Yes'){
                                              ?><span class="label label-success">อนุญาต</span><?php
                                            }else{
                                              ?><span class="label label-danger">ไม่อนุญาต</span><?php
                                            }
                                            ?>

                                          </td>
                                          <td class="actions">
                                            <div class="action-buttons">
                                              <a class="table-actions" href=""><i class="fa fa-eye"></i></a><a class="table-actions" href=""><i class="fa fa-pencil"></i></a><a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                                            </div>
                                          </td>
                                        </tr>
                                        <?php
                                        $c++;
                                      }
                                    }else{
                                      print $strSQL;
                                    }
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                                <!-- End ata table -->
                            </div>
                        <!-- </div> -->
                      </div>
                    </div>
                    <!-- </div> -->
                  <!-- </div> -->
                  <!-- End col-md-6 -->
              </div>
              <!-- End row -->
            </div>
            <!-- End tab2 -->
          </div>
        </div>
        <!-- End row -->

      </div>
      <p>
        &nbsp;
      </p>

      <div class="row">
        <div class="col-lg-12" style="text-align: center;">
          A Prototype of Disaster Data Management System in the U-Tapao Cathment using Google Map - http://ictcluster.sci.psu.ac.th/dmis
<br>สาขาเทคโนโลยีสารสนเทศและการสื่อสาร คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์, Research and Development Office (RDO)
        </div>
      </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAewI1LswH0coZUPDe8Pvy39j4sbxmgCZU&callback=initMap" async defer></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#regisuser').submit(function(){
          var check = 0;
          $('.form-control').removeClass('has-error');

          if($('#txtName').val()==''){
            $('#txtName').addClass('has-error');
            check++;
          }

          if($('#txtLName').val()==''){
            $('#txtLName').addClass('has-error');
            check++;
          }

          if($('#txtPhone').val()==''){
            $('#txtPhone').addClass('has-error');
            check++;
          }

          if($('#username').val()==''){
            $('#username').addClass('has-error');
            check++;
          }

          if($('#password').val()==''){
            $('#password').addClass('has-error');
            check++;
          }

          if($('#password2').val()==''){
            $('#password2').addClass('has-error');
            check++;
          }

          if($('#password').val()!=$('#password2').val()){
            $('#password').addClass('has-error');
            $('#password2').addClass('has-error');
            check++;
          }

          if(check!=0){
            swal("เกิดข้อผิดพลาด!", "กรุณากรอกข้อมูลให้ครบถ้วน!", "warning")
            return false;
          }else{
            $.post("system/registuser.php", {
              username: $('#username').val(),
              password: $('#password').val(),
              name: $('#txtName').val(),
              lname: $('#txtLName').val(),
              phone: $('#txtPhone').val(),
              address: $('#address').val(),
              email: $('#txtEmail').val(),
              prefix: $('#prefix').val(),
              type: $('#type').val()
              },
              function(result){
                if(result=='Y'){
                  // swal("บันทึกข้อมูลเรียบร้อย!", "คลิ๊ก OK เพื่อกลับสู่หน้าหลัก!", "success");
                  swal({
                    title: "บันมึกข้อมูลเรียบร้อย",
                    text: "คลิ๊ก OK เพื่อรีโหลดข้อมูล",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK!",
                     closeOnConfirm: false
                   }, function(){
                     window.location = 'management.php';
                   });
                }else{
                  swal("ขออภัย!", "การบันทึกข้อมูลล้มเหลว!", "warning");
                  // swal("ขออภัย!", result, "warning");
                }
              }
            );
            return false;
          } //End else

          return false;
        });
      });
    </script>
    <!-- <script type="text/javascript">
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
    </script> -->
  </body>
</html>
