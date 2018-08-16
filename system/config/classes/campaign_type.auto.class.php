<?php 

	class AutoCampaignType {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $name = "";
		protected $created = "";
		protected $deleted = "";
		protected $user_deleted = 0;
		protected $status = "";
		protected $modified = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$campaignType = new CampaignType();
			$campaignType->setId( $id );
			return $campaignType;
		}
		public static function constructWithValues( $values ){
			$campaignType = new CampaignType();
			$campaignType->setValues( $values );
			return $campaignType;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setName( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NAME","s") ) 
 				$this->name = $value;
		}
		
		public function setCreated( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATED","s") ) 
 				$this->created = $value;
		}
		
		public function setDeleted( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETED","s") ) 
 				$this->deleted = $value;
		}
		
		public function setUserDeleted( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USERDELETED","i") ) 
 				$this->user_deleted = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setModified( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MODIFIED","s") ) 
 				$this->modified = $value;
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
		
		public function getName($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->name) ;
 			}else{
 				return $this->name ;
 			}
		}
		
		public function getCreated($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created) ;
 			}else{
 				return $this->created ;
 			}
		}
		
		public function getDeleted($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted) ;
 			}else{
 				return $this->deleted ;
 			}
		}
		
		public function getUserDeleted($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->user_deleted) ;
 			}else{
 				return $this->user_deleted ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getModified($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->modified) ;
 			}else{
 				return $this->modified ;
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
			$sql="SELECT * FROM campaign_type WHERE id = ?";

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
			$this->setName( $res['name'] );
			$this->setCreated( $res['created'] );
			$this->setDeleted( $res['deleted'] );
			$this->setUserDeleted( $res['user_deleted'] );
			$this->setStatus( $res['status'] );
			$this->setModified( $res['modified'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO campaign_type SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `name` = ? ,";
			$sql .= " `deleted` = ? ,";
			$sql .= " `user_deleted` = ? ,";
			$sql .= " `status` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE campaign_type SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `name` = ? ,";
			$sql .= " `deleted` = ? ,";
			$sql .= " `user_deleted` = ? ,";
			$sql .= " `status` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->name );
			$stmt->mbind_param( 's', $this->deleted );
			$stmt->mbind_param( 'i', $this->user_deleted );
			$stmt->mbind_param( 's', $this->status );
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
				$sql = "UPDATE campaign_type SET modified=UTC_TIMESTAMP(),";	

			if (in_array("name",$fieldstoupdate)){
				$sql .= " `name` = ? ,";
			}
			if (in_array("deleted",$fieldstoupdate)){
				$sql .= " `deleted` = ? ,";
			}
			if (in_array("user_deleted",$fieldstoupdate)){
				$sql .= " `user_deleted` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("name",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->name  );
			}
			if (in_array("deleted",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deleted  );
			}
			if (in_array("user_deleted",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->userDeleted  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
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
			$sql="SELECT id FROM campaign_type WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new CampaignType();
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
