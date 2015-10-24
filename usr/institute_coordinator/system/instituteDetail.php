<?php
date_default_timezone_set('Asia/Bangkok');

require ("../../../database/connect.class.php");
$db = new database();
$db->connect();

require ("../../../configuration/config.class.php");
$conf = new Config();
$prefix = $conf->getPrefix();
$sessionName = $conf->getSessionname();

$instituteID = '';
if(isset($_GET['instituteID'])){
  $instituteID = $_GET['instituteID'];
}

$strSQL = sprintf("SELECT * FROM ".$prefix."institute WHERE inst_id = '%s' ",mysql_real_escape_string($instituteID));
$result = $db->select($strSQL,false,true);

?>

<style media="screen">
.required{
  border-color: red;
  background: #FFBCB2;
}
</style>
<head>
  <link rel="stylesheet" href="../../core/css/master.css" media="screen" charset="utf-8">
</head>
<body>
    <table width="270" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style=" color: #06c;padding-top: 5px;" align="center" >
          <table width="270" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55" align="left" >
                <img src="../../images/institute.png" alt="" width="40" />
              </td>
              <td align="left" valign="center" style="font-size: 1.5em;">
                <?php
                print $result[0]['inst_name'];
                ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
</body>
