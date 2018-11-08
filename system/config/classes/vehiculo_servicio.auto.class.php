<?php 

	class AutoVehiculoServicio {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_vehiculo = 0;
		protected $id_servicio = 0;
		protected $detalles = "";
		protected $total = 0;
		protected $status = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $updated_user = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$vehiculoServicio = new VehiculoServicio();
			$vehiculoServicio->setId( $id );
			return $vehiculoServicio;
		}
		public static function constructWithValues( $values ){
			$vehiculoServicio = new VehiculoServicio();
			$vehiculoServicio->setValues( $values );
			return $vehiculoServicio;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdVehiculo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVEHICULO","i") ) 
 				$this->id_vehiculo = $value;
		}
		
		public function setIdServicio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDSERVICIO","i") ) 
 				$this->id_servicio = $value;
		}
		
		public function setDetalles( $value ){ 				$this->detalles = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setUpdatedUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDUSER","i") ) 
 				$this->updated_user = $value;
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
		
		public function getIdVehiculo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_vehiculo) ;
 			}else{
 				return $this->id_vehiculo ;
 			}
		}
		
		public function getIdServicio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_servicio) ;
 			}else{
 				return $this->id_servicio ;
 			}
		}
		
		public function getDetalles($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->detalles) ;
 			}else{
 				return $this->detalles ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
 			}
		}
		
		public function getUpdatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_date) ;
 			}else{
 				return $this->updated_date ;
 			}
		}
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
 			}
		}
		
		public function getUpdatedUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_user) ;
 			}else{
 				return $this->updated_user ;
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
			$sql="SELECT * FROM vehiculo_servicio WHERE id = ?";

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
			$this->setIdVehiculo( $res['id_vehiculo'] );
			$this->setIdServicio( $res['id_servicio'] );
			$this->setDetalles( $res['detalles'] );
			$this->setTotal( $res['total'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setUpdatedUser( $res['updated_user'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO vehiculo_servicio SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `id_servicio` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `updated_user` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE vehiculo_servicio SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `id_servicio` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `updated_user` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_vehiculo );
			$stmt->mbind_param( 'i', $this->id_servicio );
			$stmt->mbind_param( 's', $this->detalles );
			$stmt->mbind_param( 'd', $this->total );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
			$stmt->mbind_param( 'i', $this->updated_user );
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
				$sql = "UPDATE vehiculo_servicio SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_vehiculo",$fieldstoupdate)){
				$sql .= " `id_vehiculo` = ? ,";
			}
			if (in_array("id_servicio",$fieldstoupdate)){
				$sql .= " `id_servicio` = ? ,";
			}
			if (in_array("detalles",$fieldstoupdate)){
				$sql .= " `detalles` = ? ,";
			}
			if (in_array("total",$fieldstoupdate)){
				$sql .= " `total` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$sql .= " `updated_date` = ? ,";
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$sql .= " `deleted_date` = ? ,";
			}
			if (in_array("updated_user",$fieldstoupdate)){
				$sql .= " `updated_user` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_vehiculo",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idVehiculo  );
			}
			if (in_array("id_servicio",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idServicio  );
			}
			if (in_array("detalles",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->detalles  );
			}
			if (in_array("total",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->total  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->updatedDate  );
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deletedDate  );
			}
			if (in_array("updated_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->updatedUser  );
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
			$sql="SELECT id FROM vehiculo_servicio WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new VehiculoServicio();
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
