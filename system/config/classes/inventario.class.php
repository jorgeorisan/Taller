<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR."base". DIRECTORY_SEPARATOR . "inventario.auto.class.php");

class Inventario extends AutoInventario { 
	private $DB_TABLE = "inventario";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT i.id,a.nombre almacen,t.nombre taller,m.nombre marca,sm.nombre submarca
			, i.id_refaccion,r.modelo,i.existencia,i.status,r.nombre refaccion FROM inventario i
		JOIN almacen a ON i.id_almacen=a.id
		JOIN taller t ON a.id_taller=t.id
		JOIN refaccion r ON i.id_refaccion=r.id
		JOIN sub_marca sm ON r.id_submarca=sm.id
		JOIN marca m ON r.id_marca=m.id
		where i.status='active'
		AND a.id_taller=$id;";
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
		$sql= "SELECT * FROM inventario WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result inventario");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'inventario',$this->db,"add");
		$sql= "INSERT INTO inventario (".$data[0].") VALUES(".$data[1]."); ";
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
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para hacer update
	public function updateAll($idrefaccion,$idalmacen,$cant,$rename=false)
	{
		$_request["updated_date"] = date("Y-m-d H:i:s");
		$_request["id_refaccion"] = $idrefaccion;
		$_request["id_almacen"]   = $idalmacen;
	
		if ( $objinventario=$this->existeRefaccion( $idrefaccion,$idalmacen ) ){
			$id_invent = $objinventario['id'];
			$nuevaexistencia = ($rename) ? $cant : $objinventario['existencia']+$cant ;
			$_request["existencia"]  = $nuevaexistencia;
		}else{
			$_request["existencia"]  = $cant;
			$id_invent = $this->addAll($_request);
		}
		$data=fromArray($_request,'inventario',$this->db,"update");
		$sql= "UPDATE inventario SET $data[0]  WHERE id=".$id_invent.";";
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
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'inventario',$this->db,"update");	
		$sql= "UPDATE inventario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo para saber si existe un inventario
	public function existeRefaccion($idrefaccion,$idalmacen){
		if(! intval( $idrefaccion ))	return false;
		if(! intval( $idalmacen ))	return false;

		$idrefaccion=$this->db->real_escape_string($idrefaccion);
		$idalmacen=$this->db->real_escape_string($idalmacen);

		$sql= "SELECT * FROM inventario WHERE id_refaccion=$idrefaccion AND id_almacen=$idalmacen limit 1;";
		$res=$this->db->query($sql);
		if(!$res)
			return false;

		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}
	public function getTotalesKardex($idrefaccion,$idalmacen){
		if(! intval( $idrefaccion ))	return false;
		if(! intval( $idalmacen ))	return false;

		$idrefaccion = $this->db->real_escape_string($idrefaccion);
		$idalmacen = $this->db->real_escape_string($idalmacen);
		echo $sql="
		SELECT  inventario.id_refaccion,inventario.id_almacen,
				inventario.refaccion,inventario.almacen,
				(ifnull(entradas.totalentradas,0)+ifnull(pedidos.entradapedido,0)) totalentradas ,
				ifnull(salidas.totalsalidas,0) totalsalidas,
				((ifnull(entradas.totalentradas,0)+ifnull(pedidos.entradapedido,0))-ifnull(salidas.totalsalidas,0)) totalkardex,
				ifnull(inventario.existencia,0) existencia
		FROM(
			SELECT 	id_refaccion,id_almacen,existencia, r.nombre refaccion, a.nombre almacen
			FROM inventario i
			JOIN refaccion r ON i.id_refaccion=r.id
			JOIN almacen a ON i.id_almacen=a.id
		)as inventario
		LEFT JOIN (
			SELECT vr.id_refaccion,r.nombre refaccion,a.nombre almacen,ifnull(sum(vr.cantidad),0) totalentradas, hvr.id_almacen
			FROM systemmy_tallerhp.historial_vehiculorefaccion hvr
				JOIN vehiculo_refaccion vr ON hvr.id_vehiculorefaccion=vr.id
				JOIN refaccion r ON vr.id_refaccion=r.id
				JOIN almacen a ON hvr.id_almacen=a.id
			WHERE hvr.status in ('Recibida','Proporcionado-Cliente')
			group by vr.id_refaccion, hvr.id_almacen
		) AS entradas ON entradas.id_refaccion=inventario.id_refaccion AND entradas.id_almacen=inventario.id_almacen
		LEFT JOIN (
			SELECT vr.id_refaccion,ifnull(sum(vr.cantidad),0) totalsalidas, hvr.id_almacen
			FROM systemmy_tallerhp.historial_vehiculorefaccion hvr
			JOIN vehiculo_refaccion vr ON hvr.id_vehiculorefaccion=vr.id
			WHERE hvr.status in ('Entregada','Reenvio')
			group by vr.id_refaccion, hvr.id_almacen 
		) AS salidas ON inventario.id_refaccion=salidas.id_refaccion AND inventario.id_almacen=salidas.id_almacen
		LEFT JOIN (
			SELECT pr.id_refaccion,p.id_almacen , IFNULL(sum(pr.cantidad),0) entradapedido,
				CASE
					WHEN pr.status = 'active' THEN 'Pendiente'
					WHEN pr.status = 'Validado' THEN 'Entrada'
					ELSE pr.status 
				END as tipo,
				pr.status 
			FROM systemmy_tallerhp.pedido_refaccion pr
			LEFT JOIN pedido p ON pr.id_pedido=p.id
				WHERE pr.status ='Validado' 
			GROUP BY pr.id_refaccion,p.id_almacen
		) AS pedidos ON  inventario.id_refaccion=pedidos.id_refaccion AND inventario.id_almacen=pedidos.id_almacen
		WHERE inventario.id_refaccion=$idrefaccion and inventario.id_almacen=$idalmacen";
		$res=$this->db->query($sql);
		if(!$res)
			return false;

		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}
	

	public function getTableKardex($idrefaccion,$idalmacen){
		if(! intval( $idrefaccion ))	return false;
		if(! intval( $idalmacen ))	return false;

		$idrefaccion = $this->db->real_escape_string($idrefaccion);
		$idalmacen = $this->db->real_escape_string($idalmacen);
		$sql="
		SELECT vr.id_refaccion,r.nombre refaccion,a.nombre almacen,vr.cantidad , hvr.id_almacen,hvr.status,
			u.nombre usuario,p.nombre personal,hvr.comentarios,hvr.fecha_inicio fecha,
			CASE
				WHEN hvr.status = 'Recibida'			  THEN 'Entrada'
				WHEN hvr.status = 'Proporcionado-Cliente' THEN 'Entrada'
				WHEN hvr.status = 'Entregada' 			  THEN 'Salida'
				WHEN hvr.status = 'Reenvio' 			  THEN 'Salida'
				ELSE hvr.status 
			END as tipo
		FROM systemmy_tallerhp.historial_vehiculorefaccion hvr
			JOIN vehiculo_refaccion vr ON hvr.id_vehiculorefaccion=vr.id
			JOIN refaccion r ON vr.id_refaccion=r.id
			JOIN almacen a ON hvr.id_almacen=a.id
			JOIN user u ON hvr.id_user=u.id 
			JOIN personal p ON hvr.id_personal=p.id
		WHERE hvr.status in ('Recibida','Proporcionado-Cliente','Entregada','Reenvio')
			AND vr.id_refaccion=$idrefaccion and hvr.id_almacen=$idalmacen
		ORDER BY 
			CASE
				WHEN hvr.status = 'Recibida'			  THEN 'Entrada'
				WHEN hvr.status = 'Proporcionado-Cliente' THEN 'Entrada'
				WHEN hvr.status = 'Entregada' 			  THEN 'Salida'
				WHEN hvr.status = 'Reenvio' 			  THEN 'Salida'
				ELSE hvr.status 
		END,hvr.fecha_inicio ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result".$sql); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
		
	}

	public function getTablePedidos($idrefaccion,$idalmacen){
		if(! intval( $idrefaccion ))	return false;
		if(! intval( $idalmacen ))	return false;

		$idrefaccion = $this->db->real_escape_string($idrefaccion);
		$idalmacen   = $this->db->real_escape_string($idalmacen);
		$sql="
		SELECT pr.id_pedido,u.nombre usuario, p.nombre pedido,pr.id_refaccion,r.nombre refaccion,a.nombre almacen,pr.cantidad,
			CASE
				WHEN pr.status = 'active' THEN 'Pendiente'
				WHEN pr.status = 'Validado' THEN 'Entrada'
				ELSE pr.status 
			END as tipo,
			CASE
				WHEN pr.status = 'active' THEN 'Pendiente'
				ELSE pr.status 
			END as status,
			pr.costo,pr.precio,pr.totalcosto,pr.created_date fecha 
		FROM systemmy_tallerhp.pedido_refaccion pr
		LEFT JOIN refaccion r ON pr.id_refaccion=r.id
		LEFT JOIN pedido p ON pr.id_pedido=p.id
		LEFT JOIN almacen a ON p.id_almacen=a.id
		LEFT JOIN user u ON p.id_user=u.id
		WHERE pr.status !='deleted'
			AND pr.id_refaccion=$idrefaccion and p.id_almacen=$idalmacen
		ORDER BY  
		pr.status, pr.created_date ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result".$sql); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
		
	}


}
