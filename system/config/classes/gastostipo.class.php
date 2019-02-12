<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."gastos_tipo.auto.class.php");

class GastosTipo extends AutoGastosTipo { 
	private $DB_TABLE = "gastos_tipo";
	//metodo que sirve para obtener todos los datos de la tabla con filtro general
	public function getAllArrGral()
	{
		$sql = "SELECT * FROM gastos_tipo where status='active' and tipo='General';";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArrNormal()
	{
		$sql = "SELECT * FROM gastos_tipo where status='active' and tipo='Normal'";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM gastos_tipo where status='active';";
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
		$sql= "SELECT * FROM gastos_tipo WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result gastos_tipo");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'gastos_tipo',$this->db,"add");
		$sql= "INSERT INTO gastos_tipo (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'gastos_tipo',$this->db,"update");
		$sql= "UPDATE gastos_tipo SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'gastos_tipo',$this->db,"update");	
		$sql= "UPDATE gastos_tipo SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para obtener el precio de refaccion
	public function getPrecio($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id_taller=$_SESSION['user_info']['id_taller'];
		$id=$this->db->real_escape_string($id);
		$sql = "
		SELECT gr.cantidad, gr.total FROM gastos_registros gr 
			JOIN gastos g on gr.id_gastos=g.id
			where gr.status='active' and gr.id_gastostipo=$id 
			and g.id_taller=$id_taller
		order by id_gastos desc limit 1 ;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getPrecio gastostipo");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}

}
