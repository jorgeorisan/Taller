<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "vehiculo_refaccion.auto.class.php");

class VehiculoRefaccion extends AutoVehiculoRefaccion { 
	private $DB_TABLE = "vehiculo_refaccion";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT vr.id, vr.id_refaccion, r.nombre, vr.detalles, vr.cantidad, vr.status, vr.created_date, IFNULL(vr.costo_aprox,0) costo_aprox, IFNULL((vr.cantidad*vr.costo_aprox),0) total_aprox 
		FROM vehiculo_refaccion vr
		JOIN refaccion r on vr.id_refaccion=r.id
		 where vr.status !='deleted' and vr.id_vehiculo=$id
		 ORDER BY  vr.created_date";
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
		$sql= "SELECT * FROM vehiculo_refaccion WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result vehiculo_refaccion");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		if(! intval( $_request["id_vehiculo"] )){
			return false;
		}

		$id=$this->db->real_escape_string( $_request["id_vehiculo"] );
		$refacciones      = $_request["id_refaccion"];
		$refaccionestotal = $_request["costorefaccion"];
		$cantidad		  = $_request["cantidad_refaccion"];
		$detallesref	  = $_request["detalles_refaccion"];
		
		foreach ($refacciones as $key => $value) {
			$total        = ($refaccionestotal[$key]) ? $refaccionestotal[$key] : 0 ;
			$cant         = $cantidad[$key];
			$detalle      = $detallesref[$key];
			$id_refaccion = $value;
			$sql  = "INSERT INTO vehiculo_refaccion (id_vehiculo,id_refaccion,detalles,cantidad,costo_aprox) VALUES(".$id. "," .$id_refaccion. ",'". $detalle. "'," .$cant. "," .$total. "); ";
			$res  = $this->db->query($sql);
			if(!$res){ die("Error al dar de alta la refaccion vehiculo".$sql); }
		}
		echo 1;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo_refaccion',$this->db,"update");
		$sql= "UPDATE vehiculo_refaccion SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request)
	{
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo_refaccion',$this->db,"update");	
		$sql= "UPDATE vehiculo_refaccion SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}