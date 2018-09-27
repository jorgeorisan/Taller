<?php 

	class AutoImagenesVehiculo {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_vehiculo = 0;
		protected $nombre = "";
		protected $descripcion = "";
		protected $url = "";
		protected $status = "";
		protected $created_date = "";
		protected $deleted_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$imagenesVehiculo = new ImagenesVehiculo();
			$imagenesVehiculo->setId( $id );
			return $imagenesVehiculo;
		}
		public static function constructWithValues( $values ){
			$imagenesVehiculo = new ImagenesVehiculo();
			$imagenesVehiculo->setValues( $values );
			return $imagenesVehiculo;
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
		
		public function setNombre( $value ){ 				$this->nombre = $value;
		}
		
		public function setDescripcion( $value ){ 				$this->descripcion = $value;
		}
		
		public function setUrl( $value ){ 				$this->url = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
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
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getDescripcion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descripcion) ;
 			}else{
 				return $this->descripcion ;
 			}
		}
		
		public function getUrl($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->url) ;
 			}else{
 				return $this->url ;
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
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
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
			$sql="SELECT * FROM imagenes_vehiculo WHERE id = ?";

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
			$this->setNombre( $res['nombre'] );
			$this->setDescripcion( $res['descripcion'] );
			$this->setUrl( $res['url'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO imagenes_vehiculo SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `descripcion` = ? ,";
			$sql .= " `url` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE imagenes_vehiculo SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_vehiculo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `descripcion` = ? ,";
			$sql .= " `url` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_vehiculo );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->descripcion );
			$stmt->mbind_param( 's', $this->url );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->deleted_date );
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
				$sql = "UPDATE imagenes_vehiculo SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_vehiculo",$fieldstoupdate)){
				$sql .= " `id_vehiculo` = ? ,";
			}
			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("descripcion",$fieldstoupdate)){
				$sql .= " `descripcion` = ? ,";
			}
			if (in_array("url",$fieldstoupdate)){
				$sql .= " `url` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$sql .= " `deleted_date` = ? ,";
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
			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("descripcion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->descripcion  );
			}
			if (in_array("url",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->url  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deletedDate  );
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
			$sql="SELECT id FROM imagenes_vehiculo WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new ImagenesVehiculo();
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
