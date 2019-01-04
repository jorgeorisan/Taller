<?php 

	class AutoInventario {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_almacen = 0;
		protected $id_refaccion = 0;
		protected $existencia = 0;
		protected $status = "";
		protected $created_date = "";
		protected $updated_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$inventario = new Inventario();
			$inventario->setId( $id );
			return $inventario;
		}
		public static function constructWithValues( $values ){
			$inventario = new Inventario();
			$inventario->setValues( $values );
			return $inventario;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdAlmacen( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDALMACEN","i") ) 
 				$this->id_almacen = $value;
		}
		
		public function setIdRefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDREFACCION","i") ) 
 				$this->id_refaccion = $value;
		}
		
		public function setExistencia( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXISTENCIA","d") ) 
 				$this->existencia = $value;
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
		
		public function getIdAlmacen($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_almacen) ;
 			}else{
 				return $this->id_almacen ;
 			}
		}
		
		public function getIdRefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_refaccion) ;
 			}else{
 				return $this->id_refaccion ;
 			}
		}
		
		public function getExistencia($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->existencia) ;
 			}else{
 				return $this->existencia ;
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
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM inventario WHERE id = ?";

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
			$this->setIdAlmacen( $res['id_almacen'] );
			$this->setIdRefaccion( $res['id_refaccion'] );
			$this->setExistencia( $res['existencia'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO inventario SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_almacen` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `existencia` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE inventario SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_almacen` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `existencia` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_almacen );
			$stmt->mbind_param( 'i', $this->id_refaccion );
			$stmt->mbind_param( 'd', $this->existencia );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
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
				$sql = "UPDATE inventario SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_almacen",$fieldstoupdate)){
				$sql .= " `id_almacen` = ? ,";
			}
			if (in_array("id_refaccion",$fieldstoupdate)){
				$sql .= " `id_refaccion` = ? ,";
			}
			if (in_array("existencia",$fieldstoupdate)){
				$sql .= " `existencia` = ? ,";
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
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_almacen",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idAlmacen  );
			}
			if (in_array("id_refaccion",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idRefaccion  );
			}
			if (in_array("existencia",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->existencia  );
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
			$sql="SELECT id FROM inventario WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Inventario();
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
