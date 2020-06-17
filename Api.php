<?php

require_once 'ControladorJson.php';

//funcion validando todos los parametros disponibles
//pasaremos los parametros requeridos a esta funcion

function isTheseParametersAvailable($params){
    //suponiendo que tosdos los parametros estan disponibles

    $available= true;
    $missingparams= "";

    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param] <- 0) ){
            $available= false;
            $missingparams= $missingparams . " , " . $param;
        }
    }

    //si faltan parametros
    if(!$available){
        $response= array();
        $response['error'] = true;
        $response['message']= 'Parametro' . substr($missingparams, 1, strlen($missingparams)) . '  vacio';

        //error de visualizacion
        echo json_encode($response);

        //detener la ejecucion
        die();
    }
}


//una matriz para mostrar la respuestas de nuestra API
$response= array();

//si se trata de una llamada API

//que significa que un parametro  get llamado se establece en la url
//y con estos p[arametros estamos concluyendo que es una llamada API

//verificar que no llegue vacia
if(isset($_GET['apicall'])){

    //aqui se realiza el llamdos a nuestra API
    switch ($_GET['apicall']) {

    ///////////////////////////////////////
    /////// USUARIOS
    ///////////////////////////////////////
        //operacion crear usuario
        case 'crearUsuario':
            //primero haremos la verificacion de nuestro parametrso
            isTheseParametersAvailable(array('usuario', 'password', 'role', 'email'));

            $db= new ControladorJson();
            
            $result= $db -> crearUsuarioController($_POST['usuario'], 
                                                   $_POST['password'], 
                                                   $_POST['role'], 
                                                   $_POST['email']);
           
            if($result){
                //esto significa que no hay ningun error 
                $response['error']= false;
                //mensaje de ejecucion
                $response['message']= 'Usuario creado correctamente';
                //muestra el usuario creado
                $response['contenido']= $db -> leerUsuariosController();

            }else{
                //esto significa que no hay ningun error 
                $response['error']= true;
                //mensaje de ejecucion
                $response['message']= 'Usuario no se creo correctamente';
            }
        break;

        case 'obtenerUsuarios';
            $db= new ControladorJson();
            //esto significa que no hay ningun error 
            $response['error']= false;
            //mensaje de ejecucion
            $response['message']= 'Solicitud completada correctamente';
            $response['contenido']= $db -> leerUsuariosController();
                break;

            case 'loginUsuario';
            isTheseParametersAvailable(array('mail', 'password'));

            $db= new ControladorJson();

            $result= $db -> loginUsuarioController($_POST['mail'], 
                                                   $_POST['password']);

            if(!$result){
                $response['error']= true;
                $response['message']= 'Credenciales no validas';

            }else{
                $response['error']= false;
                $response['message']= 'Bienvenido';
                $response['contenido']= $result;
            }
        break;

    ///////////////////////////////////////
    /////// CATEGORIAS
    ///////////////////////////////////////
                //crear categorias
        case 'crearCategoria';
            isTheseParametersAvailable(array('titulo'));
    
            $db= new ControladorJson();

            $result= $db -> crearCategoriaController($_POST['titulo']);

            if($result){
                    //esto significa que no hay ningun error 
                $response['error']= false;
                    //mensaje de ejecucion
                $response['message']= 'Categoria creada correctamente';
                    //muestra el usuario creado
                $response['contenido']= $db -> leerCategoriaController();
    
                }else{
                    //esto significa que no hay ningun error 
                    $response['error']= true;
                    //mensaje de ejecucion
                    $response['message']= 'Categoria no se creo correctamente';
                }
        break;
                
                // EDITAR CATEGORIAS
        case 'editarCategorias';

                isTheseParametersAvailable(array('id','titulo'));

                $db= new ControladorJson();

                $result= $db -> actualizarCategoriaController($_POST['id'],
                                                              $_POST['titulo']);

                if($result){
                    //esto significa que no hay ningun error 
                    $response['error']= false;
                    //mensaje de ejecucion
                    $response['message']= 'Categoria editada correctamente';
                    //muestra el usuario creado
                    $response['contenido']= $db -> leerCategoriaController();
    
                }else{
                    //esto significa que no hay ningun error 
                    $response['error']= true;
                    //mensaje de ejecucion
                    $response['message']= 'Categoria no se edito correctamente';
                }      
        break;    
            
            //Elimiar Categoria
        case 'eliminarCategoria';

                isTheseParametersAvailable(array('id'));

                $db= new ControladorJson();

                $result= $db -> borrarCategoriaController($_POST['id']);

                if($result){
                    //esto significa que no hay ningun error 
                    $response['error']= false;
                    //mensaje de ejecucion
                    $response['message']= 'Categoria borrada correctamente';
                    //muestra el usuario creado
                    $response['contenido']= $db -> leerCategoriaController();
    
                }else{
                    //esto significa que no hay ningun error 
                    $response['error']= true;
                    //mensaje de ejecucion
                    $response['message']= 'Categoria no se borro correctamente';
                }
        break;

            //Obtener categorias
        case 'obtenerCategorias';
                $db= new ControladorJson();
                //esto significa que no hay ningun error 
                $response['error']= false;
                //mensaje de ejecucion
                $response['message']= 'Solicitud completada correctamente';
                $response['contenido']= $db -> leerCategoriaController();
        break;

    ///////////////////////////////////////
    /////// Productos
    ///////////////////////////////////////
        case 'obtenerProductos';
                $db= new ControladorJson();

                $response['error']= false;

                $response['message']= 'Solicitud completada correctamente';
                $response['contenido']= $db -> obtenerProductosController();
        break;

        //eliminar producto
        case 'eliminarProducto';
            isTheseParametersAvailable(array('id'));

            $db= new ControladorJson();

            $result= $db -> eliminarProductoController($_POST['id']);

            if($result){
                //esto significa que no hay ningun error 
                $response['error']= false;
                //mensaje de ejecucion
                $response['message']= 'Producto borrado correctamente';
                //muestra el usuario creado
                $response['contenido']= $db -> obtenerProductosController();

            }else{
                //esto significa que no hay ningun error 
                $response['error']= true;
                //mensaje de ejecucion
                $response['message']= 'Producto no se borro correctamente';
            }
        break;

    ///////////////////////////////////////
    /////// Ventas
    ///////////////////////////////////////

    //Crear Ventas
        case 'crearVentas';

        isTheseParametersAvailable(array('usuario', 'producto', 'imagen', 'costo', 'fecha'));

        $db= new ControladorJson();

        $result= $db -> crearVentasController($_POST['usuario'],
                                           $_POST['producto'],
                                           $_POST['imagen'],
                                           $_POST['costo'],
                                           $_POST['fecha']);

            if($result){
                    //esto significa que no hay ningun error 
                $response['error']= false;
                    //mensaje de ejecucion
                $response['message']= 'Venta creada correctamente';
                    //muestra el usuario creado
                $response['contenido']= $db -> obtenerVentasController();
    
            }else{
                //esto significa que no hay ningun error 
                $response['error']= true;
                //mensaje de ejecucion
                $response['message']= 'Venta no se creo correctamente';
            }
        break;

        //obtener ventas
        case 'obtenerVentas';
        $db= new ControladorJson();

        $response['error']= false;

        $response['message']= 'Solicitud completada correctamente';
        $response['contenido']= $db -> obtenerVentasController();

        break;
    }

}else{
    //si no es un api el que se esta invocando empujar los valores apropiada a la estrucutura json
    $response['error']= true;
    $response['message']= 'Invalid API call';

}
echo json_encode($response);


?>