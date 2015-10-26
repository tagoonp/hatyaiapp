<?php
$strSQL = sprintf("SELECT * FROM ".$prefix."user a inner join ".$prefix."userinformation b on a.username = b.username
          inner join ".$prefix."prefix c on b.usr_prefix = c.id_prefix
          inner join ".$prefix."institute d on a.institute_id = d.inst_id
          inner join ".$prefix."usertype e on a.usertype_id = e.usertype_id
          WHERE a.username = '%s'",mysql_real_escape_string($_SESSION[$sessionName.'sessUsername']));
$resultUserInfo = $db->select($strSQL,false,true);
if(!$resultUserInfo){

}
?>
