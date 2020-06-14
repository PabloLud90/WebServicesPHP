<?php

class Conexion{
    public function conectar(){
        $localhost= "localhost";
        $database= "tienda_curso";
        $user= "root";
        $password= "root";

        $link = new PDO("mysql:host=$localhost;dbname=$database", $user, $password);
        return $link;
        
        //return var_dump($link);
    }
}

// $obj= new Conexion();
// $obj->conectar();

?>