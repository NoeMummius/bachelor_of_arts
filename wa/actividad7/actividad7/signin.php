<?php
 require('mysql.php');
 require('cryptex.php');
 $header = "#";
  if (isset($_POST['username']) && isset($_POST['password'])) {
      $Username = $_REQUEST['username'];
      $Password = $_REQUEST['password'];
      $db = new MySQL();
      $Cryptkey = $db->getCryptkey();
      $SelectUserQry = "SELECT `U`.`ID` `ID`, CONCAT(`U`.`Lastnames`, ', ', `U`.`Names`) `Birthname`, `U`.`Role` `Role` FROM `Users` `U` WHERE `U`.`ID` = ? AND `U`.`Password` = AES_ENCRYPT(?, ?)";
      $SelectOwnerQry = "SELECT `O`.`ID` `ID`, `O`.`Name` `Birthname` FROM `Owners` `O` WHERE `O`.`ID` = ? AND `O`.`Password` = AES_ENCRYPT(?, ?)";
      $stmt = $db->prepare($SelectOwnerQry);
      $stmt->bind_param('sss', $Username, $Password, $Cryptkey);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($Qrow = $result->fetch_assoc()) {
          $header = 'Location: dashboard.php?User='.Cryptex::encrypt(utf8_decode($Qrow['ID'])).'Birthname='.Cryptex::encrypt(utf8_encode($Qrow['Birthname']));
      } else {
          $stmt->free_result();
          $stmt->close();
          $stmt = $db->prepare($SelectUserQry);
          $stmt->bind_param('sss', $Username, $Password, $Cryptkey);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($Qrow = $result->fetch_assoc()) {
              session_start();
              $_SESSION['Username'] = Cryptex::encrypt($Qrow['ID']);
              $_SESSION['Role'] = Cryptex::encrypt($Qrow['Role']);
              $_SESSION['Birthname'] = Cryptex::encrypt(utf8_encode($Qrow['Birthname']));
              if (strcmp($Qrow['Role'], 'Pollster') == 0) {
                  $header = 'Location: index.php';
              }
          } else {
              $header = 'Location: '.$_SERVER['HTTP_REFERER'];
          }
          $stmt->free_result();
          $stmt->close();
      }
      $db->close();
      header($header);
      die();
  } else {
      ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>FASP Institucional</title>
  <link rel="shortcut icon" href="ico/sesnsp.ico" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>
<div class="formulario">
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="http:\\facebook.com\BudhTech"><img
        src="img/budh_software_co_logo_gtp_103x65.png">Budh</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-center" href="instrucciones.html">Instrucciones
            <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item">
          <a class="nav-link waves-effect waves-light" href="http:\\ifei.mx">
            <i class="far fa-sun">IFEI</i>
          </a>
        </li>

        <!--li class="nav-item">
          <a class="nav-link" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-user"> Entrar</i>
          </a>
        </li-->
      </ul>
    </div>
  </nav>
  <!--/.Navbar -->

  <body>
    <form name="login" class="formulario" method="POST" action="login.php">
      <br>
      <br>
      <br>
      <br>
      <a href="http:\\www.gob.mx\sesnsp"><img src="img/SSyPC-SESNSP.jfif" class="mx-auto d-block"></a>
      <br>
      <br>
      <br>
      <br>
      <div class="flex-center flex-column">
        <div class="animated fadeIn mb-3">
          <input name="username" type="text" placeholder="Usuario" class="form-control" required>
        </div>
        <div class="animated fadeIn mb-3">
          <input name="password" type="password" placeholder="Contraseña" class="form-control" required>
        </div>
        <br>
        <button class="btn btn-success" type="submit"><span class="fas fa-key"></button>
        <!--a class="btn btn btn-info" href="capacitacion.html" role="button">Entrar</a-->
        <br>
      </div>
      <!-- Footer -->
      <!-- Start your project here-->

      <!-- SCRIPTS -->
      <!-- JQuery -->
      <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="js/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <!--script src="js/verify.js"></script-->
    </form>
  </body>
</div>
<script>
  function myFunction() {
    var x = document.getElementById("ide300").checked;
    document.getElementById("demo").innerHTML = x;
  }
</script>

</html>
<?php
 }
?>