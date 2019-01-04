<?php 

	class AutoPedido {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_proveedor = 0;
		protected $id_user = 0;
		protected $id_almacentaller = 0;
		protected $nombre = "";
		protected $total = 0;
		protected $status = "";
		protected $comentarios = "";
		protected $fecha_alta = "";
		protected $created_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$pedido = new Pedido();
			$pedido->setId( $id );
			return $pedido;
		}
		public static function constructWithValues( $values ){
			$pedido = new Pedido();
			$pedido->setValues( $values );
			return $pedido;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdProveedor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPROVEEDOR","i") ) 
 				$this->id_proveedor = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIdAlmacentaller( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDALMACENTALLER","i") ) 
 				$this->id_almacentaller = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setComentarios( $value ){ 				$this->comentarios = $value;
		}
		
		public function setFechaAlta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAALTA","s") ) 
 				$this->fecha_alta = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
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
		
		public function getIdProveedor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_proveedor) ;
 			}else{
 				return $this->id_proveedor ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getIdAlmacentaller($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_almacentaller) ;
 			}else{
 				return $this->id_almacentaller ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
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
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getFechaAlta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_alta) ;
 			}else{
 				return $this->fecha_alta ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
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
			$sql="SELECT * FROM pedido WHERE id = ?";

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
			$this->setIdProveedor( $res['id_proveedor'] );
			$this->setIdUser( $res['id_user'] );
			$this->setIdAlmacentaller( $res['id_almacentaller'] );
			$this->setNombre( $res['nombre'] );
			$this->setTotal( $res['total'] );
			$this->setStatus( $res['status'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setFechaAlta( $res['fecha_alta'] );
			$this->setCreatedDate( $res['created_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO pedido SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_proveedor` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `id_almacentaller` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE pedido SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_proveedor` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `id_almacentaller` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_proveedor );
			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 'i', $this->id_almacentaller );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 'd', $this->total );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->comentarios );
			$stmt->mbind_param( 's', $this->fecha_alta );
			$stmt->mbind_param( 's', $this->created_date );
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
				$sql = "UPDATE pedido SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_proveedor",$fieldstoupdate)){
				$sql .= " `id_proveedor` = ? ,";
			}
			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("id_almacentaller",$fieldstoupdate)){
				$sql .= " `id_almacentaller` = ? ,";
			}
			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("total",$fieldstoupdate)){
				$sql .= " `total` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$sql .= " `comentarios` = ? ,";
			}
			if (in_array("fecha_alta",$fieldstoupdate)){
				$sql .= " `fecha_alta` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_proveedor",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idProveedor  );
			}
			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("id_almacentaller",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idAlmacentaller  );
			}
			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("total",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->total  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentarios  );
			}
			if (in_array("fecha_alta",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaAlta  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
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
			$sql="SELECT id FROM pedido WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Pedido();
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
