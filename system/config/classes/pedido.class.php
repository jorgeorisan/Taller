<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "pedido.auto.class.php");

class Pedido extends AutoPedido { 
	private $DB_TABLE = "pedido";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM pedido where status in ('active','Validado');";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
		//metodo que sirve para hacer obtener datos en el editar
	public function getTable($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql= "
		SELECT p.id,p.id_proveedor,p.id_user,p.id_almacen,p.nombre,p.comentarios,p.status,p.total,
				pr.nombre proveedor, CONCAT(u.nombre,' ',ifnull(u.apellido_pat,'')) usuarioalta,a.nombre almacen,
				p.fecha_validacion,CONCAT(uv.nombre,' ',ifnull(uv.apellido_pat,'')) usuariovalidacion,p.fecha_alta
		FROM pedido p
			LEFT JOIN proveedor pr ON pr.id=p.id_proveedor
			LEFT JOIN user u ON u.id=p.id_user
			LEFT JOIN user uv ON uv.id=p.user_validacion
			LEFT JOIN almacen a ON a.id=p.id_almacen
		WHERE p.id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result pedido");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_taller"] = $_SESSION['user_info']['id_taller'];
		$_request["id_user"]   = $_SESSION['user_id'];
		$_request["total"]   = $_request['total-globalrefaccion'];
		$data=fromArray($_request,'pedido',$this->db,"add");
		$sql= "INSERT INTO pedido (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		$id = $id["LAST_INSERT_ID()"];
		$refacciones      = $_request["id_refaccion"];
		$costorefaccion   = $_request["costorefaccion"];
		$preciorefaccion  = $_request["preciorefaccion"];
		$cantidad		  = $_request["cantidad_refaccion"];
		
		foreach ($refacciones as $key => $value) {
			$costo        = ($costorefaccion[$key])  ? $costorefaccion[$key]  : 0 ;
			$precio       = ($preciorefaccion[$key]) ? $preciorefaccion[$key] : 0 ;
			$cant         = $cantidad[$key];
			$totalcosto   = $costo * $cant;
			$id_refaccion = $value;
			$_requestpedidoref["id_pedido"]    = $id;
			$_requestpedidoref["id_refaccion"] = $id_refaccion;
			$_requestpedidoref["cantidad"]     = $cant;
			$_requestpedidoref["costo"]        = $costo;
			$_requestpedidoref["precio"]       = $precio;
			$_requestpedidoref["totalcosto"]   = $totalcosto;
			$objPedidoRefaccion = new PedidoRefaccion();
			if(!$objPedidoRefaccion->addAll($_requestpedidoref)){
				echo "Falla en insert pedido refaccion";
				exit;
			}
		}
		return $id;
	}
		//metodo que sirve validar entrada de pedido
	public function validar($id_pedido)
	{
		if(! intval( $id_pedido )){
			return false;
		}
		$id_pedido=$this->db->real_escape_string($id_pedido);
		$objPedidoRefaccion = new PedidoRefaccion();
		$data = $objPedidoRefaccion->getAllArr($id_pedido);
		foreach($data as $row){
			$id_almacen   = $row["id_almacen"];
			$id_refaccion = $row["id_refaccion"];
			$cantidad     = $row["cantidad"];
			$objinv = new Inventario();
			if( !$objinv->updateAll( $id_refaccion,$id_almacen,$cantidad ) ){
				echo "Falla en update inventario".$id_refaccion.' '.$id_almacen.' '.$cantidad ;
				exit;
			}
		}
		$sql= "UPDATE pedido SET fecha_validacion=CURDATE(),status='Validado',fecha_validacion=CURDATE(), user_validacion=".$_SESSION['user_id']."  WHERE id=".$id_pedido.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'pedido',$this->db,"update");
		$sql= "UPDATE pedido SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'pedido',$this->db,"update");	
		$sql= "UPDATE pedido SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
