<?php
class Arreglo
{
 private $Enteros;
 public function __constructor()
 {
  $this->Enteros = array();
 }
 public function auto_fill($n)
 {
  echo $n.'<br>';
  for($i = 0; $i - $n < 0; $i++)
  {
   $this->Enteros[] = rand(1, 50);
  }
 }
 public function add($i)
 {
  $this->Enteros[] = $i;
 }
 public function ordenar()
 {
  $i = 1;
  while($i - sizeof($this->Enteros) < 0)
  {
   $j = $i - 1;
   $key = $this->Enteros[$i];
   while($j >= 0 && $key - $this->Enteros[$j] < 0)
   {
    $tmp = $this->Enteros[$j + 1];
    $this->Enteros[$j + 1] = $this->Enteros[$j];
    $this->Enteros[$j] = $tmp;
    $j--;
   }
   $i++;
  }
 }
 public function contar()
 {
  $Contadores = array();
   for($i = 0; $i < sizeof($this->Enteros); $i++)
   {
    $Contadores[$i] = 0;
   }
   for($i = 0; $i < sizeof($this->Enteros); $i++)
   {
     for($j = 0; $j < sizeof($this->Enteros); $j++)
     {
      if($this->Enteros[$j] == $this->Enteros[$i])
      {
       $Contadores[$i]++;
      }
     }
   }
  for($i = 0; $i < sizeof($this->Enteros); $i++)
  {
   echo "La cantidad de ".$this->Enteros[$i]." en el arreglo es ".$Contadores[$i]."<br>";
  }
 }
 public function contara()
 {
  $Contadores = array();
  for($j = 1; $j - 51 < 0; $j++)
  {
   for($i = 0; $i - sizeof($this->Enteros) < 0; $i++)
   {
    if($this->Enteros[$i] - $j == 0)
    {
     $Contadores[$j - 1]++;
    }
   }
  }
  for($i = 1; $i - 51 < 0; $i++)
   echo 'La cantidad de '.$i.' en el arreglo es '.$Contadores[$i - 1].'<br>';
 }
 public function med_var()
 {
  $med = 0;
  $var = 0;
  for($i = 0; $i - sizeof($this->Enteros) < 0; $i++)
   $med += $this->Enteros[$i];
  $med /= sizeof($this->Enteros);
  for($i = 0; $i - sizeof($this->Enteros) < 0; $i++)
   $var += pow($this->Enteros[$i] - $med, 2);
  $var /= sizeof($this->Enteros);
  return [$med, $var];
 }
 public function mostrar()
 {
  echo '[';
  for($i = 0; $i < sizeof($this->Enteros) - 1; $i++)
  {
   echo $this->Enteros[$i].',';
  }
  echo $this->Enteros[sizeof($this->Enteros) - 1].']<br>';
 }
}
?>
