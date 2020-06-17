<?php

require_once "ModeloJson.php";



class ControladorJson{

    ///////////////////////////////////////
    /////// CRUD USUARIOS
    ///////////////////////////////////////
    //CREAR USUARIOS
    public function crearUsuarioController($usuario, $password, $role, $email){
        //colocamos losparametros que son de la tabla de BD para la creacion del usuario
        $datosController= array("usuario" => $usuario, "password" => $password, "role" => $role, "email" => $email);

        //Llamamos a nuestro modelo crear usuarios del modeloJson.php
        $respuesta= Datos::crearUsuario($datosController,"usuarios");
        return $respuesta;
    }

    //OBTENER USUARIOS
    public function leerUsuariosController(){

        $respuesta= Datos::leerUsuariosModel("usuarios");
        return $respuesta;
    }

    //LOGIN USUARIOS
    public function loginUsuarioController($mail, $password){

        $datosController= array("mail" => $mail, "password"=> $password);

        $respuesta= Datos::loginUsuarios($datosController, "usuarios");

        return $respuesta;
    }


    ///////////////////////////////////////
    /////// CRUD CATEGORIAS
    ///////////////////////////////////////
    //CREAR CATEGORIA
    public function  crearCategoriaController($titulo){

        $datosController= array("titulo" => $titulo);

        $respuesta= Datos::crearCategoria($datosController, "categorias");

        return $respuesta;

    }

    //EDITAR 
    public function actualizarCategoriaController($id, $titulo){
        
        $datosController= array("id"=> $id, "titulo" => $titulo);

        $respuesta= Datos::actualizarCategoria($datosController, "categorias");

        return $respuesta;

    }

    //ELIMINAR
    public function borrarCategoriaController($id){

        $datosController= array("id"=> $id);

        $respuesta= Datos::borrarCategoria($datosController, "categorias");

        return $respuesta;

    }

    //OBTENER CATEGORIAS
    public function leerCategoriaController(){

        $respuesta= Datos::leerCategoria("categorias");
        return $respuesta;


    }

    ///////////////////////////////////////
    /////// CRUD VENTAS
    ///////////////////////////////////////

    //CREAR VENTAS
    public function crearVentasController($usuario, $producto, $imagen, $costo, $fecha){

         //colocamos losparametros que son de la tabla de BD para la creacion del usuario
         $datosController= array("usuario" => $usuario, "producto" => $producto, "imagen" => $imagen, "costo" => $costo, "fecha" => $fecha);

         //Llamamos a nuestro modelo crear usuarios del modeloJson.php
         $respuesta= Datos::crearVenta($datosController,"ventas");
         return $respuesta;


    }

    //OBTENER VENTAS
    public function obtenerVentasController(){

        $respuesta= Datos:: obtenerVentas("ventas");

        return $respuesta;
    }

    ///////////////////////////////////////
    /////// CRUD PRODUCTOS
    ///////////////////////////////////////

    //OBTENER PRODUCTOS
    public function obtenerProductosController(){

        $respuesta= Datos:: obtenerProductos("productos");

        return $respuesta;
    }

    // ELIMINAR PRODUCTOS
    public  function eliminarProductoController($id){

        $datosController= array("id"=> $id);

        $respuesta= Datos::eliminarProducto($datosController, "productos");

        return $respuesta;
    }

 

    


}

$obj= new ControladorJson();
$obj-> loginUsuarioController("mishel@curso.com", "123456");
?>