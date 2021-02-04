<?php
 require('mysql.php');
 $id = $_REQUEST['Username'];
 $name = $_REQUEST['Password'];
 $db = new MySQL();
 $UpdateUserQry = "UPDATE `Users` SET `ID` = ?, `Password` = AES_ENCRYPT(?, ?) WHERE `ID` = ?";
 $stmt = $db->prepare($SelectUserQry);
 $stmt->bind_param('s', $Username);
 $result = $stmt->execute();
 if($result)
 {
     $header = 'surf.php?upload='.$result;
 }
 else
 {
     $header = $_SERVER['HTTP_REFERER'];
 }
 $db->close();
 header('Location: '.$header);
 die();
?>