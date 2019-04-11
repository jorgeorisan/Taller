<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "vehiculo_servicio.auto.class.php");

class VehiculoServicio extends AutoVehiculoServicio { 
	private $DB_TABLE = "vehiculo_servicio";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id,$All=false)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$deleted = (!$All) ? "and vr.status !='deleted' " : "";
		$sql = "SELECT vr.id, vr.id_servicio, r.codigo, r.nombre, vr.detalles, vr.status, vr.created_date, IFNULL(vr.total,0) total
		FROM vehiculo_servicio vr
		JOIN servicio r on vr.id_servicio=r.id
		 where  vr.id_vehiculo=$id $deleted
		  ORDER BY  vr.created_date";
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
		$sql= "SELECT * FROM vehiculo_servicio WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result vehiculo_servicio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		if(! intval( $_request["id_vehiculo"] )){
			return false;
		}

		$id=$this->db->real_escape_string( $_request["id_vehiculo"] );
		$servicios      = $_request["id_servicio"];
		$serviciostotal = $_request["total_servicio"];
		$detallesserv   = ($_request["detalles_servicio"]) ? $_request["detalles_servicio"] : [] ;
		foreach ($servicios as $key => $value) {
			$total       = $serviciostotal[$key];
			$detalle     = $detallesserv[$key];
			$id_servicio = $value;
			$_request['id_vehiculo'] = $id;
			$_request['id_servicio'] = $id_servicio;
			$_request['detalles'] 	 = $detalle;
			$_request['total']       = $total;
			$this->Addonebyone($_request);
		}
		$vehiculos = new Vehiculo();
		$vehiculo = $vehiculos->getTable($id);
		if($vehiculo['status_vehiculo']=='Terminado y firmado' || $vehiculo['status_vehiculo']=='Terminado sin firma'){
			$_requestvehiculo['status_vehiculo'] = 'Pendiente';
			$vehiculos->updateAll($id,$_requestvehiculo);
			$vehiculos->MoverVehiculoPendiente($id);
			$a=new Auth();
			$a->error_log('Error en vehiculo estatus incorrecto servicios'.$id);
		}
		echo $id;
	}
	public function Addonebyone($_request){
		$sql  = "INSERT INTO vehiculo_servicio (id_vehiculo,id_servicio,detalles,total) VALUES(".$_request['id_vehiculo']. "," .$_request['id_servicio']. ",'". $_request['detalles']. "' ,"  .$_request['total']. "); ";
		$res  = $this->db->query($sql);
		if(!$res){ die("Error al dar de alta el servicio vehiculo:".$sql); }
		$sql  = "SELECT LAST_INSERT_ID();";//. $num ;
		$res  = $this->db->query($sql);
		$set  = array();
		$id   = "";
		if(!$res) die("Error getting result"); 
		else
			while ($row = $res->fetch_assoc())
				$id= $row;
		
		$id = $id["LAST_INSERT_ID()"];
		$_request['id_vehiculoservicio'] = $id;
		$_request['status_anterior'] 	 = "";
		$_request['status'] 			 = 'active';
		$_request['fecha_inicio']        = date('Y-m-d H:i:s');
		$_request['comentarios']         = '';
		$u = new HistorialVehiculoservicio();
		$idHS=$u->addAll($_request);
		if($idHS>0){ }else{	die("Error al dar de alta el historial servicio vehiculo:");  }
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo_servicio',$this->db,"update");
		$sql= "UPDATE vehiculo_servicio SET $data[0]  WHERE id=".$id." and status != 'deleted';";
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
		$_request["status"] = "deleted";
		$_request["deleted_date"] = date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo_servicio',$this->db,"update");	
		$sql= "UPDATE vehiculo_servicio SET $data[0]  WHERE id=".$id;
		$u  = new HistorialVehiculoservicio();
		if($res = $u->getLastStatus($id)){
			$_request['id_vehiculoservicio'] = $id;
			$_request['status_anterior'] 	 = $res['status'];
			$_request['status'] 			 = 'deleted';
			$_request['fecha_inicio']        = date('Y-m-d H:i:s');
			$_request['comentarios']         = '';
			$idHS=$u->addAll($_request);
			if($idHS>0){
				$row=$this->db->query($sql);
				if(!$row){
					return false;
				}else{
					
					return true;
				}
			}else{
				return false;
			}
		}
	}


}
