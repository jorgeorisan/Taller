<?php 

	class AutoVehiculoRefaccion {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_vehiculo = 0;
		protected $id_refaccion = 0;
		protected $detalles = "";
		protected $cantidad = 0;
		protected $costo_aprox = 0;
		protected $costo_real = 0;
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
			$vehiculoRefaccion = new VehiculoRefaccion();
			$vehiculoRefaccion->setId( $id );
			return $vehiculoRefaccion;
		}
		public static function constructWithValues( $values ){
			$vehiculoRefaccion = new VehiculoRefaccion();
			$vehiculoRefaccion->setValues( $values );
			return $vehiculoRefaccion;
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
		
		public function setIdRefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDREFACCION","i") ) 
 				$this->id_refaccion = $value;
		}
		
		public function setDetalles( $value ){ 				$this->detalles = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setCostoAprox( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOAPROX","d") ) 
 				$this->costo_aprox = $value;
		}
		
		public function setCostoReal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOREAL","d") ) 
 				$this->costo_real = $value;
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
		
		public function getIdRefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_refaccion) ;
 			}else{
 				return $this->id_refaccion ;
 			}
		}
		
		public function getDetalles($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->detalles) ;
 			}else{
 				return $this->detalles ;
 			}
		}
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getCostoAprox($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo_aprox) ;
 			}else{
 				return $this->costo_aprox ;
 			}
		}
		
		public function getCostoReal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo_real) ;
 			}else{
 				return $this->costo_real ;
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
			$sql="SELECT * FROM vehiculo_refaccion WHERE id = ?";

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
			$this->setIdRefaccion( $res['id_refaccion'] );
			$this->setDetalles( $res['detalles'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setCostoAprox( $res['costo_aprox'] );
			$this->setCostoReal( $res['costo_real'] );
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
				$sql = "INSERT INTO vehiculo_refaccion SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `costo_aprox` = ? ,";
			$sql .= " `costo_real` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `updated_user` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE vehiculo_refaccion SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `costo_aprox` = ? ,";
			$sql .= " `costo_real` = ? ,";
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
			$stmt->mbind_param( 'i', $this->id_refaccion );
			$stmt->mbind_param( 's', $this->detalles );
			$stmt->mbind_param( 'd', $this->cantidad );
			$stmt->mbind_param( 'd', $this->costo_aprox );
			$stmt->mbind_param( 'd', $this->costo_real );
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
				$sql = "UPDATE vehiculo_refaccion SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_vehiculo",$fieldstoupdate)){
				$sql .= " `id_vehiculo` = ? ,";
			}
			if (in_array("id_refaccion",$fieldstoupdate)){
				$sql .= " `id_refaccion` = ? ,";
			}
			if (in_array("detalles",$fieldstoupdate)){
				$sql .= " `detalles` = ? ,";
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$sql .= " `cantidad` = ? ,";
			}
			if (in_array("costo_aprox",$fieldstoupdate)){
				$sql .= " `costo_aprox` = ? ,";
			}
			if (in_array("costo_real",$fieldstoupdate)){
				$sql .= " `costo_real` = ? ,";
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
			if (in_array("id_refaccion",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idRefaccion  );
			}
			if (in_array("detalles",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->detalles  );
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->cantidad  );
			}
			if (in_array("costo_aprox",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->costoAprox  );
			}
			if (in_array("costo_real",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->costoReal  );
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
			$sql="SELECT id FROM vehiculo_refaccion WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new VehiculoRefaccion();
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
