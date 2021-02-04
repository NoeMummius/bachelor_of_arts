<!doctype html>
<html>
  <head>
    <title>Aplicaciones Web</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
            initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.2-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.2-dist/css/mdb.min.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.2-dist/css/thegrid.css">
  </head>
  <body>
    <nav class="panel">
        <a href="../index.html">Inicio</a>
        <a href="../apuntes/index.php">Notas</a>
        <a href="../team_5/index.html">Equipo</a>
    </nav>
    <header>
        <div class="container">
            <div class="container-text">
                <div class="text">
                    <h1 class="name">Budh Software Company</h1>
                    <h2 class="occupation">Web Móvil IoT</h2>
                    <h2 class="slogan">Academic Services</h2>
                </div>
            </div>
        </div>
    </header>
    <section class="main">
        <section class="services">
            <div class="title">Aplicaciones Web</div>
            <div class="subtitle">Equipo 5</div>
            <div class="container-service">
                <div class="service">
                    <div class="thumb"><img src="../team_5/evidencias/juan_cuamatzi_flores.jpg"></div>
                    <div class="service-info">
                        <div class="name">Cuamatzi Flores, Juan</div>
                    </div>
                </div>
                <div class="service">
                    <div class="thumb"><img src="../team_5/evidencias/noe_munoz_perez.jpg"></div>
                    <div class="service-info">
                        <div class="name">Muñoz Pérez, Noé</div>
                    </div>
                </div>
                <div class="service">
                    <div class="thumb"><img src="../team_5/evidencias/ariadna_abigail_rojas_cano.jpg"></div>
                    <div class="service-info">
                        <div class="name">Rojas Cano, Ariadna A.</div>
                    </div>
                </div>
                <div class="service">
                    <div class="thumb"><img src="../team_5/evidencias/arturo_trujillo_carrera.jpg"></div>
                    <div class="service-info">
                        <div class="name">Trujillo Carrera, Arturo</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="workspace">
            <table>
                <tr>
                    <td># De actividad</td>
                    <td>Actividad 5</td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>Arreglos en PHP Orientado a Objetos</td>
                </tr>
                <tr>
                    <td>Descripci&oacute;n</td>
                    <td>En ésta actividad se desarrolló un script en PHP utilizando el paradigma orientado a objetos para realizar algunas operaciones básicas sobre arreglos. Las operaciones incluídas en el script son:<br>
                        <ul>
                            <li>Mostrar</li>
                            <li>Ordenar ascendentemente</li>
                            <li>Calcular media y varianza de los datos</li>
                            <li>Llenar con números introducidos por el usuario</li>
                            <li>Llenar con números aleatorios</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Evidencia</td>
                    <td>
                        <img src="evidencias/actividad_5_slack_1.png" width="400" height="200"><br>
                        <img src="evidencias/actividad_5_slack_2.png" width="400" height="100"><br>
                        <a href="https://github.com/NoeMummius/array_php">Github del proyecto por <i>Noé Muñoz</i></a><br>
                        <img src="evidencias/noe_array_php.png" width="400" height="250"><br>
                        <label>Prueba de Noé</label><br>
                        <img src="evidencias/abigail_array_php.jpg" width="400" height="550"><!--/td>
                                <td><img src="evidencias/abigail_array_php_2.jpg" width="400" height="550"--><br>
                        <label>Prueba de Abigail</label><br>
                        <img src="evidencias/arturo_array_php.jpg" width="400" height="550"><br>
                        <label>Prueba de Arturo</label><br>
                        <?php
                        $fp = fopen("arreglo.php","r");
                        while(!feof($fp))
                        {
                            $linea=fgets($fp);
                            echo $linea.'<br>';
                        }
                        ?><br>
                        <label>Código de la clase arreglo por <i>Ariadna Rojas y Noé Muñoz</i></label><br>
                    </td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>Tue. Sep. 1, 2020 10:54</td>
                </tr>
            </table>
        </section>
    </section>
   <br>
   <section class="workspace">
    <form action="index.php" method="POST">
     <label for="crear">Escriba los números que llevará el arreglo separados por comas: </label>
     <input type="text" name="data">
     <!--input type="submit" value="Enviar datos"-->
     <br>
     <label for="crear">O escriba con cuántos números aleatorioas llenará el arreglo: </label>
     <input type="text" name="length">
     <br>
     <label for="orden">Elija cómo desea ver los datos: </label>
     <select name="orden" id="orden">
       <option value="D">Desordenados</option>
       <option value="O">Ordenados</option>
     </select>
     <br>
     <input type="submit" value="Enviar datos">
    </form>
    <?PHP
     require("arreglo.php");
     $Enteros;
     if($_REQUEST['data'] != null)
     {
      $Numeros = explode(",", $_REQUEST['data']);
      $Enteros = new Arreglo();
      foreach($Numeros as $numero)
      {
       $Enteros->add($numero);
      }
      if (isset($_POST['orden']))
      {
       $orden=$_REQUEST['orden'];
       switch($orden)
       {
        case 'D':
         $Enteros->mostrar()."<br>"; 
        break;
        case 'O':
         $Enteros->ordenar();
         $Enteros->mostrar().'<br>';
        break;
       }
       $med = 0;
       $var = 0;
       [$med, $var] = $Enteros->med_var();
       echo 'Media: '.$med.'<br>Varianza: '.$var.'<br>';
       $Enteros->contar();
      }
     }
     elseif($_REQUEST['length'] != null)
     {
      echo 'Random<br>';
      $Enteros = new Arreglo();
      $Enteros->auto_fill($_REQUEST['length']);
      if (isset($_POST['orden']))
      {
       $orden=$_REQUEST['orden'];
       switch($orden)
       {
        case 'D':
         $Enteros->mostrar()."<br>"; 
        break;
        case 'O':
         $Enteros->ordenar();
         $Enteros->mostrar().'<br>';
        break;
       }
       $med = 0;
       $var = 0;
       [$med, $var] = $Enteros->med_var();
       echo 'Media: '.$med.'<br>Varianza: '.$var.'<br>';
       $Enteros->contara();
      }
     }
     else
     {
      echo 'Ningún dato fue proporcionado<br>';
     }
    ?>
   </section>
  </body>
</html>
