<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "historial_vehiculoservicio.auto.class.php");

class HistorialVehiculoservicio extends AutoHistorialVehiculoservicio { 
	private $DB_TABLE = "historial_vehiculoservicio";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		$sql = "SELECT * FROM historial_vehiculoservicio where status!='deleted' and id_vehiculoservicio=$id;";
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
		$sql= "SELECT * FROM historial_vehiculoservicio WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial_vehiculoservicio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve paraobtener el ultimo movimiento del estatus
	public function getLastStatus($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * FROM historial_vehiculoservicio WHERE id_vehiculoservicio=$id  order by id desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial_vehiculoservicio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_user"] = $this->db->real_escape_string($_SESSION['user_id']);
		$id_vehiculoserv     = $this->db->real_escape_string($_request["id_vehiculoservicio"]);
		$status     		 = $this->db->real_escape_string($_request["status"]);
		$cometarios     	 = $this->db->real_escape_string($_request["comentarios"]);
		$data=fromArray($_request,'historial_vehiculoservicio',$this->db,"add");
		$sql= "INSERT INTO historial_vehiculoservicio (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;

			$sql = "UPDATE vehiculo_servicio SET status='". $status ."'  WHERE id=".$id_vehiculoserv.";";
			$row = $this->db->query($sql);
			if(!$row)
				die("Error updating VehiculoServicio");
			
		}
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'historial_vehiculoservicio',$this->db,"update");
		$sql= "UPDATE historial_vehiculoservicio SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'historial_vehiculoservicio',$this->db,"update");	
		$sql= "UPDATE historial_vehiculoservicio SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
