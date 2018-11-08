<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "servicio_paquete.auto.class.php");

class ServicioPaquete extends AutoServicioPaquete { 
	private $DB_TABLE = "servicio_paquete";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT * FROM servicio_paquete where id_serviciopaquete=$id ;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr".$sql); }
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
		$sql= "SELECT * FROM servicio_paquete WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result servicio paquete");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}
		//metodo que sirve para hacer obtener datos en el editar
	public function getTableServicios($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql= "
			SELECT ss.id,ss.codigo,ss.nombre,s.nombre paquete, s.descripcion
			FROM servicio_paquete sp 
			INNER JOIN servicio s on s.id=sp.id_serviciopaquete 
			INNER JOIN servicio ss on ss.id=sp.id_servicio
			WHERE sp.id_serviciopaquete=$id;";
		$res=$this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr".$sql); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($idservicio, $idpaquete)
	{
		if(! intval( $idservicio ) || ! intval( $idpaquete )){
			return false;
		}
		$idservicio=$this->db->real_escape_string($idservicio);
		$iduser=$this->db->real_escape_string($idpaquete);
		$sql= "INSERT INTO servicio_paquete (id_servicio,id_serviciopaquete) VALUES(".$idservicio.",".$idpaquete."); ";
		$res= $this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";
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
		$data=fromArray($_request,'servicio_paquete',$this->db,"update");
		$sql= "UPDATE servicio_paquete SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id)
	{
		if(! intval( $id )){ return false;	}
		$id  = $this->db->real_escape_string($id);
		$sql = "DELETE FROM servicio_paquete  WHERE id_serviciopaquete=".$id.";";
		$row = $this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
