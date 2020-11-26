<?php
 require('mysql.php');
 $Attachment = $_REQUEST['attachment'];
 $Attendant = $_REQUEST['attendant'];
 $db = new MySQL();
 $UpdateAttachmentQry ="DELETE FROM `Tickets` WHERE `Attachment` = ? AND `Attendant` = ?";
 $stmt = $db->prepare($UpdateAttachmentQry);
 $stmt->bind_param('ii', $Attachment, $Attendant);
 $result = $stmt->execute();
 if($result)
 {
     $stmt->close();
     $header = 'surf.php?cancel='.$result;
 }
 else
 {
     $header = $_SERVER['HTTP_REFERER'];
 }
 $db->close();
 header('Location: '.$header);
 die();
?>