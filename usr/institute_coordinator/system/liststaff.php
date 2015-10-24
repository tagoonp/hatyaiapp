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
$instituteID = $_POST['institute_id'];

if($instituteID==''){
  $strSQL = sprintf("SELECT * FROM ".$prefix."user a inner join ".$prefix."userinformation b on a.username = b.username inner join ".$prefix."prefix c on b.usr_prefix = c.id_prefix inner join ".$prefix."institute d on a.institute_id=d.inst_id WHERE a.usertype_id in ('04') ");
}else{
  $strSQL = sprintf("SELECT * FROM ".$prefix."user a inner join ".$prefix."userinformation b on a.username = b.username inner join ".$prefix."prefix c on b.usr_prefix = c.id_prefix inner join ".$prefix."institute d on a.institute_id=d.inst_id WHERE a.institute_id = '%s' and a.usertype_id in ('04') ",mysql_real_escape_string($instituteID));
}

$result = $db->select($strSQL,false,true);

?>
<table class="table table-hover">
  <thead>
    <th>
      #
    </th>
    <th>
      ชือผู้ประสาน
    </th>
    <th class="hidden-xs">
      ตำแหน่ง
    </th>
    <th class="hidden-xs">
      หน่วยงาน
    </th>
    <th>
      หมายเลขโทรศัพท์
    </th>
    <th class="hidden-xs">
      สถานะปัจจุบัน
    </th>
    <th>
      &nbsp;
    </th>
  </thead>
  <tbody>
  <?php
  if($result){
    $c = 1;
    foreach($result as $v){
      ?>
        <tr>
          <td>
            <?php print $c; ?>
          </td>
          <td>
            <?php print $v['prefix_name'].$v['usr_fname']." ".$v['usr_lname']; ?>
          </td>
          <td>
            <?php
            switch($v['usertype_id']){
              case '02': print "หัวหน้าหน่วยงาน";break;
              case '03': print "ผู้ประสานงานประจำหน่วย"; break;
              case '04': print "ผู้ประสานงานภาคสนาม"; break;
            }
            ?>
          </td>
          <td>
            <?php print $v['inst_name']; ?>
          </td>
          <td>
            <?php print $v['usr_phone']; ?>
          </td>
          <td class="hidden-xs">
            -
          </td>
          <td class="hidden-xs">
            <a href="javascript: assignWork('<?php print $v['username']; ?>','<?php print $v['prefix_name'].$v['usr_fname']." ".$v['usr_lname']; ?>')">
              <span class="label label-success">มอบหมาย</span>
            </a>
          </td>
        </tr>
      <?php
      $c++;
    }
  }else{
    ?>
    <tr>
      <td colspan="5">
        ไม่พบข้อมูลผู้ประสานงาน
        <?php //print $strSQL; ?>
      </td>
    </tr>
    <?php

  }
  ?>
</tbody>
</table>
