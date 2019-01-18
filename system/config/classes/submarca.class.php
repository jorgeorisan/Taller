<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "sub_marca.auto.class.php");

class SubMarca extends AutoSubMarca { 
	private $DB_TABLE = "sub_marca";

	
	   //metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM sub_marca where status='active';";
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
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * FROM sub_marca WHERE id=$id;";
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
		$data=fromArray($_request,'sub_marca',$this->db,"add");
		$sql= "INSERT INTO sub_marca (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";   //. $num ;
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
		$data=fromArray($_request,'sub_marca',$this->db,"update");
		$sql= "UPDATE sub_marca SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'sub_marca',$this->db,"update");	
		$sql= "UPDATE sub_marca SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

	   //metodo que sirve para obtener todos los datos de la  marca
	public function getAllbyid($id)
	{
		$sql = "SELECT * FROM sub_marca where status='active' and id_marca=$id;";
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
