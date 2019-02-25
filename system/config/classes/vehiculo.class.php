<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "vehiculo.auto.class.php");

class Vehiculo extends AutoVehiculo { 
	private $DB_TABLE = "vehiculo";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM vehiculo where status!='deleted';";
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
		$sql= "SELECT * FROM vehiculo WHERE id=$id;";
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
		$_request['id_taller'] = $_SESSION['user_info']['id_taller'];
		$_request['id_user']   = $_SESSION['user_id'];
		$data = fromArray($_request,'vehiculo',$this->db,"add");
		$sql  = "INSERT INTO vehiculo (".$data[0].") VALUES(".$data[1]."); ";
		$res  = $this->db->query($sql);
		$sql  = "SELECT LAST_INSERT_ID();";//. $num ;
		$res  = $this->db->query($sql);
		$set  = array();
		$id   = "";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		$id = $id["LAST_INSERT_ID()"];
		$servicios      = $_request["id_servicio"];
		$serviciostotal = $_request["total_servicio"];
		$detallesserv   = $_request["detalles_servicio"];
		foreach ($servicios as $key => $value) {
			$total       = $serviciostotal[$key];
			$detalle     = $detallesserv[$key];
			$id_servicio = $value;
			$_request['id_vehiculo'] = $id;
			$_request['id_servicio'] = $id_servicio;
			$_request['detalles'] 	 = $detalle;
			$_request['total']       = $total;
			$VS = new VehiculoServicio();
			$idHS = $VS->Addonebyone($_request);
			if($idHS>0){}else{ die("Error al insertar vehiculo servicio"); }
		}
		$refacciones      = $_request["id_refaccion"];
		$refaccionestotal = $_request["costorefaccion"];
		$cantidad		  = $_request["cantidad_refaccion"];
		$detallesref	  = $_request["detalles_refaccion"];
		
		foreach ($refacciones as $key => $value) {
			$total        = ($refaccionestotal[$key]) ? $refaccionestotal[$key] : 0 ;
			$cant         = $cantidad[$key];
			$detalle      = $detallesref[$key];
			$id_refaccion = $value;
			$_request['id_vehiculo'] = $id;
			$_request['id_refaccion']= $id_refaccion;
			$_request['detalles'] 	 = $detalle;
			$_request['cantidad']    = $cant;
			$_request['costo_aprox'] = $total;
			$VS = new VehiculoRefaccion();
			$idHS = $VS->Addonebyone($_request);
			if($idHS>0){}else{ die("Error al insertar vehiculo refaccion"); }
		}
		return $id;
	}
	//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo',$this->db,"update");
		$sql= "UPDATE vehiculo SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return $id;
		}
	}
	//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="deleted";
		$_request["status_vehiculo"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'vehiculo',$this->db,"update");	
		$sql= "UPDATE vehiculo SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			$this->MoverVehiculoEliminado($id);
			return true;
		}
	}
	// metodo para obtener el porcentaje de terminacion de un vehiculo
	public function getPorcentaje($id){
		$objref       = new VehiculoRefaccion();
		$dataref      = $objref->getAllArr($id,false);
		$objser       = new VehiculoServicio();
		$dataser      = $objser->getAllArr($id,false);
		$cont 		  = 0;
		$contterminado= 0;
		foreach($dataser as $key => $row) {
			$status = htmlentities($row['status']);
			switch ($status) {
				case 'Realizado': $contterminado++;	break;
				default: break;
			}  
			$cont++;
		} 
		foreach($dataref as $key => $row) {
			$status = htmlentities($row['status']);
			switch ($row['status']) {
				case 'Instalado':
				case 'Perdida-daño':		
				$contterminado++;	break;
				default: break;
			}  
			$cont++;
		} 
		
		$porcent = ($cont && $contterminado) ? ($contterminado*100)/$cont: 0 ;
				
		return $porcent;
	}
	// metodo para actualizar el estatus de un vehiculo
	public function updateStatusVehiculo($id,$statusvehiculo=false){
		
		$objref       = new VehiculoRefaccion();
		$dataref      = $objref->getAllArr($id,false);
		$objser       = new VehiculoServicio();
		$dataser      = $objser->getAllArr($id,false);
		$cont 		  = 0;
		$contterminado= 0;
		foreach($dataser as $key => $row) {
			$status = htmlentities($row['status']);
			switch ($status) {
				case 'Realizado': $contterminado++;	break;
				default: break;
			}  
			$cont++;
		} 
		foreach($dataref as $key => $row) {
			$status = htmlentities($row['status']);
			switch ($row['status']) {
				case 'Instalado':
				case 'Perdida-daño':		
				$contterminado++;	break;
				default: break;
			}  
			$cont++;
		} 
		if($cont==$contterminado){
			$_request['status_vehiculo']   = 'Terminado sin firma';
			if($statusvehiculo){
				$_request['status_vehiculo'] = 'Terminado y firmado';
				$_request['fecha_firma']     = date('Y-m-d H:i:s');
				$this->updateAll($id,$_request);
				$this->MoverVehiculoTerminado($_POST['id_vehiculo']);
			}
			$this->updateAll($id,$_request);
		}
	}
	function MoverVehiculoTerminado($id){
		$from  = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;
		$to    = EXPEDIENTE_DIRTER .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;

		//Abro el directorio que voy a leer
		$dir = opendir($from);

		//Recorro el directorio para leer los archivos que tiene
		while(($file = readdir($dir)) !== false){
			//Leo todos los archivos excepto . y ..
			if(strpos($file, '.') !== 0){
				//Copio el archivo manteniendo el mismo nombre en la nueva carpeta
				if(exec('move "'.$from.'" "'.$to.'"')){
					echo 1;
				}
				
			}
		}
	}
	function MoverVehiculoEliminado($id){
		$from  = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;
		$to    = EXPEDIENTE_DIRELIMINADO .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;

		//Abro el directorio que voy a leer
		$dir = opendir($from);

		//Recorro el directorio para leer los archivos que tiene
		while(($file = readdir($dir)) !== false){
			//Leo todos los archivos excepto . y ..
			if(strpos($file, '.') !== 0){
				//Copio el archivo manteniendo el mismo nombre en la nueva carpeta
				if(exec('move "'.$from.'" "'.$to.'"')){
					echo 1;
				}
				
			}
		}
	}
	function getCarpetaExpediente($id){
		$data = $this->getTable($id);
		if($data['status_vehiculo']=='Terminado y firmado') 
			$carpetaexpediente = 'expedientesterminados';
		elseif($data['status_vehiculo']=='Eliminado') 
			$carpetaexpediente = 'expedienteseliminados';
		else
			$carpetaexpediente =  'expediente';

		return $carpetaexpediente;
	}


}
