<?php 

	class AutoPedidoRefaccion {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_pedido = 0;
		protected $id_refaccion = 0;
		protected $cantidad = 0;
		protected $status = "";
		protected $costo = 0;
		protected $precio = 0;
		protected $totalcosto = 0;
		protected $created_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$pedidoRefaccion = new PedidoRefaccion();
			$pedidoRefaccion->setId( $id );
			return $pedidoRefaccion;
		}
		public static function constructWithValues( $values ){
			$pedidoRefaccion = new PedidoRefaccion();
			$pedidoRefaccion->setValues( $values );
			return $pedidoRefaccion;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdPedido( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPEDIDO","i") ) 
 				$this->id_pedido = $value;
		}
		
		public function setIdRefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDREFACCION","i") ) 
 				$this->id_refaccion = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTO","d") ) 
 				$this->costo = $value;
		}
		
		public function setPrecio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIO","d") ) 
 				$this->precio = $value;
		}
		
		public function setTotalcosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALCOSTO","d") ) 
 				$this->totalcosto = $value;
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
		
		public function getIdPedido($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_pedido) ;
 			}else{
 				return $this->id_pedido ;
 			}
		}
		
		public function getIdRefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_refaccion) ;
 			}else{
 				return $this->id_refaccion ;
 			}
		}
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getCosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo) ;
 			}else{
 				return $this->costo ;
 			}
		}
		
		public function getPrecio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio) ;
 			}else{
 				return $this->precio ;
 			}
		}
		
		public function getTotalcosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->totalcosto) ;
 			}else{
 				return $this->totalcosto ;
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
			$sql="SELECT * FROM pedido_refaccion WHERE id = ?";

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
			$this->setIdPedido( $res['id_pedido'] );
			$this->setIdRefaccion( $res['id_refaccion'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setStatus( $res['status'] );
			$this->setCosto( $res['costo'] );
			$this->setPrecio( $res['precio'] );
			$this->setTotalcosto( $res['totalcosto'] );
			$this->setCreatedDate( $res['created_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO pedido_refaccion SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_pedido` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `costo` = ? ,";
			$sql .= " `precio` = ? ,";
			$sql .= " `totalcosto` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE pedido_refaccion SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_pedido` = ? ,";
			$sql .= " `id_refaccion` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `costo` = ? ,";
			$sql .= " `precio` = ? ,";
			$sql .= " `totalcosto` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_pedido );
			$stmt->mbind_param( 'i', $this->id_refaccion );
			$stmt->mbind_param( 'd', $this->cantidad );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 'd', $this->costo );
			$stmt->mbind_param( 'd', $this->precio );
			$stmt->mbind_param( 'd', $this->totalcosto );
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
				$sql = "UPDATE pedido_refaccion SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_pedido",$fieldstoupdate)){
				$sql .= " `id_pedido` = ? ,";
			}
			if (in_array("id_refaccion",$fieldstoupdate)){
				$sql .= " `id_refaccion` = ? ,";
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$sql .= " `cantidad` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("costo",$fieldstoupdate)){
				$sql .= " `costo` = ? ,";
			}
			if (in_array("precio",$fieldstoupdate)){
				$sql .= " `precio` = ? ,";
			}
			if (in_array("totalcosto",$fieldstoupdate)){
				$sql .= " `totalcosto` = ? ,";
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

			if (in_array("id_pedido",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idPedido  );
			}
			if (in_array("id_refaccion",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idRefaccion  );
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->cantidad  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("costo",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->costo  );
			}
			if (in_array("precio",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->precio  );
			}
			if (in_array("totalcosto",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->totalcosto  );
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
			$sql="SELECT id FROM pedido_refaccion WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new PedidoRefaccion();
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
