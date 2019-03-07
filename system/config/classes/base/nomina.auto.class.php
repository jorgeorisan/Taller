<?php 

	class AutoNomina {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_user = 0;
		protected $id_taller = 0;
		protected $nombre = "";
		protected $total = 0;
		protected $status = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $comentarios = "";
		protected $fecha_inicial = "";
		protected $fecha_final = "";
		protected $available = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$nomina = new Nomina();
			$nomina->setId( $id );
			return $nomina;
		}
		public static function constructWithValues( $values ){
			$nomina = new Nomina();
			$nomina->setValues( $values );
			return $nomina;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIdTaller( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTALLER","i") ) 
 				$this->id_taller = $value;
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
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setComentarios( $value ){ 				$this->comentarios = $value;
		}
		
		public function setFechaInicial( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAINICIAL","s") ) 
 				$this->fecha_inicial = $value;
		}
		
		public function setFechaFinal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAFINAL","s") ) 
 				$this->fecha_final = $value;
		}
		
		public function setAvailable( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "AVAILABLE","i") ) 
 				$this->available = $value;
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
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getIdTaller($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_taller) ;
 			}else{
 				return $this->id_taller ;
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
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
 			}
		}
		
		public function getUpdatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_date) ;
 			}else{
 				return $this->updated_date ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getFechaInicial($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_inicial) ;
 			}else{
 				return $this->fecha_inicial ;
 			}
		}
		
		public function getFechaFinal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_final) ;
 			}else{
 				return $this->fecha_final ;
 			}
		}
		
		public function getAvailable($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->available) ;
 			}else{
 				return $this->available ;
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
			$sql="SELECT * FROM nomina WHERE id = ?";

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
			$this->setIdUser( $res['id_user'] );
			$this->setIdTaller( $res['id_taller'] );
			$this->setNombre( $res['nombre'] );
			$this->setTotal( $res['total'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setFechaInicial( $res['fecha_inicial'] );
			$this->setFechaFinal( $res['fecha_final'] );
			$this->setAvailable( $res['available'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO nomina SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_user` = ? ,";
			$sql .= " `id_taller` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `fecha_inicial` = ? ,";
			$sql .= " `fecha_final` = ? ,";
			$sql .= " `available` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE nomina SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_user` = ? ,";
			$sql .= " `id_taller` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `total` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `comentarios` = ? ,";
			$sql .= " `fecha_inicial` = ? ,";
			$sql .= " `fecha_final` = ? ,";
			$sql .= " `available` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 'i', $this->id_taller );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 'd', $this->total );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->comentarios );
			$stmt->mbind_param( 's', $this->fecha_inicial );
			$stmt->mbind_param( 's', $this->fecha_final );
			$stmt->mbind_param( 'i', $this->available );
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
				$sql = "UPDATE nomina SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("id_taller",$fieldstoupdate)){
				$sql .= " `id_taller` = ? ,";
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
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$sql .= " `updated_date` = ? ,";
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$sql .= " `comentarios` = ? ,";
			}
			if (in_array("fecha_inicial",$fieldstoupdate)){
				$sql .= " `fecha_inicial` = ? ,";
			}
			if (in_array("fecha_final",$fieldstoupdate)){
				$sql .= " `fecha_final` = ? ,";
			}
			if (in_array("available",$fieldstoupdate)){
				$sql .= " `available` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("id_taller",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idTaller  );
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
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->updatedDate  );
			}
			if (in_array("comentarios",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentarios  );
			}
			if (in_array("fecha_inicial",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaInicial  );
			}
			if (in_array("fecha_final",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaFinal  );
			}
			if (in_array("available",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->available  );
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
			$sql="SELECT id FROM nomina WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Nomina();
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
