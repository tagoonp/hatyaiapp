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


$strSQL = sprintf("SELECT * FROM ".$prefix."user WHERE username = '%s' and active_status = '%s'",mysql_real_escape_string($_SESSION[$sessionName.'sessUsername']),mysql_real_escape_string('Yes'));
$resultAuthen = $db->select($strSQL,false,true);

if($resultAuthen){
  $strSQL = sprintf("SELECT * FROM ".$prefix."user WHERE username = '%s' ",mysql_real_escape_string($_POST['username']));
  $resultCheck1 = $db->select($strSQL,false,true);

  if(!$resultCheck1){
      $strSQL = "INSERT INTO ".$prefix."user VALUE ('".$_POST['username']."','".md5($_POST['password'])."','".$_POST['email']."','Yes','".$resultAuthen[0]['institute_id']."','".$_POST['type']."','') ";
      $resultInsert = $db->insert($strSQL,false,true);

      $strSQL = "INSERT INTO ".$prefix."userinformation VALUE ('','".$_POST['prefix']."','".$_POST['name']."','".$_POST['lname']."','".$_POST['phone']."','".$_POST['address']."','','','".date('Y-m-d')."','".$_POST['username']."') ";
      $resultInsert = $db->insert($strSQL,false,true);
      print "Y";
  }else{
    print "Duplicate";
  }
}else{
  // User invalid
  print "N2";
  // print $strSQL;
}

$db->disconnect();
?>
