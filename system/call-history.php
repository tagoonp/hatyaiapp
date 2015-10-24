<?php
session_start();
require ("../database/connect.class.php");
$db = new database();
$db->connect();

require ("../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

date_default_timezone_set('Asia/Bangkok');

$strSQL = sprintf("SELECT * FROM ".$prefix."transection WHERE 1 ");
$result = $db->select($strSQL,false,true);

	$return = '';
	for($i=0;$i<count($result);$i++){
		$return[$i]['tr_id'] = $result[$i]['tr_id'];
	}

	echo json_encode($return);
	$db->disconnect();
?>
