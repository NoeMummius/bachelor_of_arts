<html>
<head><meta charset="gb18030">
<title> Ejemplo 1 </title>
</head>
<body>
<h1> Sumatoria </h1>
<hr><br>
<?PHP
// Función sumatoria

function sumatoria($ini, $fin)
{
 $res=0;
 for($i=$ini; $i<=$fin; $i++)
 {
        $sumaparcial=$res+$i;
        echo "$res + $i = $sumaparcial <br>"; 
        $res=$sumaparcial;
  }
 return $res;
}

 $a=12;
 $b=7;
 $c=$a+$b;
 echo "<br>";
 echo " La suma de $a + $b = $c <br>";
 for($i=1; $i<=10; $i++)
 {
  echo "<font size=$i> Hola $i </font> <br>";
 }

 $r=sumatoria($b,$a);
 echo "La sumatoria desde $b hasta $a = $r <br>"; 

?>
</body>
</html>