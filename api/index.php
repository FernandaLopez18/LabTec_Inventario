<?php
    // ? Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Content-Type: application/json; charset=UTF-8");

$action = isset($_REQUEST["action"]) && !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "default";

switch ($action) {

    // USUARIOS //

    case 'NewUser':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListUsers':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListById':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByUser':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $user = isset($_REQUEST["user"]) && !empty($_REQUEST["user"]) ? $_REQUEST["user"] : "";
        $result = $controller->ListByUser($user);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;
    
    case 'DeleteById':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateById':
        include_once 'api/controllers/controllerUsuario.php';
        $controller = new controllerUsuario();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;
    // USUARIOS //


    // COMPRAS //
    
    case 'NewShop':
        include_once 'api/controllers/controllerCompras.php';
        $controller = new controllerCompras();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListShop':
        include_once 'api/controllers/controllerCompras.php';
        $controller = new controllerCompras();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdS':
        include_once 'api/controllers/controllerCompras.php';
        $controller = new controllerCompras();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    
    case 'DeleteByIdS':
        include_once 'api/controllers/controllerCompras.php';
        $controller = new controllerCompras();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateByIdS':
        include_once 'api/controllers/controllerCompras.php';
        $controller = new controllerCompras();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;


    // COMPRAS//

    // DIRECCIÓN //
    case 'NewAddress':
        include_once 'api/controllers/controllerDireccion.php';
        $controller = new controllerDireccion();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListAddress':
        include_once 'api/controllers/controllerDireccion.php';
        $controller = new controllerDireccion();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdA':
        include_once 'api/controllers/controllerDireccion.php';
        $controller = new controllerDireccion();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    
    case 'DeleteByIdA':
        include_once 'api/controllers/controllerDireccion.php';
        $controller = new controllerDireccion();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateByIdA':
        include_once 'api/controllers/controllerDireccion.php';
        $controller = new controllerDireccion();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;
    // DIRECCIÓN //

    // PEDIDO //
    case 'NewOrder':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListOrder':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdO':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByfech':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $user = isset($_REQUEST["fecha_pedido"]) && !empty($_REQUEST["fecha_pedido"]) ? $_REQUEST["fecha_pedido"] : "";
        $result = $controller->ListByfech($fecha_pedido);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;
    
    case 'DeleteByIdO':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateByIdO':
        include_once 'api/controllers/controllerPedido.php';
        $controller = new controllerPedido();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;
    // PEDIDO //

    // PRODUCTO //
    case 'NewProduct':
        include_once 'api/controllers/controllerProducto.php';
        $controller = new controllerProducto();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListProduct':
        include_once 'api/controllers/controllerProducto.php';
        $controller = new controllerProducto();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdP':
        include_once 'api/controllers/controllerProducto.php';
        $controller = new controllerProducto();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    
    case 'DeleteByIdP':
        include_once 'api/controllers/controllerProducto.php';
        $controller = new controllerProducto();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateByIdP':
        include_once 'api/controllers/controllerProducto.php';
        $controller = new controllerProducto();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;

    // PRODUCTO //

     // ROLES //
     case 'NewRol':
        include_once 'api/controllers/controllerRoles.php';
        $controller = new controllerRoles();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListRol':
        include_once 'api/controllers/controllerRoles.php';
        $controller = new controllerRoles();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdRo':
        include_once 'api/controllers/controllerRoles.php';
        $controller = new controllerRoles();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    
    case 'DeleteByIdRo':
        include_once 'api/controllers/controllerRoles.php';
        $controller = new controllerRoles();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'UpdateByIdRo':
        include_once 'api/controllers/controllerRoles.php';
        $controller = new controllerRoles();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;

    // ROLES //

    // PROVEEDORES //
    case 'NewProvider':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $result = $controller->Register($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_SAVED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_SAVED"]);
        }
    break;

    case 'ListProvider':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $result = $controller->List();
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByIdPD':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->ListById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;

    case 'ListByProvider':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $user = isset($_REQUEST["user"]) && !empty($_REQUEST["user"]) ? $_REQUEST["user"] : "";
        $result = $controller->ListByUser($user);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_FOUND"]);
        }
    break;
    
    case 'DeleteByIdPD':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
        $result = $controller->DeleteById($id);
        if($result){
            echo json_encode(["status" => true, "data" => $result]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_DELETE"]);
        }
    break;

    case 'UpdateByIdPD':
        include_once 'api/controllers/controllerProveedores.php';
        $controller = new controllerProveedores();
        $result = $controller->UpdateById($_REQUEST);
        if($result){
            echo json_encode(["status" => true, "message" => "DATA_UPDATED"]);
        } else{
            echo json_encode(["status" => false, "message" => "DATA_NOT_UPDATED"]);
        }
    break;

    // PROVEEDORES //

 

    case 'default':
    default:
        echo json_encode(["status" => false, "message" => "ACTION_NOT_FOUND"]);
    break;
}
