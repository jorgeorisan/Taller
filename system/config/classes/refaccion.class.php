<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "refaccion.auto.class.php");

class Refaccion extends AutoRefaccion { 
	private $DB_TABLE = "refaccion";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM refaccion where status='active';";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}	
		//metodo que sirve para obtener todos los datos de la tabla al buscar con filtros en orden de reparacion
	public function getAllArrSearch($marca=null,$submarca=null,$year=null)
	{
		$sql = "SELECT * FROM refaccion where status='active'";
		if ($marca)    { $sql .=" and id_marca=".$marca; }
		if ($submarca) { $sql .=" and id_submarca=".$submarca; }
		if ($year)     { $sql .=" and modelo='".$year."'"; }
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
		$sql= "SELECT * FROM refaccion WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result refaccion");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'refaccion',$this->db,"add");
		$sql= "INSERT INTO refaccion (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'refaccion',$this->db,"update");
		$sql= "UPDATE refaccion SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'refaccion',$this->db,"update");	
		$sql= "UPDATE refaccion SET $data[0]  WHERE id=".$id.";";
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
		$sql = "SELECT * FROM refaccion where status='active' and id_submarca=$id;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}	
	//metodo que sirve para obtener el precio de refaccion
	public function getPrecio($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT * FROM pedido_refaccion where status='active' and id_refaccion=$id order by id_pedido desc limit 1 ;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result refaccion");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}


}
