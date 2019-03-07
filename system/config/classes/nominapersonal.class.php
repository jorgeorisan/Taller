<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."nomina_personal.auto.class.php");

class NominaPersonal extends AutoNominaPersonal { 
	private $DB_TABLE = "nomina_personal";

	
		//metodo que sirve para obtener todos los datos de la tabla
		public function getAllArr($id)
		{
			if(! intval( $id )){
				return false;
			}
			$sql = "
			SELECT pr.*,p.nombre,p.apellido_pat,p.apellido_mat,m.nombre marca,sb.nombre submarca,v.modelo
			FROM nomina_personal pr 
				LEFT JOIN nomina     n ON n.id=pr.id_nomina
				LEFT JOIN personal   p ON p.id=pr.id_personal
				LEFT JOIN vehiculo   v ON v.id=pr.id_vehiculo
				LEFT JOIN marca      m ON m.id=v.id_marca
				LEFT JOIN sub_marca sb ON sb.id=v.id_submarca
				where pr.status='active' and pr.id_nomina=$id;";
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
		$sql= "SELECT * FROM nomina_personal WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result nomina_personal");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'nomina_personal',$this->db,"add");
		$sql= "INSERT INTO nomina_personal (".$data[0].") VALUES(".$data[1]."); ";
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
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'nomina_personal',$this->db,"update");
		$sql= "UPDATE nomina_personal SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'nomina_personal',$this->db,"update");	
		$sql= "UPDATE nomina_personal SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
