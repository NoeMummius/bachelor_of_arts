<?php
 class MySQL extends mysqli
 {
     private $port;
     private $Server;
     private $Database;
     private $Username;
     private $Password;
     private $Cryptkey;
     public function __construct()
     {
         $this->port = 3306;
         $this->Server = 'localhost';
         $this->Database = 'Petshop';
         $this->Username = 'root';
         $this->Password = '53415483';
         $this->Cryptkey = '91939';
         parent::__construct($this->Server, $this->Username, $this->Password, $this->Database);
 
         if (mysqli_connect_error()) {
             die('Error de Conexión (' . mysqli_connect_errno() . ') '
                     . mysqli_connect_error());
         }
     }
     public function getCryptkey()
     {
         return $this->Cryptkey;
     }
 }
?>
