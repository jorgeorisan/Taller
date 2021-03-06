<?php 

	class AutoProveedor {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $nombre = "";
		protected $rfc = "";
		protected $direccion = "";
		protected $telefono = "";
		protected $status = "";
		protected $created_date = "";
		protected $banco = "";
		protected $num_cta = "";
		protected $email = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$proveedor = new Proveedor();
			$proveedor->setId( $id );
			return $proveedor;
		}
		public static function constructWithValues( $values ){
			$proveedor = new Proveedor();
			$proveedor->setValues( $values );
			return $proveedor;
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
		
		public function setRfc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RFC","s") ) 
 				$this->rfc = $value;
		}
		
		public function setDireccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DIRECCION","s") ) 
 				$this->direccion = $value;
		}
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setBanco( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "BANCO","s") ) 
 				$this->banco = $value;
		}
		
		public function setNumCta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMCTA","s") ) 
 				$this->num_cta = $value;
		}
		
		public function setEmail( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
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
		
		public function getRfc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->rfc) ;
 			}else{
 				return $this->rfc ;
 			}
		}
		
		public function getDireccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->direccion) ;
 			}else{
 				return $this->direccion ;
 			}
		}
		
		public function getTelefono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->telefono) ;
 			}else{
 				return $this->telefono ;
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
		
		public function getBanco($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->banco) ;
 			}else{
 				return $this->banco ;
 			}
		}
		
		public function getNumCta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_cta) ;
 			}else{
 				return $this->num_cta ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
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
			$sql="SELECT * FROM proveedor WHERE id = ?";

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
			$this->setRfc( $res['rfc'] );
			$this->setDireccion( $res['direccion'] );
			$this->setTelefono( $res['telefono'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setBanco( $res['banco'] );
			$this->setNumCta( $res['num_cta'] );
			$this->setEmail( $res['email'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO proveedor SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `nombre` = ? ,";
			$sql .= " `rfc` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql .= " `telefono` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `banco` = ? ,";
			$sql .= " `num_cta` = ? ,";
			$sql .= " `email` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE proveedor SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `nombre` = ? ,";
			$sql .= " `rfc` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql .= " `telefono` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `banco` = ? ,";
			$sql .= " `num_cta` = ? ,";
			$sql .= " `email` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->rfc );
			$stmt->mbind_param( 's', $this->direccion );
			$stmt->mbind_param( 's', $this->telefono );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->banco );
			$stmt->mbind_param( 's', $this->num_cta );
			$stmt->mbind_param( 's', $this->email );
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
				$sql = "UPDATE proveedor SET modified=UTC_TIMESTAMP(),";	

			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("rfc",$fieldstoupdate)){
				$sql .= " `rfc` = ? ,";
			}
			if (in_array("direccion",$fieldstoupdate)){
				$sql .= " `direccion` = ? ,";
			}
			if (in_array("telefono",$fieldstoupdate)){
				$sql .= " `telefono` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("banco",$fieldstoupdate)){
				$sql .= " `banco` = ? ,";
			}
			if (in_array("num_cta",$fieldstoupdate)){
				$sql .= " `num_cta` = ? ,";
			}
			if (in_array("email",$fieldstoupdate)){
				$sql .= " `email` = ? ,";
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
			if (in_array("rfc",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->rfc  );
			}
			if (in_array("direccion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->direccion  );
			}
			if (in_array("telefono",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->telefono  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("banco",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->banco  );
			}
			if (in_array("num_cta",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->numCta  );
			}
			if (in_array("email",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->email  );
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
			$sql="SELECT id FROM proveedor WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Proveedor();
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
