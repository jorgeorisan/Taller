<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "historial_vehiculorefaccion.auto.class.php");

class HistorialVehiculorefaccion extends AutoHistorialVehiculorefaccion { 
	private $DB_TABLE = "historial_vehiculorefaccion";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		$sql = "SELECT * FROM historial_vehiculorefaccion where status!='deleted' and id_vehiculorefaccion=$id;";
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
		$sql= "SELECT * FROM historial_vehiculorefaccion WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial_vehiculorefaccion");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_user"] = $this->db->real_escape_string($_SESSION['user_id']);
		$id_vehiculoref      = $this->db->real_escape_string($_request["id_vehiculorefaccion"]);
		$status     		 = $this->db->real_escape_string($_request["status"]);
		$cometarios     	 = $this->db->real_escape_string($_request["comentarios"]);
		$data=fromArray($_request,'historial_vehiculorefaccion',$this->db,"add");
		$sql= "INSERT INTO historial_vehiculorefaccion (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;

			$sql = "UPDATE vehiculo_refaccion SET status='". $status ."'  WHERE id=".$id_vehiculoref.";";
			$row = $this->db->query($sql);
			if(!$row)
				die("Error updating VehiculoRefaccion");
			
		}
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'historial_vehiculorefaccion',$this->db,"update");
		$sql= "UPDATE historial_vehiculorefaccion SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'historial_vehiculorefaccion',$this->db,"update");	
		$sql= "UPDATE historial_vehiculorefaccion SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
