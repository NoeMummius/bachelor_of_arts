<?php
 require('mysql.php');
 $name = $_REQUEST['name'];
 $type = $_REQUEST['type'];
 $desc = $_REQUEST['desc'];
 $sdate = $_REQUEST['sdate'];
 $stime = $_REQUEST['stime'];
 $edate = $_REQUEST['edate'];
 $etime = $_REQUEST['etime'];
 $db = new MySQL();
 $InsertAttachmentQry ="INSERT INTO `Attachments` (`Name`, `Type`, `Desc`, `S_date`, `S_time`, `E_date`, `E_time`) VALUES (?, ?, ?, DATE(?), TIME(?), DATE(?), TIME(?))";
 $stmt = $db->prepare($InsertAttachmentQry);
 $stmt->bind_param('sssssss', $name, $type, $desc, $sdate, $stime, $edate, $etime);
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