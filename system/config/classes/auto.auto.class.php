<?php 

	class AutoAuto {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $name_auto = "";
		protected $created_date = "";
		protected $token_expires = "";
		protected $token = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$auto = new Auto();
			$auto->setId( $id );
			return $auto;
		}
		public static function constructWithValues( $values ){
			$auto = new Auto();
			$auto->setValues( $values );
			return $auto;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setNameAuto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NAMEAUTO","s") ) 
 				$this->name_auto = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setTokenExpires( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOKENEXPIRES","s") ) 
 				$this->token_expires = $value;
		}
		
		public function setToken( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOKEN","s") ) 
 				$this->token = $value;
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
		
		public function getNameAuto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->name_auto) ;
 			}else{
 				return $this->name_auto ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
 			}
		}
		
		public function getTokenExpires($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token_expires) ;
 			}else{
 				return $this->token_expires ;
 			}
		}
		
		public function getToken($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token) ;
 			}else{
 				return $this->token ;
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
			$sql="SELECT * FROM auto WHERE id = ?";

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
			$this->setNameAuto( $res['name_auto'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setTokenExpires( $res['token_expires'] );
			$this->setToken( $res['token'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO auto SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `name_auto` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `token` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE auto SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `name_auto` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `token` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->name_auto );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->token_expires );
			$stmt->mbind_param( 's', $this->token );
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
				$sql = "UPDATE auto SET modified=UTC_TIMESTAMP(),";	

			if (in_array("name_auto",$fieldstoupdate)){
				$sql .= " `name_auto` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$sql .= " `token_expires` = ? ,";
			}
			if (in_array("token",$fieldstoupdate)){
				$sql .= " `token` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("name_auto",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nameAuto  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tokenExpires  );
			}
			if (in_array("token",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->token  );
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
			$sql="SELECT id FROM auto WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Auto();
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
