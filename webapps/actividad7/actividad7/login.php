<?php
 require('mysql.php');
 require('cryptex.php');
 $header = "#";
  if (isset($_POST['Username']) && isset($_POST['Password'])) {
      $Username = $_REQUEST['Username'];
      $Password = $_REQUEST['Password'];
      echo 'Something';
      $db = new MySQL();
      $Cryptkey = $db->getCryptkey();
      $SelectUserQry = "SELECT `U`.`ID` `ID`, CONCAT(`U`.`Lastnames`, ', ', `U`.`Names`) `Birthname`, `U`.`Role` `Role` FROM `Users` `U` WHERE `U`.`ID` = ? AND `U`.`Password` = AES_ENCRYPT(?, ?)";
      $stmt = $db->prepare($SelectUserQry);
      $stmt->bind_param('sss', $Username, $Password, $Cryptkey);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($Urow = $result->fetch_assoc()) {
          session_start();
          $_SESSION['Username'] = Cryptex::encrypt($Urow['ID']);
          $_SESSION['Role'] = Cryptex::encrypt($Urow['Role']);
          $_SESSION['Birthname'] = Cryptex::encrypt(utf8_encode($Urow['Birthname']));
          if (strcmp($Urow['Role'], 'Manager') == 0) {
              $header = 'Location: dashboard.php';
          } elseif (strcmp($Urow['Role'], 'Attendant') == 0) {
              $header = 'Location: surf.php';
          }
          $stmt->free_result();
          $stmt->close();
      } else {
          $header = 'Location: '.$_SERVER['HTTP_REFERER'];
      }
      $db->close();
      header($header);
      die();
  } else {
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
                          <h1><a href="index.html">Generador de Constancias de Eventos</a></h1>
                      </div>
                      <div class="clr"></div>
                  </div>
                  <form name="login" method="POST">
                      <div class="login">
                          <div class="fields-container">
                              <input type="text" name="Username" placeholder="Usuario">
                              <input type="password" name="Password" placeholder="Contaseña">
                           </div>
                           <div class="buttons-container">
                              <button type="submit" class="signin" value="signin" formaction="login.php">Entrar</button>
                              <button type="submit" class="signup" value="signup" formaction="signup.php">Registrarse</button>
                           </div>
                        </div>
                  </form>
              </div>
          </body>
      </html>
<?php
  }
?>