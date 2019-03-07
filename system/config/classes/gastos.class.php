<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "gastos.auto.class.php");

class Gastos extends AutoGastos { 
	private $DB_TABLE = "gastos";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT g.id,g.nombre,g.total,u.nombre,u.apellido_pat,u.apellido_mat,g.created_date,gt.nombre gastostipo,gt.tipo
		FROM gastos g 
		left join gastos_tipo gt on gt.id=g.id_gastostipo  
		left join user u on u.id=g.id_user 
			where g.status='active';";
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
		$sql= "SELECT * FROM gastos WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result gastos");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_taller"] = $_SESSION['user_info']['id_taller'];
		$_request["id_user"]   = $_SESSION['user_id'];
		$_request["total"]     = $_request['total-globalgasto'];
		$data=fromArray($_request,'gastos',$this->db,"add");
		$sql= "INSERT INTO gastos (".$data[0].") VALUES(".$data[1]."); ";
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
		$gastostipo	= $_request["id_gastostiporegistros"];
		$total		= $_request["totalesregistros"];
		$cantidad	= $_request["cantidad"];
		$detalles	= $_request["detalles"];
		
		foreach ($gastostipo as $key => $value) {
			$total         = ($total[$key]) ? $total[$key] : 0 ;
			$cant          = $cantidad[$key];
			$detalle       = $detalles[$key];
			$id_gastostipo = $value;
			$_requestgastos["id_gastos"]     = $id;
			$_requestgastos["id_gastostipo"] = $id_gastostipo;
			$_requestgastos["detalles"] 	 = $detalle;
			$_requestgastos["cantidad"]      = $cant;
			$_requestgastos["total"]         = $total;
			$objGastosRegistros = new GastosRegistros();
			if(!$objGastosRegistros->addAll($_requestgastos)){
				echo "Falla en insert pedido refaccion";
				exit;
			}
			if($id_gastostipo==7){//nomina
				$objNomina = new Nomina();
				$_requestnomina["available"] = 0;
				if(!$objNomina->updateAll($detalle,$_requestnomina)){
					echo "Falla en update de nomina available";
					exit;
				}	
			}
		}
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'gastos',$this->db,"update");
		$sql= "UPDATE gastos SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'gastos',$this->db,"update");	
		$sql= "UPDATE gastos SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
