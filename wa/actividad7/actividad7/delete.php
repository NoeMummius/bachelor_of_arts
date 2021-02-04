<?php
 require('mysql.php');
 $id = $_REQUEST['id'];
 $db = new MySQL();
 $DeleteTicketsQry = "DELETE FROM `Tickets` WHERE `Attachment` = ?";
 $DeleteAttachmentQry ="DELETE FROM `Attachments` WHERE `ID` = ?";
 $stmt = $db->prepare($DeleteTicketsQry);
 $stmt->bind_param('i', $id);
 $result = $stmt->execute();
 if($result)
 {
    $stmt->close();
    $stmt = $db->prepare($DeleteAttachmentQry);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if($result)
    {
        $header = 'dashboard.php?delete='.$result;
    }
    else
    {
        $header = $_SERVER['HTTP_REFERER'];
    }
 }
 else
 {
     $header = $_SERVER['HTTP_REFERER'];
 }
 $db->close();
 header('Location: '.$header);
 die();
?>