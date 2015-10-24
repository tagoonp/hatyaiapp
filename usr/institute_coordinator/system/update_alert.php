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

$strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_id = '%s' ",mysql_real_escape_string($_POST['pid']));
$resultCheckstage = $db->select($strSQL,false,true);

if($resultCheckstage){
  $strSQL = sprintf("UPDATE ".$prefix."alert SET alt_stage = '%s' WHERE alt_id = '%s'",mysql_real_escape_string($_POST['nextStat']),mysql_real_escape_string($_POST['pid']));
  $resultUpdate = $db->update($strSQL);

  $strSQL = "INSERT INTO ".$prefix."transection VALUE ('','".date('Y-m-d')."','".date('H:i:s')."','".$_POST['user']."','".$_SESSION[$sessionName.'sessUsername']."','".$_POST['nextStat']."','".$_POST['pid']."') ";
  $resultInsert = $db->insert($strSQL,false,true);

  print "Y";
}else{
  // ไม่พบรายการดังกล่าว
  print "N1";
}

$db->disconnect();
?>
