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

$strSQL = sprintf("SELECT * FROM ".$prefix."institute WHERE inst_status = '%s' ",mysql_real_escape_string('Yes'));
$result = $db->select($strSQL,false,true);

	$return = '';
	for($i=0;$i<count($result);$i++){
		$return[$i]['inst_id'] = $result[$i]['inst_id'];
		$return[$i]['inst_name'] = $result[$i]['inst_name'];
		$return[$i]['inst_lat'] = $result[$i]['inst_lat'];
		$return[$i]['inst_lng'] = $result[$i]['inst_lng'];
	}

	echo json_encode($return);
	$db->disconnect();
?>
