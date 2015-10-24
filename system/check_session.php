<?php
if(isset($_SESSION[$sessionName.'sessUsername'])){
  if($_SESSION[$sessionName.'sessID']!=session_id()){
    // Session timeout
    header('Location: ../../session_timeout.html');
    exit();
  }
}else{
  // Session timeout
  header('Location: ../../session_timeout.html');
  exit();
}
?>
