<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "cliente.auto.class.php");

class Cliente extends AutoCliente { 
	private $DB_TABLE = "cliente";

	public function getAjaxClienteRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
		$onPage=1 * $onPage;
		$numRows = 1 * $numRows;
		if ($onPage<1){$onPage=1;}
		if ($numRows<1 || $numRows>100 ){$numRows=10;}
		
		$sql= "SELECT count(l.id) as cnt FROM cliente l WHERE 1 ";//. $num ; 

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

		$sql= "SELECT * FROM cliente l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ; 

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
		$sql = "SELECT * FROM cliente where status='active';";
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
		$sql= "SELECT * FROM cliente WHERE id=$id;";
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
		$_request["id_user"]=$_SESSION['user_id'];
		$_request["id_taller"]=$_SESSION['user_info']['id_taller'];
		$data=fromArray($_request,'cliente',$this->db,"add");
		$sql= "INSERT INTO cliente (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'cliente',$this->db,"update");
		$sql= "UPDATE cliente SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'cliente',$this->db,"update");	
		$sql= "UPDATE cliente SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
