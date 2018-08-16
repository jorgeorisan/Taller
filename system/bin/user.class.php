<?php 

	class User {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $email = "";
		protected $first_name = "";
		protected $last_name = "";
		protected $initials = "";
		protected $password = "";
		protected $type = "";
		protected $enabled = 0;
		protected $deleted = 0;
		protected $token = "";
		protected $token_expires = "";
		protected $modified = "";
		protected $created = "";
		protected $authorsummary = "";
		protected $postimage_id = 0;

		protected $valid = true;
		protected $status = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$user = new User();
			$user->setId( $id );
			return $user;
		}
		public static function constructWithValues( $values ){
			$user = new User();
			$user->setValues( $values );
			return $user;
		}


	// Setter Methods
		public function setId( $value ){
			if ( $this->validateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setEmail( $value ){
			if ( $this->validateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
		}
		
		public function setFirstName( $value ){
			if ( $this->validateInput("/^.*$/", $value, "FIRSTNAME","s") ) 
 				$this->first_name = $value;
		}
		
		public function setLastName( $value ){
			if ( $this->validateInput("/^.*$/", $value, "LASTNAME","s") ) 
 				$this->last_name = $value;
		}
		
		public function setInitials( $value ){
			if ( $this->validateInput("/^.*$/", $value, "INITIALS","s") ) 
 				$this->initials = $value;
		}
		
		public function setPassword( $value ){
			if ( $this->validateInput("/^.*$/", $value, "PASSWORD","s") ) 
 				$this->password = $value;
		}
		
		public function setType( $value ){
			if ( $this->validateInput("/^.*$/", $value, "TYPE","s") ) 
 				$this->type = $value;
		}
		
		public function setEnabled( $value ){
			if ( $this->validateInput("/^.*$/", $value, "ENABLED","i") ) 
 				$this->enabled = $value;
		}
		
		public function setDeleted( $value ){
			if ( $this->validateInput("/^.*$/", $value, "DELETED","i") ) 
 				$this->deleted = $value;
		}
		
		public function setToken( $value ){
			if ( $this->validateInput("/^.*$/", $value, "TOKEN","s") ) 
 				$this->token = $value;
		}
		
		public function setTokenExpires( $value ){
			if ( $this->validateInput("/^.*$/", $value, "TOKENEXPIRES","s") ) 
 				$this->token_expires = $value;
		}
		
		public function setModified( $value ){
			if ( $this->validateInput("/^.*$/", $value, "MODIFIED","s") ) 
 				$this->modified = $value;
		}
		
		public function setCreated( $value ){
			if ( $this->validateInput("/^.*$/", $value, "CREATED","s") ) 
 				$this->created = $value;
		}
		
		public function setAuthorsummary( $value ){
			if ( $this->validateInput("/^.*$/", $value, "AUTHORSUMMARY","s") ) 
 				$this->authorsummary = $value;
		}
		
		public function setPostimageId( $value ){
			if ( $this->validateInput("/^.*$/", $value, "POSTIMAGEID","i") ) 
 				$this->postimage_id = $value;
		}
		
		public function setValid( $value ){
			if ( $this->validateInput('/^(true|false)$/', ( $value ) ? 'true' : 'false', "Valid",'s') )
				$this->valid = $value;
		}

		public function setStatus( $value ){
			if ( ! is_array($this->status) ){
				$this->status=array();
			}

			$this->status[] = $value;
			$this->status = array_unique($this->status );
			
		}


	// Getter Methods
		public function getId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id) ;
 			}else{
 				return $this->id ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
 			}
		}
		
		public function getFirstName($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->first_name) ;
 			}else{
 				return $this->first_name ;
 			}
		}
		
		public function getLastName($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->last_name) ;
 			}else{
 				return $this->last_name ;
 			}
		}
		
		public function getInitials($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->initials) ;
 			}else{
 				return $this->initials ;
 			}
		}
		
		public function getPassword($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->password) ;
 			}else{
 				return $this->password ;
 			}
		}
		
		public function getType($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->type) ;
 			}else{
 				return $this->type ;
 			}
		}
		
		public function getEnabled($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->enabled) ;
 			}else{
 				return $this->enabled ;
 			}
		}
		
		public function getDeleted($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted) ;
 			}else{
 				return $this->deleted ;
 			}
		}
		
		public function getToken($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token) ;
 			}else{
 				return $this->token ;
 			}
		}
		
		public function getTokenExpires($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token_expires) ;
 			}else{
 				return $this->token_expires ;
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
		
		public function getAuthorsummary($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->authorsummary) ;
 			}else{
 				return $this->authorsummary ;
 			}
		}
		
		public function getPostimageId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->postimage_id) ;
 			}else{
 				return $this->postimage_id ;
 			}
		}
		
		public function getValid(){
			return $this->valid;
		}
		public function getStatus(){
			return  $this->status ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM users WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalid( "The ID not valid." );

			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( 'i', $id );
			$stmt->execute();

			$res = $stmt->get_result();
			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalid( "Unable to retrieve information for ID. Please try again later, or contact support." );
			}

			$this->setId( $res['id'] );
			$this->setEmail( $res['email'] );
			$this->setFirstName( $res['first_name'] );
			$this->setLastName( $res['last_name'] );
			$this->setInitials( $res['initials'] );
			$this->setPassword( $res['password'] );
			$this->setType( $res['type'] );
			$this->setEnabled( $res['enabled'] );
			$this->setDeleted( $res['deleted'] );
			$this->setToken( $res['token'] );
			$this->setTokenExpires( $res['token_expires'] );
			$this->setModified( $res['modified'] );
			$this->setCreated( $res['created'] );
			$this->setAuthorsummary( $res['authorsummary'] );
			$this->setPostimageId( $res['postimage_id'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO users SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `email` = ? ,";
			$sql .= " `first_name` = ? ,";
			$sql .= " `last_name` = ? ,";
			$sql .= " `initials` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `type` = ? ,";
			$sql .= " `enabled` = ? ,";
			$sql .= " `deleted` = ? ,";
			$sql .= " `token` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `authorsummary` = ? ,";
			$sql .= " `postimage_id` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE users SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `email` = ? ,";
			$sql .= " `first_name` = ? ,";
			$sql .= " `last_name` = ? ,";
			$sql .= " `initials` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `type` = ? ,";
			$sql .= " `enabled` = ? ,";
			$sql .= " `deleted` = ? ,";
			$sql .= " `token` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `authorsummary` = ? ,";
			$sql .= " `postimage_id` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->email );
			$stmt->mbind_param( 's', $this->first_name );
			$stmt->mbind_param( 's', $this->last_name );
			$stmt->mbind_param( 's', $this->initials );
			$stmt->mbind_param( 's', $this->password );
			$stmt->mbind_param( 's', $this->type );
			$stmt->mbind_param( 'i', $this->enabled );
			$stmt->mbind_param( 'i', $this->deleted );
			$stmt->mbind_param( 's', $this->token );
			$stmt->mbind_param( 's', $this->token_expires );
			$stmt->mbind_param( 's', $this->authorsummary );
			$stmt->mbind_param( 'i', $this->postimage_id );
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
				$sql = "UPDATE users SET modified=UTC_TIMESTAMP(),";	

			if (in_array("email",$fieldstoupdate)){
				$sql .= " `email` = ? ,";
			}
			if (in_array("first_name",$fieldstoupdate)){
				$sql .= " `first_name` = ? ,";
			}
			if (in_array("last_name",$fieldstoupdate)){
				$sql .= " `last_name` = ? ,";
			}
			if (in_array("initials",$fieldstoupdate)){
				$sql .= " `initials` = ? ,";
			}
			if (in_array("password",$fieldstoupdate)){
				$sql .= " `password` = ? ,";
			}
			if (in_array("type",$fieldstoupdate)){
				$sql .= " `type` = ? ,";
			}
			if (in_array("enabled",$fieldstoupdate)){
				$sql .= " `enabled` = ? ,";
			}
			if (in_array("deleted",$fieldstoupdate)){
				$sql .= " `deleted` = ? ,";
			}
			if (in_array("token",$fieldstoupdate)){
				$sql .= " `token` = ? ,";
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$sql .= " `token_expires` = ? ,";
			}
			if (in_array("authorsummary",$fieldstoupdate)){
				$sql .= " `authorsummary` = ? ,";
			}
			if (in_array("postimage_id",$fieldstoupdate)){
				$sql .= " `postimage_id` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("email",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->email  );
			}
			if (in_array("first_name",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->firstName  );
			}
			if (in_array("last_name",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->lastName  );
			}
			if (in_array("initials",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->initials  );
			}
			if (in_array("password",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->password  );
			}
			if (in_array("type",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->type  );
			}
			if (in_array("enabled",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->enabled  );
			}
			if (in_array("deleted",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->deleted  );
			}
			if (in_array("token",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->token  );
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tokenExpires  );
			}
			if (in_array("authorsummary",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->authorsummary  );
			}
			if (in_array("postimage_id",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->postimageId  );
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
			$sql="SELECT id FROM users WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new User();
				$retval[$id[0]]->load($id[0]);
			}
			return $retval;
		}



	// Private Support Functions
		protected function validateInput( $pcre, $input, $field , $bind_type) {
			//if ( ! $this->valid )
			//	return $this->valid;

			if ( ! preg_match($pcre, $input) ){ 
				return $this->killInvalid( "The input provided for the field '$field' is not valid. Value provided: ".htmlentities($input),$field);
			}else{
				unset($this->status[$field]);
				if (empty($this->status)){$this->valid=true;}
			}

			return true;
		}
		protected function killInvalid( $msg, $field="General Error" ){
			$this->status[$field] = $msg;
			$this->valid = false;
			return false;
		}

}
