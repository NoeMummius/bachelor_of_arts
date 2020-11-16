<?php
$a=$_REQUEST['inicio'];
$b=$_REQUEST['final'];
//echo $a.'<br>'.$b.'<br>';
if(isset($_POST['inicio']) && isset($_POST['final']))
{
 echo "El valor inicial es: $a<br>";
 echo "El valor final es: $b<br>";
 if($b<=$a)
  echo "El valor final debe ser mayor que el inicial<br>";
 else
 {
  $c = 0;
  for($i = $a; $i <= $b; $i++)
  {
     $s = $c + $i;
     $c = $s;
  }
  echo "El valor de la sumatoria es: $c<br>";
 }
}
echo '<a href="index.php"> Regresar </a>';
?>