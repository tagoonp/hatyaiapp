<?php
session_start();
require ("../../../database/connect.class.php");
$db = new database();
$db->connect();

require ("../../../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

date_default_timezone_set('Asia/Bangkok');

$strSQL = sprintf("SELECT * FROM ".$prefix."user WHERE username = '%s' and password = '%s' and active_status = '%s'",mysql_real_escape_string($_SESSION[$sessionName.'sessUsername']),mysql_real_escape_string(md5($_POST['pwd'])),mysql_real_escape_string('Yes'));
$resultAuthen = $db->select($strSQL,false,true);

if($resultAuthen){
  // Verify password
  // if(password_verify($_POST['pwd'], $resultAuthen[0]['password'])){
    // Password checking success
    $strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_phone = '%s' and alt_stage in ('1','2','3')",mysql_real_escape_string($_POST['phone']));
    $resultCheckstage = $db->select($strSQL,false,true);

    if($resultCheckstage){

    }else{
      // Insert new record
      $msg = sprintf($_POST['need_other']);

      $food = $_POST['food'];
      $drug = $_POST['drug'];
      $other = $_POST['other'];

      if($_POST['need_other']!=''){
        $other = 'Yes';
      }

      $strSQL = "INSERT INTO ".$prefix."alert (alt_date_ent, alt_time_ent, alt_phone, alt_name, alt_level, alt_food, alt_drug, alt_other, alt_other_msg, alt_place, alt_lat, alt_lng, alt_username)
                VALUE
                ('".date('Y-m-d')."','".date('H:i:s')."','".$_POST['phone']."','".$_POST['name']."','".$_POST['level']."','".$food."','".$drug."','".$other."','".$msg."','".$_POST['place_detail']."','".$_POST['lat']."','".$_POST['lng']."','".$_SESSION[$sessionName.'sessUsername']."')";
      $resultInsert2 = $db->insert($strSQL,false,true);

      if($resultInsert2){
        print "Y";
      }else{
        print "N";
      }
    }


  // }else{
  //   //Incorrect password
  //   print "N1";
  // }
}else{
  // User invalid
  print "N2";
  // print $strSQL;
}

$db->disconnect();
?>
