<?php 

	class AutoHistorialVehiculorefaccion {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_vehiculorefaccion = 0;
		protected $id_user = 0;
		protected $status_anterior = "";
		protected $status = "";
		protected $comentarios = "";
		protected $created_date = "";
		protected $fecha_inicio = "";
		protected $fecha_estimada = "";
		protected $fecha_fin = "";
		protected $id_userasigned = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$historialVehiculorefaccion = new HistorialVehiculorefaccion();
			$historialVehiculorefaccion->setId( $id );
			return $historialVehiculorefaccion;
		}
		public static function constructWithValues( $values ){
			$historialVehiculorefaccion = new HistorialVehiculorefaccion();
			$historialVehiculorefaccion->setValues( $values );
			return $historialVehiculorefaccion;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdVehiculorefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVEHICULOREFACCION","i") ) 
 				$this->id_vehiculorefaccion = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setStatusAnterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUSANTERIOR","s") ) 
 				$this->status_anterior = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setComentarios( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMENTARIOS","s") ) 
 				$this->comentarios = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setFechaInicio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAINICIO","s") ) 
 				$this->fecha_inicio = $value;
		}
		
		public function setFechaEstimada( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAESTIMADA","s") ) 
 				$this->fecha_estimada = $value;
		}
		
		public function setFechaFin( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAFIN","s") ) 
 				$this->fecha_fin = $value;
		}
		
		public function setIdUserasigned( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSERASIGNED","i") ) 
 				$this->id_userasigned = $value;
		}
		
		public function setValidclass( $value ){
			if ( $this->validclassateInput('/^(true|false)$/', ( $value ) ? 'true' : 'false', "Validclass",'s') )
				$this->validclass = $value;
		}

		public function setStatusclass( $value ){
			if ( ! is_array($this->statusclass) ){
				$this->statusclass=array();
			}

			$this->statusclass[] = $value;
			$this->statusclass = array_unique($this->statusclass );
			
		}


	// Getter Methods
		public function getId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id) ;
 			}else{
 				return $this->id ;
 			}
		}
		
		public function getIdVehiculorefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_vehiculorefaccion) ;
 			}else{
 				return $this->id_vehiculorefaccion ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getStatusAnterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status_anterior) ;
 			}else{
 				return $this->status_anterior ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
 			}
		}
		
		public function getFechaInicio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_inicio) ;
 			}else{
 				return $this->fecha_inicio ;
 			}
		}
		
		public function getFechaEstimada($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_estimada) ;
 			}else{
 				return $this->fecha_estimada ;
 			}
		}
		
		public function getFechaFin($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_fin) ;
 			}else{
 				return $this->fecha_fin ;
 			}
		}
		
		public function getIdUserasigned($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_userasigned) ;
 			}else{
 				return $this->id_userasigned ;
 			}
		}
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM historial_vehiculorefaccion WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalidclass( "The ID not validclass." );

			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( 'i', $id );
			$stmt->execute();

			$res = $stmt->get_result();
			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalidclass( "Unable to retrieve information for ID. Please try again later, or contact support." );
			}

			$this->setId( $res['id'] );
			$this->setIdVehiculorefaccion( $res['id_vehiculorefaccion'] );
			$this->setIdUser( $res['id_user'] );
			$this->setStatusAnterior( $res['status_anterior'] );
			$this->setStatus( $res['status'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setFechaInicio( $res['fecha_inicio'] );
			$this->setFechaEstimada( $res['fecha_estimada'] );
			$this->setFechaFin( $res['fecha_fin'] );
			$this->setIdUserasigned( $res['id_userasigned'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO historial_vehiculorefaccion SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_vehiculorefaccion` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `status_anterior` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `fecha_inicio` = ? ,";
			$sql .= " `fecha_estimada` = ? ,";
			$sql .= " `fecha_fin` = ? ,";
			$sql .= " `id_userasigned` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE historial_vehiculorefaccion SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_vehiculorefaccion` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `status_anterior` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `fecha_inicio` = ? ,";
			$sql .= " `fecha_estimada` = ? ,";
			$sql .= " `fecha_fin` = ? ,";
			$sql .= " `id_userasigned` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_vehiculorefaccion );
			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 's', $this->status_anterior );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->comentarios );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->fecha_inicio );
			$stmt->mbind_param( 's', $this->fecha_estimada );
			$stmt->mbind_param( 's', $this->fecha_fin );
			$stmt->mbind_param( 'i', $this->id_userasigned );
			if ($this->getId()>0){
				$stmt->mbind_param( 'i', $this->id  );
			} // end save

			$stmt->execute();
			if ($this->getId()==0){
				$this->setId( $this->db->insert_id );
			}
			return $this->getId();
		}
		

		public function updateFields($fieldstoupdate) {
			if ($this->getId()==0){ // insert new
				// only updates no save new here
			} else { // updated existing
				$sql = "UPDATE historial_vehiculorefaccion SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_vehiculorefaccion",$fieldstoupdate)){
				$sql .= " `id_vehiculorefaccion` = ? ,";
			}
			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("status_anterior",$fieldstoupdate)){
				$sql .= " `status_anterior` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$sql .= " `comentarios` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("fecha_inicio",$fieldstoupdate)){
				$sql .= " `fecha_inicio` = ? ,";
			}
			if (in_array("fecha_estimada",$fieldstoupdate)){
				$sql .= " `fecha_estimada` = ? ,";
			}
			if (in_array("fecha_fin",$fieldstoupdate)){
				$sql .= " `fecha_fin` = ? ,";
			}
			if (in_array("id_userasigned",$fieldstoupdate)){
				$sql .= " `id_userasigned` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_vehiculorefaccion",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idVehiculorefaccion  );
			}
			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("status_anterior",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->statusAnterior  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentarios  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("fecha_inicio",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaInicio  );
			}
			if (in_array("fecha_estimada",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaEstimada  );
			}
			if (in_array("fecha_fin",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaFin  );
			}
			if (in_array("id_userasigned",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUserasigned  );
			}
			if ($this->getId()>0){
				$stmt->mbind_param( 'i', $this->getId()  );
			}

			$stmt->execute();
			//if ($this->getId()==0){
			//	$this->setId( $this->db->insert_id );
			//}
			return $this->getId();
		}  // updateFields
		

		public function getAll() {
			$sql="SELECT id FROM historial_vehiculorefaccion WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new HistorialVehiculorefaccion();
				$retval[$id[0]]->load($id[0]);
			}
			return $retval;
		}



	// Private Support Functions
		protected function validclassateInput( $pcre, $input, $field , $bind_type) {
			//if ( ! $this->validclass )
			//	return $this->validclass;

			if ( ! preg_match($pcre, $input) ){ 
				return $this->killInvalidclass( "The input provided for the field '$field' is not validclass. Value provided: ".htmlentities($input),$field);
			}else{
				unset($this->statusclass[$field]);
				if (empty($this->statusclass)){$this->validclass=true;}
			}

			return true;
		}
		protected function killInvalidclass( $msg, $field="General Error" ){
			$this->statusclass[$field] = $msg;
			$this->validclass = false;
			return false;
		}

}
