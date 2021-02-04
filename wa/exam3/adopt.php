<?php
 require('mysql.php');
 $User = $_REQUEST['user'];
 $Pet = $_REQUEST['pet'];
 $SelectAdopterQry = "SELECT IF(COUNT(`UhP`.`Pets_ID`) <= 2, `U`.`ID`, NULL) `User` FROM `Users` `U` LEFT JOIN `Users_has_Pets` `UhP` ON `U`.`ID` = `UhP`.`Users_ID` WHERE `U`.`ID` = ?";
 $InsertAdoptQry = "INSERT INTO `Users_has_Pets` (`Users_ID`, `Pets_ID`) VALUES (?, ?)";
 $db = new MySQL();
 $stmt = $db->prepare($SelectAdopterQry);
 $stmt->bind_param('i', $User);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($Adopter = $result->fetch_assoc()) {
     echo $Adopter['User'];
     $result->free_result();
     $stmt->close();
     $stmt = $db->prepare($InsertAdoptQry);
     $stmt->bind_param('ii', $User, $Pet);
     $stmt->execute();
     $stmt->close();
 }
 $db->close();
?>