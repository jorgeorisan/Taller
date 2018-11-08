<?php 

	class AutoRefaccion {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_marca = 0;
		protected $id_submarca = 0;
		protected $codigo = "";
		protected $nombre = "";
		protected $descripcion = "";
		protected $status = "";
		protected $modelo = "";
		protected $imagen_url = "";
		protected $costo_aprox = "";
		protected $costo_real = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$refaccion = new Refaccion();
			$refaccion->setId( $id );
			return $refaccion;
		}
		public static function constructWithValues( $values ){
			$refaccion = new Refaccion();
			$refaccion->setValues( $values );
			return $refaccion;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdMarca( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDMARCA","i") ) 
 				$this->id_marca = $value;
		}
		
		public function setIdSubmarca( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDSUBMARCA","i") ) 
 				$this->id_submarca = $value;
		}
		
		public function setCodigo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODIGO","s") ) 
 				$this->codigo = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setDescripcion( $value ){ 				$this->descripcion = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setModelo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MODELO","s") ) 
 				$this->modelo = $value;
		}
		
		public function setImagenUrl( $value ){ 				$this->imagen_url = $value;
		}
		
		public function setCostoAprox( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOAPROX","s") ) 
 				$this->costo_aprox = $value;
		}
		
		public function setCostoReal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOREAL","d") ) 
 				$this->costo_real = $value;
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
		
		public function getIdMarca($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_marca) ;
 			}else{
 				return $this->id_marca ;
 			}
		}
		
		public function getIdSubmarca($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_submarca) ;
 			}else{
 				return $this->id_submarca ;
 			}
		}
		
		public function getCodigo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->codigo) ;
 			}else{
 				return $this->codigo ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getDescripcion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descripcion) ;
 			}else{
 				return $this->descripcion ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getModelo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->modelo) ;
 			}else{
 				return $this->modelo ;
 			}
		}
		
		public function getImagenUrl($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->imagen_url) ;
 			}else{
 				return $this->imagen_url ;
 			}
		}
		
		public function getCostoAprox($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo_aprox) ;
 			}else{
 				return $this->costo_aprox ;
 			}
		}
		
		public function getCostoReal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo_real) ;
 			}else{
 				return $this->costo_real ;
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
			$sql="SELECT * FROM refaccion WHERE id = ?";

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
			$this->setIdMarca( $res['id_marca'] );
			$this->setIdSubmarca( $res['id_submarca'] );
			$this->setCodigo( $res['codigo'] );
			$this->setNombre( $res['nombre'] );
			$this->setDescripcion( $res['descripcion'] );
			$this->setStatus( $res['status'] );
			$this->setModelo( $res['modelo'] );
			$this->setImagenUrl( $res['imagen_url'] );
			$this->setCostoAprox( $res['costo_aprox'] );
			$this->setCostoReal( $res['costo_real'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO refaccion SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_marca` = ? ,";
			$sql .= " `id_submarca` = ? ,";
			$sql .= " `codigo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `descripcion` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `imagen_url` = ? ,";
			$sql .= " `costo_aprox` = ? ,";
			$sql .= " `costo_real` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE refaccion SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_marca` = ? ,";
			$sql .= " `id_submarca` = ? ,";
			$sql .= " `codigo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `descripcion` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `imagen_url` = ? ,";
			$sql .= " `costo_aprox` = ? ,";
			$sql .= " `costo_real` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_marca );
			$stmt->mbind_param( 'i', $this->id_submarca );
			$stmt->mbind_param( 's', $this->codigo );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->descripcion );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->modelo );
			$stmt->mbind_param( 's', $this->imagen_url );
			$stmt->mbind_param( 's', $this->costo_aprox );
			$stmt->mbind_param( 'd', $this->costo_real );
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
				$sql = "UPDATE refaccion SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_marca",$fieldstoupdate)){
				$sql .= " `id_marca` = ? ,";
			}
			if (in_array("id_submarca",$fieldstoupdate)){
				$sql .= " `id_submarca` = ? ,";
			}
			if (in_array("codigo",$fieldstoupdate)){
				$sql .= " `codigo` = ? ,";
			}
			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("descripcion",$fieldstoupdate)){
				$sql .= " `descripcion` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("modelo",$fieldstoupdate)){
				$sql .= " `modelo` = ? ,";
			}
			if (in_array("imagen_url",$fieldstoupdate)){
				$sql .= " `imagen_url` = ? ,";
			}
			if (in_array("costo_aprox",$fieldstoupdate)){
				$sql .= " `costo_aprox` = ? ,";
			}
			if (in_array("costo_real",$fieldstoupdate)){
				$sql .= " `costo_real` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_marca",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idMarca  );
			}
			if (in_array("id_submarca",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idSubmarca  );
			}
			if (in_array("codigo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->codigo  );
			}
			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("descripcion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->descripcion  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("modelo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->modelo  );
			}
			if (in_array("imagen_url",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->imagenUrl  );
			}
			if (in_array("costo_aprox",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->costoAprox  );
			}
			if (in_array("costo_real",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->costoReal  );
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
			$sql="SELECT id FROM refaccion WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Refaccion();
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
