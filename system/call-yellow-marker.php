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

$strSQL = sprintf("SELECT * FROM ".$prefix."alert WHERE alt_stage = '%s' ",mysql_real_escape_string(2));
$result = $db->select($strSQL,false,true);

	$return = '';
	for($i=0;$i<count($result);$i++){
		$return[$i]['alt_id'] = $result[$i]['alt_id'];
		$return[$i]['alt_date_ent'] = $result[$i]['alt_date_ent'];
		$return[$i]['alt_time_ent'] = $result[$i]['alt_time_ent'];
		$return[$i]['alt_lat'] = $result[$i]['alt_lat'];
		$return[$i]['alt_lng'] = $result[$i]['alt_lng'];
		$return[$i]['alt_place'] = $result[$i]['alt_place'];
		$return[$i]['alt_other_msg'] = $result[$i]['alt_other_msg'];
		$return[$i]['alt_level'] = $result[$i]['alt_level'];
    $return[$i]['alt_chanal'] = $result[$i]['alt_chanal'];
	}

	echo json_encode($return);
	$db->disconnect();
?>
