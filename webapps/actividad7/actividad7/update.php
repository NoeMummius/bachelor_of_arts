<?php
 require('mysql.php');
 $id = $_REQUEST['id'];
 $name = $_REQUEST['name'];
 $type = $_REQUEST['type'];
 $desc = $_REQUEST['desc'];
 $sdate = $_REQUEST['sdate'];
 $stime = $_REQUEST['stime'];
 $edate = $_REQUEST['edate'];
 $etime = $_REQUEST['etime'];
 $db = new MySQL();
 $UpdateAttachmentQry ="UPDATE `Attachments` SET `Name` = ?, `Type` = ?, `Desc` = ?, `S_date` = DATE(?), `S_time` = TIME(?), `E_date` = DATE(?), `E_hour` = TIME(?) WHERE `ID` = ?";
 $db->prepare($UpdateAttachmentQry);
 $stmt->bind_param('sssssssi', $name, $type, $desc, $sdate, $stime, $edate, $etime, $id);
 $result = $stmt->execute();
 if($result)
 {
     $header = 'dashboard.php?upload='.$result;
 }
 else
 {
     $header = $_SERVER['HTTP_REFERER'];
 }
 $db->close();
 header('Location: '.$header);
 die();
?>