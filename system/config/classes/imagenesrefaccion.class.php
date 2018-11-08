<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "imagenes_refaccion.auto.class.php");

class ImagenesRefaccion extends AutoImagenesRefaccion { 
	private $DB_TABLE = "imagenes_refaccion";

		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT * FROM imagenes_refaccion where id_refaccion=".$id." AND status='active';";
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
		$sql= "SELECT * FROM imagenes_refaccion WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result imagenes_refaccion");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	   //metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'imagenes_refaccion',$this->db,"add");
		$sql= "INSERT INTO imagenes_refaccion (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'imagenes_refaccion',$this->db,"update");
		$sql= "UPDATE imagenes_refaccion SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	   //metodo que sirve para hacer delete
	public function deleteAll($id,$_request=null)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
	
		$sql= "UPDATE imagenes_refaccion SET status='deleted'  WHERE id_refaccion=".$id." and status='active';";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

	   //metodo que sirve para agregar nueva imagen
	public function addImage($id,$name)
	{
		$url="auto_".$id."/images/".$name;

		$sql  = "INSERT INTO imagenes_refaccion (id_refaccion,nombre,url) VALUES(".$id.",'".$name."','".$url."'); ";
		$res  = $this->db->query($sql);
		$sql  = "SELECT LAST_INSERT_ID();";   //. $num ;
		$res  = $this->db->query($sql);
		$set  = array();
		$id   = "";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		return $id["LAST_INSERT_ID()"];
	}
}
