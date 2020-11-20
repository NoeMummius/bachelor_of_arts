<?php
 //include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 if(isset($_POST['birthdate']))
 {
   $Username = $_POST['username'];
   $Password = $_POST['password'];
   $Names = $_POST['names'];
   $Lastnames = $_POST['lastnames'];
   $Birthdate = $_POST['birthdate'];
   $db = new MySQL();
   $Cryptkey = $db->getCryptkey();
   $InsertAttendantQry = "INSERT INTO `Users` (`ID`, `Password`, `Role`, `Names`, `Lastnames`, `Birthdate`) VALUES (?, AES_ENCRYPT(?, ?), 'Attendant', ?, ?, DATE(?))";
   $stmt = $db->prepare($InsertAttendantQry);
   $stmt->bind_param('ssssss', $Username, $Password, $Cryptkey, $Names, $Lastnames, $Birthdate);
   $result = $stmt->execute();
   if($result)
   {
     session_start();
     $_SESSION['Username'] = Cryptex::encrypt($Username);
     $_SESSION['Birthname'] = Cryptex::encrypt($Names.' '.$Lastnames);
     $header = 'surf.php';
     $stmt->close();
     $db->close();
     header('Location: '.$header);
   }
   else{
     echo '<script type="text/javascript">alert("Error durante el registro: "'.$stmt->error.');</script>';
   }
 }
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
					<h1>Actualizar perfil</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="form" name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="username" placeholder="Nombre" required></li>
					<li><input type="text" name="password" placeholder="Contraseña" required></li>
					<li><input type="text" name="names" placeholder="Nombres"></li>
					<li><input type="text" name="lastnames" placeholder="Apellidos"></li>
					<li><input type="date" name="birthdate" placeholder="<?php echo date('mm / dd / yyyy');?>" required></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="signup.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="surf.php" class="dismiss"></button><li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
	</body>
</html>