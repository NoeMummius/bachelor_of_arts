<?php
class Circulo
{
 private $radio;
 public function __construct($radio)
 {
  $this->radio = $radio;
 }
 public function surface()
 {
  $s = 3.14159265 * $this->radio * $this->radio;
  return $s;
 }
 public function getRadio()
 {
  return $this->radio;
 }
}
?>