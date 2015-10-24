<?php
date_default_timezone_set('Asia/Bangkok');

require ("../../../database/connect.class.php");
$db = new database();
$db->connect();

require ("../../../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

$pid = '';
if(isset($_GET['placeID'])){
  $pid = $_GET['placeID'];
}

$strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_id = '%s' ",mysql_real_escape_string($pid));
$result = $db->select($strSQL,false,true);

?>

<style media="screen">
.required{
  border-color: red;
  background: #FFBCB2;
}
</style>

<body>
    <table width="270" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style=" color: #06c;padding-top: 15px;" align="center" >
          <table width="270" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55" align="left" >
                <img src="../../images/map-icon.png" alt="" width="40" />
              </td>
              <td align="left" valign="center" style="font-size: 1.5em;">
                <?php
                print $result[0]['alt_phone'];
                ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 20px; padding-left: 10px;">
          <strong>ผู้แจ้ง</strong> : <span class="cont"><?php print $result[0]['alt_name']; ?></span>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 10px; padding-left: 10px;">
          <table width="270" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="left" >
                <strong>ความต้องการ</strong>
              </td>
              <td align="left" valign="center" style="">
                <span class="cont" style="padding-left: 0px;">
                  <?php
                  if($result[0]['alt_food']=='Yes'){ print "- อาหาร<br>";}
                  if($result[0]['alt_drug']=='Yes'){ print "- ยารักษาโรค<br>";}
                  ?>
                </span>
              </td>
            </tr>
            <tr>
              <td width="100" align="left" style="padding-top: 0px;" valign="top" colspan="2">
                <strong>อื่นๆ : </strong> <?php  print $result[0]['alt_other_msg']; ?>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                &nbsp;
              </td>
            </tr>
            <tr>
              <td width="100" align="left" style="padding-top: 0px;" valign="top" colspan="2">
                <strong>วันที่-เวลา : </strong> <?php  print $result[0]['alt_date_ent']." ".$result[0]['alt_time_ent']; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 20px;">
          <div class="" style="padding-left:55px;">
            <button type="button" name="btnLogin" id="btnLogin" class="ms-btn btn-ms-primary" style="width:200px;" onclick="redirect('operation.php?req_id=<?php print $pid;?>')">ดำเนินการ</button>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          &nbsp;
        </td>
      </tr>
      <tr>
        <td width="100" align="left" style="padding-top: 0px;" valign="top" colspan="2">
          <strong>ช่องทางการร้องขอ : </strong>
          <?php
            switch($result[0]['alt_chanal']){
              case 'Phone': print "โทรแจ้งศูนย์ประสานงาน"; break;
              case 'Application': print "แจ้งผ่านโปรแกรมบนมือถือ"; break;
              default: print "ไม่ทราบแหล่งที่มา";
            }
            ?>
        </td>
      </tr>
      <?php
      if($result[0]['alt_chanal']=="Phone"){
        ?>
        <tr>
          <td width="100" align="left" style="padding-top: 0px;" valign="top" colspan="2">
            <strong>ผู้รับเรื่อง : </strong>
            <?php
              print $result[0]['alt_username'];
            ?>
          </td>
        </tr>
        <?php
      }
      ?>
      <tr>
        <td colspan="2">
          &nbsp;
        </td>
      </tr>
    </table>
</body>
