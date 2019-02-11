<?php 

	class AutoGastosRegistros {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_gastostipo = 0;
		protected $id_gastos = 0;
		protected $detalles = "";
		protected $status = "";
		protected $created_date = "";
		protected $deleted_date = "";
		protected $updated_date = "";
		protected $cantidad = 0;
		protected $total = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$gastosRegistros = new GastosRegistros();
			$gastosRegistros->setId( $id );
			return $gastosRegistros;
		}
		public static function constructWithValues( $values ){
			$gastosRegistros = new GastosRegistros();
			$gastosRegistros->setValues( $values );
			return $gastosRegistros;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdGastostipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDGASTOSTIPO","i") ) 
 				$this->id_gastostipo = $value;
		}
		
		public function setIdGastos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDGASTOS","i") ) 
 				$this->id_gastos = $value;
		}
		
		public function setDetalles( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DETALLES","s") ) 
 				$this->detalles = $value;
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
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
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
		
		public function getIdGastostipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_gastostipo) ;
 			}else{
 				return $this->id_gastostipo ;
 			}
		}
		
		public function getIdGastos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_gastos) ;
 			}else{
 				return $this->id_gastos ;
 			}
		}
		
		public function getDetalles($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->detalles) ;
 			}else{
 				return $this->detalles ;
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
		
		public function getUpdatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_date) ;
 			}else{
 				return $this->updated_date ;
 			}
		}
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
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
			$sql="SELECT * FROM gastos_registros WHERE id = ?";

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
			$this->setIdGastostipo( $res['id_gastostipo'] );
			$this->setIdGastos( $res['id_gastos'] );
			$this->setDetalles( $res['detalles'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setTotal( $res['total'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO gastos_registros SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_gastostipo` = ? ,";
			$sql .= " `id_gastos` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `total` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE gastos_registros SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_gastostipo` = ? ,";
			$sql .= " `id_gastos` = ? ,";
			$sql .= " `detalles` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `total` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_gastostipo );
			$stmt->mbind_param( 'i', $this->id_gastos );
			$stmt->mbind_param( 's', $this->detalles );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->deleted_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 'd', $this->cantidad );
			$stmt->mbind_param( 'd', $this->total );
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
				$sql = "UPDATE gastos_registros SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_gastostipo",$fieldstoupdate)){
				$sql .= " `id_gastostipo` = ? ,";
			}
			if (in_array("id_gastos",$fieldstoupdate)){
				$sql .= " `id_gastos` = ? ,";
			}
			if (in_array("detalles",$fieldstoupdate)){
				$sql .= " `detalles` = ? ,";
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
			if (in_array("updated_date",$fieldstoupdate)){
				$sql .= " `updated_date` = ? ,";
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$sql .= " `cantidad` = ? ,";
			}
			if (in_array("total",$fieldstoupdate)){
				$sql .= " `total` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_gastostipo",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idGastostipo  );
			}
			if (in_array("id_gastos",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idGastos  );
			}
			if (in_array("detalles",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->detalles  );
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
			if (in_array("updated_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->updatedDate  );
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->cantidad  );
			}
			if (in_array("total",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->total  );
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
			$sql="SELECT id FROM gastos_registros WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new GastosRegistros();
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
