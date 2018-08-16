<?php

	class AutoUser {

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

		protected $validclass = true;
		protected $statusclass = array();


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
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") )
 				$this->id = $value;
		}

		public function setEmail( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") )
 				$this->email = $value;
		}

		public function setFirstName( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "FIRSTNAME","s") )
 				$this->first_name = $value;
		}

		public function setLastName( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "LASTNAME","s") )
 				$this->last_name = $value;
		}

		public function setInitials( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "INITIALS","s") )
 				$this->initials = $value;
		}

		public function setPassword( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "PASSWORD","s") )
 				$this->password = $value;
		}

		public function setType( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "TYPE","s") )
 				$this->type = $value;
		}

		public function setEnabled( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "ENABLED","i") )
 				$this->enabled = $value;
		}

		public function setDeleted( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "DELETED","i") )
 				$this->deleted = $value;
		}

		public function setToken( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "TOKEN","s") )
 				$this->token = $value;
		}

		public function setTokenExpires( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "TOKENEXPIRES","s") )
 				$this->token_expires = $value;
		}

		public function setModified( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "MODIFIED","s") )
 				$this->modified = $value;
		}

		public function setCreated( $value ){
			if ( $this->validclassateInput("/^.*$/", $value, "CREATED","s") )
 				$this->created = $value;
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

		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM user WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalidclass( "The ID not validclass." );

			// Get data
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( 'i', $id );
			$stmt->execute();
           // printf("Versión del servidor MySQL: %s\n", mysql_get_server_info());

			$res = $stmt->get_result();



			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalidclass( "Unable to retrieve information for ID. Please try again later, or contact support." );
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
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO user SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),";


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
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE user SET modified=UTC_TIMESTAMP(),";

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
			if ($this->getId()>0){
				$stmt->mbind_param( 'i', $this->id  );
			} // end save


			$stmt->execute();
			if ($this->getId()==0)
			{
				//echo '.................INSERTING...'.$this->getId();
				$this->setId( $this->db->insert_id );
			}
			return $this->getId();
		}


		public function updateFields($fieldstoupdate) {
			if ($this->getId()==0){ // insert new
				// only updates no save new here
			} else { // updated existing
				$sql = "UPDATE user SET modified=UTC_TIMESTAMP(),";

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
			$sql="SELECT id FROM user WHERE 1";
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
