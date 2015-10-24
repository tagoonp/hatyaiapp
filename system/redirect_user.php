<?php
session_start();

require ("../database/connect.class.php");
$db = new database();
$db->connect();

require ("../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

if(isset($_SESSION[$sessionName.'sessID'])){
  switch($_SESSION[$sessionName.'sessUtype']){
    case 1: header('Location: ../usr/administrator/'); break;
    case 2: header('Location: ../usr/leader/'); break;
    case 3: header('Location: ../usr/institute_coordinator/'); break;
    case 4: header('Location: ../usr/field_coordinator/'); break;
    case 5: header('Location: ../usr/common/'); break;
    default: header('Location: ../500-page.html'); break;
  }
}else{
  header('Location: signout.php');
  exit();
}
?>
