<?php

require_once "Conexion.php";

class Datos extends Conexion{

    ///////////////////////////////////////
    /////// CREAR USUARIOS
    ///////////////////////////////////////
    public function createUsuario($tabla){
        $stmt= Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, role, mail) VALUES (:usuario, 
        :password, :role, :mail)");

        $usuario= "Vivi";
        $password= "123456";
        $role= "administrador";
        $mail= "vivi@curso.com";


        $stmt-> bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt-> bindParam(":password", $password, PDO::PARAM_STR);
        $stmt-> bindParam("role", $role, PDO::PARAM_STR);
        $stmt-> bindParam("mail", $mail, PDO::PARAM_STR);


        if($stmt -> execute()){
            echo "Registro EXitoso";
        }else{
            echo "No se puede hacer el registro";

        }
    }

    ///////////////////////////////////////
    /////// OBTENER USUARIOS
    ///////////////////////////////////////
    public function leerUsuariosModel($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT id, usuario, password, role, mail FROM $tabla");
        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("usuario", $usuario);
        $stmt->bindColumn("password", $password);
        $stmt->bindColumn("role", $role);
        $stmt->bindColumn("mail", $mail);

        $usuarios = array();

        // verificar
        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>usuarios</strong></td>
        <td><strong>mail</strong></td>
        <td><strong>password</strong></td>
        <td><strong>role</strong></td>

        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $user= array();
            $user["id"]= utf8_encode($id);
            $user["usuario"]= utf8_encode($usuario);
            $user["mail"]= utf8_encode($mail);
            $user["password"]= utf8_encode($password);
            $user["role"]= utf8_encode($role);


            array_push($usuarios, $user);

            echo'
            <tr>
            <td>'.$user['id'].'</td>
            <td>'.$user['usuario'].'</td>
            <td>'.$user['mail'].'</td>
            <td>'.$user['password'].'</td>
            <td>'.$user['role'].'</td>
            ';
        }

        echo'</table>';

        return $usuarios;

    }
    ///////////////////////////////////////
    /////// LOGIN
    ///////////////////////////////////////
    public function loginUsuarios($tabla){

        $stmt= Conexion::conectar()->prepare("SELECT id, usuario, password, role, mail FROM $tabla WHERE mail= :mail AND 
        password= :password");

        $mail= "pablo@curso.com";
        $password= "123456";

        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("usuario", $usuario);
        $stmt->bindColumn("password", $password);
        $stmt->bindColumn("role", $role);
        $stmt->bindColumn("mail", $mail);

             // verificar
        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>usuarios</strong></td>
        <td><strong>mail</strong></td>
        <td><strong>password</strong></td>
        <td><strong>role</strong></td>

        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $user= array();
            $user["id"]= utf8_encode($id);
            $user["usuario"]= utf8_encode($usuario);
            $user["mail"]= utf8_encode($mail);
            $user["password"]= utf8_encode($password);
            $user["role"]= utf8_encode($role);


            echo'
            <tr>
            <td>'.$user['id'].'</td>
            <td>'.$user['usuario'].'</td>
            <td>'.$user['mail'].'</td>
            <td>'.$user['password'].'</td>
            <td>'.$user['role'].'</td>
            ';
        }
        if(!empty($user)){
            return $user;

        }else{
            return false;
        }
    }

    ///////////////////////////////////////
    /////// CRUD CATEGORIAS
    ///////////////////////////////////////

    //  CREAR
    public function crearCategoria($tabla){
        $stmt= Conexion::conectar()->prepare("INSERT INTO $tabla (titulo) VALUES (:titulo)");

        // variables de apoyo
        $titulo= "MONITOR";

        $stmt-> bindParam(":titulo", $titulo, PDO::PARAM_STR);

        if($stmt -> execute()){
            echo "Registro EXitoso";
        }else{
            echo "No se puede hacer el registro";
        }
    }

    //  OBTENER-leer
    public function leerCategoria($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT id, titulo FROM $tabla");
        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("titulo", $titulo);
  

        $categorias = array();

        // verificar
        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>titulo</strong></td>
        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $cat= array();
            $cat["id"]= utf8_encode($id);
            $cat["titulo"]= utf8_encode($titulo);
   


            array_push($categorias, $cat);

            echo'
            <tr>
            <td>'.$cat['id'].'</td>
            <td>'.$cat['titulo'].'</td>
    
            ';
        }

        echo'</table>';

        return $categorias;
        
    }

    // ACTUALIZAR
    public function actualizarCategoria($tabla){
        $stmt= Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo WHERE id= :id");

        // variables de apoyo
        $id= "18";
        $titulo= "MONITORES";

        $stmt-> bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $stmt-> bindParam(":id", $id, PDO::PARAM_INT);


        if($stmt -> execute()){
            echo "Actualizado con Exito";
        }else{
            echo "No se puede hacer la actualizacion";
        }
    }


    // BORRAR
    public function borrarCategoria($id, $tabla){
        $stmt= Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id= :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt -> execute()){
            echo "La categoria se borro";
        }else{
            echo "La categoria no puede borrarse";
        }
    }

    ///////////////////////////////////////
    /////// VENTAS
    ///////////////////////////////////////

    //CREAR VENTA
    public function crearVenta($tabla){
  
        $stmt= Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, producto, imagen, costo, fecha) 
        VALUES(:usuario, :producto, :imagen, :costo, :fecha)");

        //variables de apoyo
        $usuario= 12;
        $producto= "Mica Cristal Templado";
        $imagen= "views/images/articulos/articulo967.jpg";
        $costo="165.00";
        $fecha="2020-06-11 17:26:44";
        
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
        $stmt->bindParam(":producto", $producto, PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $imagen, PDO::PARAM_STR);
        $stmt->bindParam(":costo", $costo, PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

        if($stmt -> execute()){
            echo "La venta se realizo correctamente";
        }else{
            echo "La venta no se realizo correctamente";
        }
    }


    // OBTENER VENTAS
    public function obtenerVentas($tabla){
        
        $stmt= Conexion::conectar()->prepare("SELECT V.id, U.usuario, V.producto, V.imagen, V.costo, V.fecha FROM $tabla V 
        INNER JOIN usuarios U ON V.usuario = U.id ORDER BY V.fecha");
        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("usuario", $usuario);
        $stmt->bindColumn("producto", $producto);
        $stmt->bindColumn("imagen", $imagen);
        $stmt->bindColumn("costo", $costo);
        $stmt->bindColumn("fecha", $fecha);

        $ventas = array();

        // verificar
        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>usuario</strong></td>
        <td><strong>producto</strong></td>
        <td><strong>imagen</strong></td>
        <td><strong>costo</strong></td>
        <td><strong>fecha</strong></td>
        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $venta= array();
            $venta["id"]= utf8_encode($id);
            $venta["usuario"]= utf8_encode($usuario);
            $venta["producto"]= utf8_encode($producto);
            $venta["imagen"]= utf8_encode($imagen);
            $venta["costo"]= utf8_encode($costo);
            $venta["fecha"]= utf8_encode($fecha);


            array_push($ventas, $venta);

            echo'
            <tr>
            <td>'.$venta['id'].'</td>
            <td>'.$venta['usuario'].'</td>
            <td>'.$venta['producto'].'</td>
            <td>'.$venta['imagen'].'</td>
            <td>'.$venta['costo'].'</td>
            <td>'.$venta['fecha'].'</td>
            ';
        }

        echo'</table>';

        return $ventas;
    }

    public function obtenerVentasEspecificas($usuario, $tabla){
        $stmt= Conexion::conectar()->prepare("SELECT V.id, U.usuario, V.producto, V.imagen, V.costo, V.fecha FROM $tabla V 
        INNER JOIN usuarios U ON V.usuario = U.id ORDER BY V.fecha");
        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("usuario", $usuario);
        $stmt->bindColumn("producto", $producto);
        $stmt->bindColumn("imagen", $imagen);
        $stmt->bindColumn("costo", $costo);
        $stmt->bindColumn("fecha", $fecha);
        
        $ventas = array();

        // verificar
        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>usuario</strong></td>
        <td><strong>producto</strong></td>
        <td><strong>imagen</strong></td>
        <td><strong>costo</strong></td>
        <td><strong>fecha</strong></td>
        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $venta= array();
            $venta["id"]= utf8_encode($id);
            $venta["usuario"]= utf8_encode($usuario);
            $venta["producto"]= utf8_encode($producto);
            $venta["imagen"]= utf8_encode($imagen);
            $venta["costo"]= utf8_encode($costo);
            $venta["fecha"]= utf8_encode($fecha);


            array_push($ventas, $venta);

            echo'
            <tr>
            <td>'.$venta['id'].'</td>
            <td>'.$venta['usuario'].'</td>
            <td>'.$venta['producto'].'</td>
            <td>'.$venta['imagen'].'</td>
            <td>'.$venta['costo'].'</td>
            <td>'.$venta['fecha'].'</td>
            ';
        }

        echo'</table>';

        return $ventas;
    }


    ///////////////////////////////////////
    /////// PRODUCTOS
    ///////////////////////////////////////

    public function obtenerProductos($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT id, titulo, descripcion, contenido, imagen, precio, calificacion, 
        categoria FROM $tabla");
        $stmt->execute();

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("titulo", $titulo);
        $stmt->bindColumn("descripcion", $descripcion);
        $stmt->bindColumn("contenido", $contenido);
        $stmt->bindColumn("imagen", $imagen);
        $stmt->bindColumn("precio", $precio);
        $stmt->bindColumn("calificacion", $calificacion);
        $stmt->bindColumn("categoria", $categoria);

        $productos= array();

        echo' 
        <table>
        <tr>
        <td><strong>id</strong></td>
        <td><strong>titulo</strong></td>
        <td><strong>descripcion</strong></td>
        <td><strong>contenido</strong></td>
        <td><strong>imagen</strong></td>
        <td><strong>precio</strong></td>
        <td><strong>calificacion</strong></td>
        <td><strong>categoria</strong></td>
        ';

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $producto= array();
            $producto['id']= utf8_encode($id);
            $producto['titulo']= utf8_encode($titulo);
            $producto['descripcion']= utf8_encode($descripcion);
            $producto['contenido']= utf8_encode($contenido);
            $producto['imagen']= utf8_encode($imagen);
            $producto['precio']= utf8_encode($precio);
            $producto['calificacion']= utf8_encode($calificacion);
            $producto['categoria']= utf8_encode($categoria);

            array_push($productos, $producto);

            echo'
            <tr>
            <td>'.$producto['id'].'</td>
            <td>'.$producto['titulo'].'</td>
            <td>'.$producto['descricion'].'</td>
            <td>'.$producto['contenido'].'</td>
            <td>'.$producto['imagen'].'</td>
            <td>'.$producto['precio'].'</td>
            <td>'.$producto['calificacion'].'</td>
            <td>'.$producto['categoria'].'</td>
            ';
        }

        echo'</table>';
        return $productos;
    }

    public function eliminarProducto($id, $tabla){
        $stmt= Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt -> execute()){
            echo'Producto eliminado correctamente';
        }else{
            echo'Producto no se elimino correctamente';

        }

    }
}


$obj= new Datos();
$obj->eliminarProducto(17,"productos");

?>