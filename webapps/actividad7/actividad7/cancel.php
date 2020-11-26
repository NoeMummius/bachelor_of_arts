<?php
 require('mysql.php');
 $Attachment = $_REQUEST['attachment'];
 $Attendant = Cryptex::decrypt($_SESSION['Username']);
 $db = new MySQL();
 $UpdateAttachmentQry ="DELETE FROM `Tickets` WHERE `Attendat` = ? AND `Attachment` = ?";
 $stmt = $db->prepare($UpdateAttachmentQry);
 $stmt->bind_param('ii', $id, $id);
 $result = $stmt->execute();
 if($result)
 {
     $header = 'surf.php?delete='.$result;
 }
 else
 {
     $header = $_SERVER['HTTP_REFERER'];
 }
 $db->close();
 header('Location: '.$header);
 die();
?>