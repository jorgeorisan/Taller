<?php 

	class AutoTest {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $nombre = "";
		protected $modified = "";
		protected $created = "";
		protected $asasas = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$test = new Test();
			$test->setId( $id );
			return $test;
		}
		public static function constructWithValues( $values ){
			$test = new Test();
			$test->setValues( $values );
			return $test;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setModified( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MODIFIED","s") ) 
 				$this->modified = $value;
		}
		
		public function setCreated( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATED","s") ) 
 				$this->created = $value;
		}
		
		public function setAsasas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ASASAS","s") ) 
 				$this->asasas = $value;
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
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getModified($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->modified) ;
 			}else{
 				return $this->modified ;
 			}
		}
		
		public function getCreated($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created) ;
 			}else{
 				return $this->created ;
 			}
		}
		
		public function getAsasas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->asasas) ;
 			}else{
 				return $this->asasas ;
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
			$sql="SELECT * FROM test WHERE id = ?";

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
			$this->setNombre( $res['nombre'] );
			$this->setModified( $res['modified'] );
			$this->setCreated( $res['created'] );
			$this->setAsasas( $res['asasas'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO test SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `nombre` = ? ,";
			$sql .= " `asasas` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE test SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `nombre` = ? ,";
			$sql .= " `asasas` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->asasas );
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
				$sql = "UPDATE test SET modified=UTC_TIMESTAMP(),";	

			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("asasas",$fieldstoupdate)){
				$sql .= " `asasas` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("asasas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->asasas  );
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
			$sql="SELECT id FROM test WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Test();
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
