<?php 

	class AutoVehiculo {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_marca = 0;
		protected $id_submarca = 0;
		protected $id_cliente = 0;
		protected $id_user = 0;
		protected $id_taller = 0;
		protected $id_aseguradora = 0;
		protected $modelo = "";
		protected $placas = "";
		protected $placas_h = "";
		protected $serie = "";
		protected $color = "";
		protected $motor = "";
		protected $status = "";
		protected $no_expediente = "";
		protected $no_poliza = "";
		protected $deducible = "";
		protected $reporte = "";
		protected $siniestro = "";
		protected $tipo = "";
		protected $no_orden = "";
		protected $fecha_alta = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$vehiculo = new Vehiculo();
			$vehiculo->setId( $id );
			return $vehiculo;
		}
		public static function constructWithValues( $values ){
			$vehiculo = new Vehiculo();
			$vehiculo->setValues( $values );
			return $vehiculo;
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
		
		public function setIdCliente( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCLIENTE","i") ) 
 				$this->id_cliente = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIdTaller( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTALLER","i") ) 
 				$this->id_taller = $value;
		}
		
		public function setIdAseguradora( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDASEGURADORA","i") ) 
 				$this->id_aseguradora = $value;
		}
		
		public function setModelo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MODELO","s") ) 
 				$this->modelo = $value;
		}
		
		public function setPlacas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PLACAS","s") ) 
 				$this->placas = $value;
		}
		
		public function setPlacasH( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PLACASH","s") ) 
 				$this->placas_h = $value;
		}
		
		public function setSerie( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SERIE","s") ) 
 				$this->serie = $value;
		}
		
		public function setColor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COLOR","s") ) 
 				$this->color = $value;
		}
		
		public function setMotor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MOTOR","s") ) 
 				$this->motor = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setNoExpediente( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOEXPEDIENTE","s") ) 
 				$this->no_expediente = $value;
		}
		
		public function setNoPoliza( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOPOLIZA","s") ) 
 				$this->no_poliza = $value;
		}
		
		public function setDeducible( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DEDUCIBLE","s") ) 
 				$this->deducible = $value;
		}
		
		public function setReporte( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "REPORTE","s") ) 
 				$this->reporte = $value;
		}
		
		public function setSiniestro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SINIESTRO","s") ) 
 				$this->siniestro = $value;
		}
		
		public function setTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIPO","s") ) 
 				$this->tipo = $value;
		}
		
		public function setNoOrden( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOORDEN","s") ) 
 				$this->no_orden = $value;
		}
		
		public function setFechaAlta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAALTA","s") ) 
 				$this->fecha_alta = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
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
		
		public function getIdCliente($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_cliente) ;
 			}else{
 				return $this->id_cliente ;
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
		
		public function getIdAseguradora($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_aseguradora) ;
 			}else{
 				return $this->id_aseguradora ;
 			}
		}
		
		public function getModelo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->modelo) ;
 			}else{
 				return $this->modelo ;
 			}
		}
		
		public function getPlacas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->placas) ;
 			}else{
 				return $this->placas ;
 			}
		}
		
		public function getPlacasH($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->placas_h) ;
 			}else{
 				return $this->placas_h ;
 			}
		}
		
		public function getSerie($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->serie) ;
 			}else{
 				return $this->serie ;
 			}
		}
		
		public function getColor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->color) ;
 			}else{
 				return $this->color ;
 			}
		}
		
		public function getMotor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->motor) ;
 			}else{
 				return $this->motor ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getNoExpediente($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->no_expediente) ;
 			}else{
 				return $this->no_expediente ;
 			}
		}
		
		public function getNoPoliza($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->no_poliza) ;
 			}else{
 				return $this->no_poliza ;
 			}
		}
		
		public function getDeducible($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deducible) ;
 			}else{
 				return $this->deducible ;
 			}
		}
		
		public function getReporte($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->reporte) ;
 			}else{
 				return $this->reporte ;
 			}
		}
		
		public function getSiniestro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->siniestro) ;
 			}else{
 				return $this->siniestro ;
 			}
		}
		
		public function getTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tipo) ;
 			}else{
 				return $this->tipo ;
 			}
		}
		
		public function getNoOrden($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->no_orden) ;
 			}else{
 				return $this->no_orden ;
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
		
		public function getUpdatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_date) ;
 			}else{
 				return $this->updated_date ;
 			}
		}
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
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
			$sql="SELECT * FROM vehiculo WHERE id = ?";

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
			$this->setIdCliente( $res['id_cliente'] );
			$this->setIdUser( $res['id_user'] );
			$this->setIdTaller( $res['id_taller'] );
			$this->setIdAseguradora( $res['id_aseguradora'] );
			$this->setModelo( $res['modelo'] );
			$this->setPlacas( $res['placas'] );
			$this->setPlacasH( $res['placas_h'] );
			$this->setSerie( $res['serie'] );
			$this->setColor( $res['color'] );
			$this->setMotor( $res['motor'] );
			$this->setStatus( $res['status'] );
			$this->setNoExpediente( $res['no_expediente'] );
			$this->setNoPoliza( $res['no_poliza'] );
			$this->setDeducible( $res['deducible'] );
			$this->setReporte( $res['reporte'] );
			$this->setSiniestro( $res['siniestro'] );
			$this->setTipo( $res['tipo'] );
			$this->setNoOrden( $res['no_orden'] );
			$this->setFechaAlta( $res['fecha_alta'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO vehiculo SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_marca` = ? ,";
			$sql .= " `id_submarca` = ? ,";
			$sql .= " `id_cliente` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `id_taller` = ? ,";
			$sql .= " `id_aseguradora` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `placas` = ? ,";
			$sql .= " `placas_h` = ? ,";
			$sql .= " `serie` = ? ,";
			$sql .= " `color` = ? ,";
			$sql .= " `motor` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `no_expediente` = ? ,";
			$sql .= " `no_poliza` = ? ,";
			$sql .= " `deducible` = ? ,";
			$sql .= " `reporte` = ? ,";
			$sql .= " `siniestro` = ? ,";
			$sql .= " `tipo` = ? ,";
			$sql .= " `no_orden` = ? ,";
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE vehiculo SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_marca` = ? ,";
			$sql .= " `id_submarca` = ? ,";
			$sql .= " `id_cliente` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `id_taller` = ? ,";
			$sql .= " `id_aseguradora` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `placas` = ? ,";
			$sql .= " `placas_h` = ? ,";
			$sql .= " `serie` = ? ,";
			$sql .= " `color` = ? ,";
			$sql .= " `motor` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `no_expediente` = ? ,";
			$sql .= " `no_poliza` = ? ,";
			$sql .= " `deducible` = ? ,";
			$sql .= " `reporte` = ? ,";
			$sql .= " `siniestro` = ? ,";
			$sql .= " `tipo` = ? ,";
			$sql .= " `no_orden` = ? ,";
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_marca );
			$stmt->mbind_param( 'i', $this->id_submarca );
			$stmt->mbind_param( 'i', $this->id_cliente );
			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 'i', $this->id_taller );
			$stmt->mbind_param( 'i', $this->id_aseguradora );
			$stmt->mbind_param( 's', $this->modelo );
			$stmt->mbind_param( 's', $this->placas );
			$stmt->mbind_param( 's', $this->placas_h );
			$stmt->mbind_param( 's', $this->serie );
			$stmt->mbind_param( 's', $this->color );
			$stmt->mbind_param( 's', $this->motor );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->no_expediente );
			$stmt->mbind_param( 's', $this->no_poliza );
			$stmt->mbind_param( 's', $this->deducible );
			$stmt->mbind_param( 's', $this->reporte );
			$stmt->mbind_param( 's', $this->siniestro );
			$stmt->mbind_param( 's', $this->tipo );
			$stmt->mbind_param( 's', $this->no_orden );
			$stmt->mbind_param( 's', $this->fecha_alta );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
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
				$sql = "UPDATE vehiculo SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_marca",$fieldstoupdate)){
				$sql .= " `id_marca` = ? ,";
			}
			if (in_array("id_submarca",$fieldstoupdate)){
				$sql .= " `id_submarca` = ? ,";
			}
			if (in_array("id_cliente",$fieldstoupdate)){
				$sql .= " `id_cliente` = ? ,";
			}
			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("id_taller",$fieldstoupdate)){
				$sql .= " `id_taller` = ? ,";
			}
			if (in_array("id_aseguradora",$fieldstoupdate)){
				$sql .= " `id_aseguradora` = ? ,";
			}
			if (in_array("modelo",$fieldstoupdate)){
				$sql .= " `modelo` = ? ,";
			}
			if (in_array("placas",$fieldstoupdate)){
				$sql .= " `placas` = ? ,";
			}
			if (in_array("placas_h",$fieldstoupdate)){
				$sql .= " `placas_h` = ? ,";
			}
			if (in_array("serie",$fieldstoupdate)){
				$sql .= " `serie` = ? ,";
			}
			if (in_array("color",$fieldstoupdate)){
				$sql .= " `color` = ? ,";
			}
			if (in_array("motor",$fieldstoupdate)){
				$sql .= " `motor` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("no_expediente",$fieldstoupdate)){
				$sql .= " `no_expediente` = ? ,";
			}
			if (in_array("no_poliza",$fieldstoupdate)){
				$sql .= " `no_poliza` = ? ,";
			}
			if (in_array("deducible",$fieldstoupdate)){
				$sql .= " `deducible` = ? ,";
			}
			if (in_array("reporte",$fieldstoupdate)){
				$sql .= " `reporte` = ? ,";
			}
			if (in_array("siniestro",$fieldstoupdate)){
				$sql .= " `siniestro` = ? ,";
			}
			if (in_array("tipo",$fieldstoupdate)){
				$sql .= " `tipo` = ? ,";
			}
			if (in_array("no_orden",$fieldstoupdate)){
				$sql .= " `no_orden` = ? ,";
			}
			if (in_array("fecha_alta",$fieldstoupdate)){
				$sql .= " `fecha_alta` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$sql .= " `updated_date` = ? ,";
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$sql .= " `deleted_date` = ? ,";
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
			if (in_array("id_cliente",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idCliente  );
			}
			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("id_taller",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idTaller  );
			}
			if (in_array("id_aseguradora",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idAseguradora  );
			}
			if (in_array("modelo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->modelo  );
			}
			if (in_array("placas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->placas  );
			}
			if (in_array("placas_h",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->placasH  );
			}
			if (in_array("serie",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->serie  );
			}
			if (in_array("color",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->color  );
			}
			if (in_array("motor",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->motor  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("no_expediente",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->noExpediente  );
			}
			if (in_array("no_poliza",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->noPoliza  );
			}
			if (in_array("deducible",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deducible  );
			}
			if (in_array("reporte",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->reporte  );
			}
			if (in_array("siniestro",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->siniestro  );
			}
			if (in_array("tipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tipo  );
			}
			if (in_array("no_orden",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->noOrden  );
			}
			if (in_array("fecha_alta",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaAlta  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->updatedDate  );
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deletedDate  );
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
			$sql="SELECT id FROM vehiculo WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Vehiculo();
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
