<?php
 //include('sessions.php');
 require('mysql.php');
 $SelectUsersQry = "SELECT `ID`, `Name` FROM `Users`";
 $SelectPetsQry = "SELECT `P`.`ID` `ID`, `P`.`Age` `Age`, `P`.`Name` `Name`, `P`.`Type` `Type` FROM `Pets` `P` INNER JOIN `Users_has_Pets` `UhP` ON `UhP`.`Pets_ID` = `P`.`ID` WHERE `UhP`.`Users_ID` = ?";
 $db = new MySQL();
     ?>
     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
         <head>
             <meta http-equiv="content-type" content="text/html;charset=utf-8" />
             <link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
             <title>Constancias Eventos</title>
         </head>
         <body>
             <div id="wrapper">
                 <div id="header">
                     <div id="logo">
                         <h1><a href="index.html">Examen 3</a></h1>
                     </div>
                     <div class="clr"></div>
                 </div>
                 <form class="content" name="surf" method="post">
                     <!--ul id="menu">
                         <li><label class="username" name="username">< ?php echo utf8_decode(Cryptex::decrypt($_SESSION['Username'])).' '.utf8_decode(Cryptex::decrypt($_SESSION['Birthname']));?></label></li>
                         <li><button type="submit" class="signin" name="logout" value="logout" formaction="logout.php">Salir</button></li>
                     </ul-->
                     <div id="pitch">
                         <h1>Adopción de mascotas</h1>
                         <p><em></em></p>
                     </div>
                     <?php
 $stmt = $db->prepare($SelectUsersQry);
 //$stmt->bind_param('');
 $stmt->execute();
 $result = $stmt->get_result();
 while ($User = $result->fetch_assoc()) {
     ?>
<div class="col">
   <input class="signin" type="submit" name="user" formaction="adopted.php" value="<?php echo $User['ID']; ?>"> <?php echo $User['Name']; ?>
   <!--/button-->
</div>
<?php
 }
 $result->free();
 $stmt->close();
 if (isset($_POST['user'])) {
     $User = $_REQUEST['user'];
     $stmt = $db->prepare($SelectPetsQry);
     $stmt->bind_param('i', $User);
     $stmt->execute();
     $result = $stmt->get_result();
     while ($Pet = $result->fetch_assoc()) {
         ?>
                       <div class="col">
                          <input class="" type="text" name="pet" value="<?php echo $Pet['ID'].' '.$Pet['Age'].' '.$Pet['Name'].' '.$Pet['Type']; ?>" readonly>
                          <!--/button-->
                       </div>
                       <?php
     }
     $result->free();
     $stmt->close();
 }
                       $db->close();
                       ?>
                     </form>
             </div>
         </body>
     </html>