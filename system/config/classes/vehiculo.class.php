<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "vehiculo.auto.class.php");

class Vehiculo extends AutoVehiculo { 
	private $DB_TABLE = "vehiculo";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM vehiculo where status='active';";
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
		$sql= "SELECT * FROM vehiculo WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_taller'] = $_SESSION['user_info']['id_taller'];
		//$_request['id_user']   = $_SESSION['id_user'];
		$data = fromArray($_request,'vehiculo',$this->db,"add");
		$sql  = "INSERT INTO vehiculo (".$data[0].") VALUES(".$data[1]."); ";
		$res  = $this->db->query($sql);
		$sql  = "SELECT LAST_INSERT_ID();";//. $num ;
		$res  = $this->db->query($sql);
		$set  = array();
		$id   = "";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		$id = $id["LAST_INSERT_ID()"];
		$servicios      = $_request["id_servicio"];
		$serviciostotal = $_request["total_servicio"];
		$detallesserv   = $_request["detalles_servicio"];
		foreach ($servicios as $key => $value) {
			$total       = $serviciostotal[$key];
			$detalle     = $detallesserv[$key];
			$id_servicio = $value;
			$sql  = "INSERT INTO vehiculo_servicio (id_vehiculo,id_servicio,detalles,total) VALUES(".$id. "," .$id_servicio. ",'". $detalle. "' ,"  .$total. "); ";
			$res  = $this->db->query($sql);
			if(!$res){ die("Error al dar de alta el servicio vehiculo:".$sql); }
		}
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
		return $id;
	}
	//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo',$this->db,"update");
		$sql= "UPDATE vehiculo SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'vehiculo',$this->db,"update");	
		$sql= "UPDATE vehiculo SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	


}
