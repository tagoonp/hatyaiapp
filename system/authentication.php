<?php
session_start();
require ("../database/connect.class.php");
$db = new database();
$db->connect();

require ("../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

// function for checking user account //
// $strSQL = sprintf("SELECT * FROM ".$prefix."user WHERE username = '%s' and active_status = '%s'",mysql_real_escape_string($_POST['username']),mysql_real_escape_string('Yes'));
$strSQL = sprintf("SELECT * FROM ".$prefix."user WHERE username = '%s' and password = '%s' and active_status = '%s'",mysql_real_escape_string($_POST['username']),mysql_real_escape_string(md5($_POST['password'])),mysql_real_escape_string('Yes'));
$resultAuthen = $db->select($strSQL,false,true);

if($resultAuthen){
  // Verify password
  // if(password_verify($_POST['password'], $resultAuthen[0]['password'])){
    $_SESSION[$sessionName.'sessID'] = session_id();
  	$_SESSION[$sessionName.'sessUsername'] = $resultAuthen[0]['username'];
    $_SESSION[$sessionName.'sessUtype'] = $resultAuthen[0]['usertype_id'];
  	session_write_close();
    print "Y";
  // }else{
  //   print "N1";
  // }
}else{
  print "N";
  // print $strSQL;
}

$db->disconnect();



?>
