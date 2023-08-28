<?php
include_once 'api/config/config.php';
class modelCompras
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
 
    // Registrar Compras
    public function Register($data = [])
    {
        try {
            $fecha_compra = $data["fecha_compra"] ?? "";
            $condicion_pago = $data["condicion_pago"] ?? "";
            $cantidad =$data["cantidad"] ?? "";
            $codigo = $data["codigo"]?? "";
            $concepto = $data["concepto"] ?? "";
            $precio_unitario = $data["precio_unitario"] ?? "";
            $importe = $data["importe"] ?? "";
            $subtotal = $data["subtotal"] ?? "";
            $total_iva = $data["total_iva"] ?? "";
            $total = $data["total"] ?? "";
            $fecha_entrega_compras = $data["fecha_entrega_compras"] ?? "";
            $usuario_responsable = $data["usuario_responsable"] ?? "";
            $nombre_proveedor = $data["nombre_proveedor"] ?? "";
            $telefono_proveedor = $data["telefono_proveedor"] ?? "";
            $observaciones_compras = $data["observaciones_compras"] ?? "";
            $proveedor_fk = $data["proveedor_fk"] ?? "";
            $Xqj_users_fk = $data["Xqj_users_fk"] ?? "";
            $fecha_sin_guiones = str_replace("-", "",$fecha_compra );
            $nueva_compra = ($data["nueva_compra"] == "true" ? true : false) ?? true;
            

            /* CASO */
            /*
                1. Un nueva compra que contiene 3 productos
                PROD #1: nueva_compra = true;
                PROD #2: nueva_compra = false;
                PROD #3: nueva_compra = false;
                
                2. Un nueva compra que contiene SOLO 1 producto
                PROD #1: nueva_compra = true;
            */

            if($nueva_compra){
                $sql = "INSERT INTO compras (fecha_compra, condicion_pago,
                cantidad, codigo, concepto, precio_unitario, importe, subtotal,
                total_iva, total, fecha_entrega_compras, usuario_responsable, 	nombre_proveedor, telefono_proveedor, observaciones_compras, proveedor_fk, Xqj_users_fk, folio_compra ) 
                VALUES ('$fecha_compra', '$condicion_pago',
                '$cantidad', '$codigo', '$concepto', '$precio_unitario', '$importe', '$subtotal',
                '$total_iva', '$total', '$fecha_entrega_compras', '$usuario_responsable', '$nombre_proveedor', '$telefono_proveedor', '$observaciones_compras', '$proveedor_fk', '$Xqj_users_fk', 
                (SELECT IF( ( SELECT folio_compra FROM ( SELECT folio_compra FROM compras WHERE folio_compra LIKE '%$fecha_sin_guiones%' ORDER BY folio_compra DESC LIMIT 1 ) AS subquery ) IS NULL, CONCAT('$fecha_sin_guiones', '-1'), ( SELECT CONCAT( '$fecha_sin_guiones', '-', ( SUBSTRING_INDEX(folio_compra, '-', -1) +1 ) ) FROM ( SELECT folio_compra FROM compras WHERE folio_compra LIKE '%$fecha_sin_guiones%' ORDER BY folio_compra DESC LIMIT 1 ) AS subquery ) ) AS resultado))";
            } else{
                $sql = "INSERT INTO compras (fecha_compra, condicion_pago,
                cantidad, codigo, concepto, precio_unitario, importe, subtotal,
                total_iva, total, fecha_entrega_compras, usuario_responsable, 	nombre_proveedor, telefono_proveedor, observaciones_compras, proveedor_fk, Xqj_users_fk, folio_compra ) 
                VALUES ('$fecha_compra', '$condicion_pago',
                '$cantidad', '$codigo', '$concepto', '$precio_unitario', '$importe', '$subtotal',
                '$total_iva', '$total', '$fecha_entrega_compras', '$usuario_responsable', '$nombre_proveedor', '$telefono_proveedor', '$observaciones_compras', '$proveedor_fk', '$Xqj_users_fk', 
                    (
                        SELECT IF(
                            (SELECT CONCAT( '$fecha_sin_guiones', '-', (SUBSTRING_INDEX(folio_compra, '-', -1)) ) FROM ( SELECT folio_compra FROM compras WHERE folio_compra LIKE '%$fecha_sin_guiones%' ORDER BY folio_compra DESC LIMIT 1 ) AS subquery) IS NULL,
                            CONCAT('$fecha_sin_guiones', '-1'), 
                            (SELECT CONCAT( '$fecha_sin_guiones', '-', (SUBSTRING_INDEX(folio_compra, '-', -1)) ) FROM ( SELECT folio_compra FROM compras WHERE folio_compra LIKE '%$fecha_sin_guiones%' ORDER BY folio_compra DESC LIMIT 1 ) AS subquery)
                        )
                    )
                )";
            }
	//echo $sql;
            
            $status = $this->pdo->exec($sql);
               
            return $status;
        } catch (Exception $e) {
            return false;
        }
    }


    // ? Listar todas las compras agrupados por el folio
    public function List(){
        try {
            $sql = "SELECT folio_compra, fecha_compra, usuario_responsable, nombre_proveedor, fecha_entrega_compras FROM compras GROUP BY folio_compra";         
            $result = $this->pdo->prepare($sql);
            $result->execute();
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }

    // ? Listar compras por ID folio de compra
    public function ListById($id = ""){
        try {
            $sql = "SELECT * FROM compras WHERE folio_compra = ?";            
            $result = $this->pdo->prepare($sql);
            $result->execute(
                array(
                    $id
                )
            );
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }



    // ? Borrar compras por ID
    public function DeleteById($id = ""){
        try {
            $sql = "DELETE FROM compras WHERE id_compras = ?";            
            $result = $this->pdo->prepare($sql)->execute(
                array(
                    $id
                )
            );
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    // ? Actualizar compras por ID
    public function UpdateById($data = []){
        try {
            $fecha_compra = $data["fecha_compra"] ?? "";
            $folio_compra = $data["folio_compra"] ?? "";
            $condicion_pago = $data["condicion_pago"] ?? "";
            $cantidad =$data["cantidad"] ?? "";
            $codigo = $data["codigo"]?? "";
            $concepto = $data["codigo"] ?? "";
            $precio_unitario = $data["precio_unitario"] ?? "";
            $importe = $data["importe"] ?? "";
            $subtotal = $data["subtotal"] ?? "";
            $total_iva = $data["total_iva"] ?? "";
            $total = $data["total"] ?? "";
            $fecha_entrega_compras = $data["fecha_entrega_compras"] ?? "";
            $usuario_responsable = $data["usuario_responsable"] ?? "";
            $nombre_proveedor = $data["nombre_proveedor"] ?? "";
            $telefono_proveedor = $data["telefono_proveedor"] ?? "";
            $observaciones_compras = $data["observaciones_compras"] ?? "";
            $proveedor_fk = $data["proveedor_fk"] ?? "";
            $Xqj_users_fk = $data["Xqj_users_fk"] ?? "";
            $id_compras = $data["id_compras"] ?? "";

            $sql = "UPDATE compras SET fecha_compra = ?,  folio_compra = ?,  condicion_pago = ?,   
            cantidad = ?, codigo = ?, concepto = ?, precio_unitario = ?, importe = ?,
            subtotal = ?,  total_iva = ?, total = ?, fecha_entrega_compras = ?, 
             usuario_responsable = ?, nombre_proveedor = ?, telefono_proveedor = ?, observaciones_compras = ?, proveedor_fk = ?, Xqj_users_fk = ? WHERE id_compras = ?";            
            $result = $this->pdo->prepare($sql)->execute(
                array(
                    $fecha_compra,
                    $folio_compra,
                    $condicion_pago,
                    $cantidad,
                    $codigo,
                    $concepto,
                    $precio_unitario,
                    $importe,
                    $subtotal,
                    $total_iva,
                    $total,
                    $fecha_entrega_compras,
                    $usuario_responsable,
                    $nombre_proveedor,
                    $telefono_proveedor,
                    $observaciones_compras,
                    $proveedor_fk,
                    $Xqj_users_fk,
                    $id_compras
                )
            );
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
