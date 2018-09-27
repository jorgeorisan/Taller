<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "permiso_user.auto.class.php");

class PermisoUser extends AutoPermisoUser { 
	private $DB_TABLE = "permiso_user";

	public function getAjaxPermisoUserRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
		$onPage=1 * $onPage;
		$numRows = 1 * $numRows;
		if ($onPage<1){$onPage=1;}
		if ($numRows<1 || $numRows>100 ){$numRows=10;}
		
		$sql= "SELECT count(l.id) as cnt FROM permiso_user l WHERE 1 ";//. $num ; 

			if (!$stmt = $this->db->prepare( $sql )){die("bad query");}
		$stmt->execute();
		$res = $stmt->get_result();
		$records = 0;
		if($row = $res->fetch_assoc()){
			$records=$row["cnt"]; 
		}
		$res->free();
		$stmt->close();

		$total=ceil($records/$numRows); // number of pages
		$retval=array("records"=>$records , "page"=>$onPage , "total"=>$total , "rows"=>array() );

		if (in_array($sortIndex,array("id","name"))){}else{$sortIndex="id";} 
		if (in_array($shortOrder,array("asc","desc"))){}else{$shortOrder="asc";} 

		$sql= "SELECT * FROM permiso_user l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ; 

			if (!$stmt = $this->db->prepare( $sql )){echo $sql;die("bad query2");}
			$stmt->execute();
		$res = $stmt->get_result();

		while($row = $res->fetch_assoc()){
			foreach($row as $kk=>$vv){$row[$kk]=htmlentities($vv);}
			//echo ss;
			//print_r($row);
			$retval["rows"][] = $row; 
		}
		$res->free();
		$stmt->close();
	 	//print_r($retval);
		//echo json_encode($retval, JSON_HEX_APOS);
		//echo json_last_error (  );
		//echo json_last_error_msg();
		return json_encode($retval);
		
	}
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM permiso_user where status='active';";
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
		$sql= "SELECT * FROM permiso_user WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result permiso_user");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'permiso_user',$this->db,"add");
		$sql= "INSERT INTO permiso_user (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'permiso_user',$this->db,"update");
		$sql= "UPDATE permiso_user SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'permiso_user',$this->db,"update");	
		$sql= "UPDATE permiso_user SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

	//metodo que sirve para obtener los permisos del usuario
	public function getpermisouser($id, $section, $page)
	{
		if(! intval( $id )){
			return false;
		}
		$id      = $this->db->real_escape_string($id);
		$section = $this->db->real_escape_string($section);
		$page    = $this->db->real_escape_string($page);
		$sql = "SELECT pu.id , p.section , p.page FROM permiso_user pu 
				INNER JOIN permiso p on p.id=pu.id_permiso
				WHERE pu.id_user=".$id."
				AND p.section='".$section."'
				AND p.page='".$page."';";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getpermisouser");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}
	//metodo que sirve para obtener las secciones que le correspnden al usuario
	public function getsectionsuser($id,$section)
	{
		if(! intval( $id )){
			return false;
		}
		$id      = $this->db->real_escape_string($id);
		$section = $this->db->real_escape_string($section);
		$sql = "SELECT pu.id , p.section , p.page FROM permiso_user pu 
				INNER JOIN permiso p on p.id=pu.id_permiso
				WHERE pu.id_user='".$id."'
				AND p.section='".$section."';";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getsectionsuser");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}

}
