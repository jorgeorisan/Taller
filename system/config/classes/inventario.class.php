<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR."base". DIRECTORY_SEPARATOR . "inventario.auto.class.php");

class Inventario extends AutoInventario { 
	private $DB_TABLE = "inventario";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT i.id,a.nombre almacen,t.nombre taller,m.nombre marca,sm.nombre submarca
			, i.id_refaccion,r.modelo,i.existencia,i.status,r.nombre refaccion FROM inventario i
		JOIN almacen a ON i.id_almacen=a.id
		JOIN taller t ON a.id_taller=t.id
		JOIN refaccion r ON i.id_refaccion=r.id
		JOIN sub_marca sm ON r.id_submarca=sm.id
		JOIN marca m ON r.id_marca=m.id
		where i.status='active'
		AND a.id_taller=$id;";
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
		$sql= "SELECT * FROM inventario WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result inventario");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'inventario',$this->db,"add");
		$sql= "INSERT INTO inventario (".$data[0].") VALUES(".$data[1]."); ";
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
	public function updateAll($idrefaccion,$idalmacen,$cant)
	{
		$_request["updated_date"] = date("Y-m-d H:i:s");
		$_request["id_refaccion"] = $idrefaccion;
		$_request["id_almacen"]   = $idalmacen;
		
		if ( $objinventario=$this->existeRefaccion( $idrefaccion,$idalmacen ) ){
			$id_invent = $objinventario['id'];
			$_request["existencia"]  = $objinventario['existencia']+$cant;
		}else{
			$_request["existencia"]  = $cant;
			$id_invent = $this->addAll($_request);
		}
		$data=fromArray($_request,'inventario',$this->db,"update");
		$sql= "UPDATE inventario SET $data[0]  WHERE id=".$id_invent.";";
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
		$data=fromArray($_request,'inventario',$this->db,"update");	
		$sql= "UPDATE inventario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo para saber si existe un inventario
	public function existeRefaccion($idrefaccion,$idalmacen){
	
		$sql= "SELECT * FROM inventario WHERE id_refaccion=$idrefaccion AND id_almacen=$idalmacen;";
		$res=$this->db->query($sql);
		if(!$res)
			return false;

		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}


}
