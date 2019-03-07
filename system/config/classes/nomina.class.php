<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."nomina.auto.class.php");

class Nomina extends AutoNomina { 
	private $DB_TABLE = "nomina";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM nomina where status='active';";
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
		$sql= "SELECT * FROM nomina WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result nomina");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_taller"] = $_SESSION['user_info']['id_taller'];
		$_request["id_user"]   = $_SESSION['user_id'];
		$data=fromArray($_request,'nomina',$this->db,"add");
		$sql= "INSERT INTO nomina (".$data[0].") VALUES(".$data[1]."); ";
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
		$id_personal = $_request["id_personal"];
		$fecha 		 = $_request["fecha"];
		$cantidad	 = $_request["cantidad"];
		$detalles	 = $_request["detalles"];
		$totales	 = $_request["totalpersonal"];
		
		foreach ($id_personal as $key => $value) {
			$total        = ($totales[$key]) ? $totales[$key] : 0 ;
			$cant         = $cantidad[$key];
			$detalle      = $detalles[$key];
			$fecharow	  = $fecha[$key];
			$id_personal  = $value;
			$_requestper['id_nomina']    = $id;
			$_requestper['id_personal']  = $id_personal;
			$_requestper['detalles'] 	 = $detalle;
			$_requestper['cantidad']     = $cant;
			$_requestper['fecha']        = $fecharow;
			$_requestper['total']        = $total;
			$objNominaPersonal = new NominaPersonal();
			if(!$objNominaPersonal->addAll($_requestper)){
				echo "Falla en insert nomina persaonal";
				exit;
			}
		}
		
		return $id;
	}
	
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'nomina',$this->db,"update");
		$sql= "UPDATE nomina SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'nomina',$this->db,"update");	
		$sql= "UPDATE nomina SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para obtener todas las nominas disponibles que no estan vinculadas a un gasto
	public function getAllAvailable()
	{
		$sql = "SELECT * FROM nomina where status='active' and available=1;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}

}
