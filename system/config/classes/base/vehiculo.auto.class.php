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
		protected $fecha_alta = "";
		protected $fecha_promesa = "";
		protected $modelo = "";
		protected $color = "";
		protected $placas_num = "";
		protected $kilometraje = "";
		protected $vin = "";
		protected $matricula = "";
		protected $TransmisionTipo = "";
		protected $FuncionamientoAC = "";
		protected $VestidurasTipo = "";
		protected $InteriorTipo = "";
		protected $RinTipo = "";
		protected $DirTipo = "";
		protected $Gasolina = "";
		protected $Faros = "";
		protected $Lucesch = "";
		protected $Antena = "";
		protected $EspejosLaterales = "";
		protected $Cristales = "";
		protected $Emblemas = "";
		protected $Llantas = "";
		protected $Taponesrin = "";
		protected $Molduras = "";
		protected $TaponGasolina = "";
		protected $Calaveras = "";
		protected $FarosNiebla = "";
		protected $ComentariosExt = "";
		protected $Limpiadores = "";
		protected $Flasher = "";
		protected $Calefaccion = "";
		protected $Radio = "";
		protected $Encendedor = "";
		protected $Retrovisor = "";
		protected $Cenicero = "";
		protected $Cinturones = "";
		protected $Reclinables = "";
		protected $Tapetes = "";
		protected $Vestiduras = "";
		protected $Guantera = "";
		protected $ComentariosInt = "";
		protected $Gato = "";
		protected $ManeralGato = "";
		protected $LlavedeLlantas = "";
		protected $Herramientas = "";
		protected $SenalesReflejantes = "";
		protected $Extinguidor = "";
		protected $LlantaRefaccion = "";
		protected $AlarmaControl = "";
		protected $EquipoAV = "";
		protected $CablesPasaCorriente = "";
		protected $DadoSeg = "";
		protected $ComentariosAcces = "";
		protected $TaponAceite = "";
		protected $TaponDirHD = "";
		protected $TaponDepFrenos = "";
		protected $TaponLimpiaparabrisas = "";
		protected $Bateria = "";
		protected $MarcaBateria = "";
		protected $Claxon = "";
		protected $ComentariosComp = "";
		protected $TarjetaCirc = "";
		protected $PolizaNum = "";
		protected $PolizaSeg = "";
		protected $ReporteNum = "";
		protected $siniestro = "";
		protected $deducible = "";
		protected $ManualProp = "";
		protected $TalonVerif = "";
		protected $ComentariosDoc = "";
		protected $status = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $status_vehiculo = "";
		protected $fecha_firma = "";

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
		
		public function setFechaAlta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAALTA","s") ) 
 				$this->fecha_alta = $value;
		}
		
		public function setFechaPromesa( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAPROMESA","s") ) 
 				$this->fecha_promesa = $value;
		}
		
		public function setModelo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MODELO","s") ) 
 				$this->modelo = $value;
		}
		
		public function setColor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COLOR","s") ) 
 				$this->color = $value;
		}
		
		public function setPlacasNum( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PLACASNUM","s") ) 
 				$this->placas_num = $value;
		}
		
		public function setKilometraje( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "KILOMETRAJE","s") ) 
 				$this->kilometraje = $value;
		}
		
		public function setVin( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "VIN","s") ) 
 				$this->vin = $value;
		}
		
		public function setMatricula( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MATRICULA","s") ) 
 				$this->matricula = $value;
		}
		
		public function setTransmisionTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TRANSMISIONTIPO","s") ) 
 				$this->TransmisionTipo = $value;
		}
		
		public function setFuncionamientoAC( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FUNCIONAMIENTOAC","s") ) 
 				$this->FuncionamientoAC = $value;
		}
		
		public function setVestidurasTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "VESTIDURASTIPO","s") ) 
 				$this->VestidurasTipo = $value;
		}
		
		public function setInteriorTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "INTERIORTIPO","s") ) 
 				$this->InteriorTipo = $value;
		}
		
		public function setRinTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RINTIPO","s") ) 
 				$this->RinTipo = $value;
		}
		
		public function setDirTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DIRTIPO","s") ) 
 				$this->DirTipo = $value;
		}
		
		public function setGasolina( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "GASOLINA","s") ) 
 				$this->Gasolina = $value;
		}
		
		public function setFaros( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FAROS","s") ) 
 				$this->Faros = $value;
		}
		
		public function setLucesch( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LUCESCH","s") ) 
 				$this->Lucesch = $value;
		}
		
		public function setAntena( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ANTENA","s") ) 
 				$this->Antena = $value;
		}
		
		public function setEspejosLaterales( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ESPEJOSLATERALES","s") ) 
 				$this->EspejosLaterales = $value;
		}
		
		public function setCristales( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CRISTALES","s") ) 
 				$this->Cristales = $value;
		}
		
		public function setEmblemas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMBLEMAS","s") ) 
 				$this->Emblemas = $value;
		}
		
		public function setLlantas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LLANTAS","s") ) 
 				$this->Llantas = $value;
		}
		
		public function setTaponesrin( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONESRIN","s") ) 
 				$this->Taponesrin = $value;
		}
		
		public function setMolduras( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MOLDURAS","s") ) 
 				$this->Molduras = $value;
		}
		
		public function setTaponGasolina( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONGASOLINA","s") ) 
 				$this->TaponGasolina = $value;
		}
		
		public function setCalaveras( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CALAVERAS","s") ) 
 				$this->Calaveras = $value;
		}
		
		public function setFarosNiebla( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FAROSNIEBLA","s") ) 
 				$this->FarosNiebla = $value;
		}
		
		public function setComentariosExt( $value ){ 				$this->ComentariosExt = $value;
		}
		
		public function setLimpiadores( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LIMPIADORES","s") ) 
 				$this->Limpiadores = $value;
		}
		
		public function setFlasher( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FLASHER","s") ) 
 				$this->Flasher = $value;
		}
		
		public function setCalefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CALEFACCION","s") ) 
 				$this->Calefaccion = $value;
		}
		
		public function setRadio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RADIO","s") ) 
 				$this->Radio = $value;
		}
		
		public function setEncendedor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ENCENDEDOR","s") ) 
 				$this->Encendedor = $value;
		}
		
		public function setRetrovisor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RETROVISOR","s") ) 
 				$this->Retrovisor = $value;
		}
		
		public function setCenicero( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CENICERO","s") ) 
 				$this->Cenicero = $value;
		}
		
		public function setCinturones( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CINTURONES","s") ) 
 				$this->Cinturones = $value;
		}
		
		public function setReclinables( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RECLINABLES","s") ) 
 				$this->Reclinables = $value;
		}
		
		public function setTapetes( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPETES","s") ) 
 				$this->Tapetes = $value;
		}
		
		public function setVestiduras( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "VESTIDURAS","s") ) 
 				$this->Vestiduras = $value;
		}
		
		public function setGuantera( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "GUANTERA","s") ) 
 				$this->Guantera = $value;
		}
		
		public function setComentariosInt( $value ){ 				$this->ComentariosInt = $value;
		}
		
		public function setGato( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "GATO","s") ) 
 				$this->Gato = $value;
		}
		
		public function setManeralGato( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MANERALGATO","s") ) 
 				$this->ManeralGato = $value;
		}
		
		public function setLlavedeLlantas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LLAVEDELLANTAS","s") ) 
 				$this->LlavedeLlantas = $value;
		}
		
		public function setHerramientas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "HERRAMIENTAS","s") ) 
 				$this->Herramientas = $value;
		}
		
		public function setSenalesReflejantes( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SENALESREFLEJANTES","s") ) 
 				$this->SenalesReflejantes = $value;
		}
		
		public function setExtinguidor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXTINGUIDOR","s") ) 
 				$this->Extinguidor = $value;
		}
		
		public function setLlantaRefaccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LLANTAREFACCION","s") ) 
 				$this->LlantaRefaccion = $value;
		}
		
		public function setAlarmaControl( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ALARMACONTROL","s") ) 
 				$this->AlarmaControl = $value;
		}
		
		public function setEquipoAV( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EQUIPOAV","s") ) 
 				$this->EquipoAV = $value;
		}
		
		public function setCablesPasaCorriente( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CABLESPASACORRIENTE","s") ) 
 				$this->CablesPasaCorriente = $value;
		}
		
		public function setDadoSeg( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DADOSEG","s") ) 
 				$this->DadoSeg = $value;
		}
		
		public function setComentariosAcces( $value ){ 				$this->ComentariosAcces = $value;
		}
		
		public function setTaponAceite( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONACEITE","s") ) 
 				$this->TaponAceite = $value;
		}
		
		public function setTaponDirHD( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONDIRHD","s") ) 
 				$this->TaponDirHD = $value;
		}
		
		public function setTaponDepFrenos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONDEPFRENOS","s") ) 
 				$this->TaponDepFrenos = $value;
		}
		
		public function setTaponLimpiaparabrisas( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TAPONLIMPIAPARABRISAS","s") ) 
 				$this->TaponLimpiaparabrisas = $value;
		}
		
		public function setBateria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "BATERIA","s") ) 
 				$this->Bateria = $value;
		}
		
		public function setMarcaBateria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MARCABATERIA","s") ) 
 				$this->MarcaBateria = $value;
		}
		
		public function setClaxon( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CLAXON","s") ) 
 				$this->Claxon = $value;
		}
		
		public function setComentariosComp( $value ){ 				$this->ComentariosComp = $value;
		}
		
		public function setTarjetaCirc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TARJETACIRC","s") ) 
 				$this->TarjetaCirc = $value;
		}
		
		public function setPolizaNum( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "POLIZANUM","s") ) 
 				$this->PolizaNum = $value;
		}
		
		public function setPolizaSeg( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "POLIZASEG","s") ) 
 				$this->PolizaSeg = $value;
		}
		
		public function setReporteNum( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "REPORTENUM","s") ) 
 				$this->ReporteNum = $value;
		}
		
		public function setSiniestro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SINIESTRO","s") ) 
 				$this->siniestro = $value;
		}
		
		public function setDeducible( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DEDUCIBLE","s") ) 
 				$this->deducible = $value;
		}
		
		public function setManualProp( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MANUALPROP","s") ) 
 				$this->ManualProp = $value;
		}
		
		public function setTalonVerif( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TALONVERIF","s") ) 
 				$this->TalonVerif = $value;
		}
		
		public function setComentariosDoc( $value ){ 				$this->ComentariosDoc = $value;
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
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setStatusVehiculo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUSVEHICULO","s") ) 
 				$this->status_vehiculo = $value;
		}
		
		public function setFechaFirma( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAFIRMA","s") ) 
 				$this->fecha_firma = $value;
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
		
		public function getFechaAlta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_alta) ;
 			}else{
 				return $this->fecha_alta ;
 			}
		}
		
		public function getFechaPromesa($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_promesa) ;
 			}else{
 				return $this->fecha_promesa ;
 			}
		}
		
		public function getModelo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->modelo) ;
 			}else{
 				return $this->modelo ;
 			}
		}
		
		public function getColor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->color) ;
 			}else{
 				return $this->color ;
 			}
		}
		
		public function getPlacasNum($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->placas_num) ;
 			}else{
 				return $this->placas_num ;
 			}
		}
		
		public function getKilometraje($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->kilometraje) ;
 			}else{
 				return $this->kilometraje ;
 			}
		}
		
		public function getVin($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->vin) ;
 			}else{
 				return $this->vin ;
 			}
		}
		
		public function getMatricula($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->matricula) ;
 			}else{
 				return $this->matricula ;
 			}
		}
		
		public function getTransmisionTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TransmisionTipo) ;
 			}else{
 				return $this->TransmisionTipo ;
 			}
		}
		
		public function getFuncionamientoAC($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->FuncionamientoAC) ;
 			}else{
 				return $this->FuncionamientoAC ;
 			}
		}
		
		public function getVestidurasTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->VestidurasTipo) ;
 			}else{
 				return $this->VestidurasTipo ;
 			}
		}
		
		public function getInteriorTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->InteriorTipo) ;
 			}else{
 				return $this->InteriorTipo ;
 			}
		}
		
		public function getRinTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->RinTipo) ;
 			}else{
 				return $this->RinTipo ;
 			}
		}
		
		public function getDirTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->DirTipo) ;
 			}else{
 				return $this->DirTipo ;
 			}
		}
		
		public function getGasolina($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Gasolina) ;
 			}else{
 				return $this->Gasolina ;
 			}
		}
		
		public function getFaros($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Faros) ;
 			}else{
 				return $this->Faros ;
 			}
		}
		
		public function getLucesch($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Lucesch) ;
 			}else{
 				return $this->Lucesch ;
 			}
		}
		
		public function getAntena($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Antena) ;
 			}else{
 				return $this->Antena ;
 			}
		}
		
		public function getEspejosLaterales($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->EspejosLaterales) ;
 			}else{
 				return $this->EspejosLaterales ;
 			}
		}
		
		public function getCristales($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Cristales) ;
 			}else{
 				return $this->Cristales ;
 			}
		}
		
		public function getEmblemas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Emblemas) ;
 			}else{
 				return $this->Emblemas ;
 			}
		}
		
		public function getLlantas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Llantas) ;
 			}else{
 				return $this->Llantas ;
 			}
		}
		
		public function getTaponesrin($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Taponesrin) ;
 			}else{
 				return $this->Taponesrin ;
 			}
		}
		
		public function getMolduras($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Molduras) ;
 			}else{
 				return $this->Molduras ;
 			}
		}
		
		public function getTaponGasolina($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TaponGasolina) ;
 			}else{
 				return $this->TaponGasolina ;
 			}
		}
		
		public function getCalaveras($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Calaveras) ;
 			}else{
 				return $this->Calaveras ;
 			}
		}
		
		public function getFarosNiebla($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->FarosNiebla) ;
 			}else{
 				return $this->FarosNiebla ;
 			}
		}
		
		public function getComentariosExt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ComentariosExt) ;
 			}else{
 				return $this->ComentariosExt ;
 			}
		}
		
		public function getLimpiadores($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Limpiadores) ;
 			}else{
 				return $this->Limpiadores ;
 			}
		}
		
		public function getFlasher($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Flasher) ;
 			}else{
 				return $this->Flasher ;
 			}
		}
		
		public function getCalefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Calefaccion) ;
 			}else{
 				return $this->Calefaccion ;
 			}
		}
		
		public function getRadio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Radio) ;
 			}else{
 				return $this->Radio ;
 			}
		}
		
		public function getEncendedor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Encendedor) ;
 			}else{
 				return $this->Encendedor ;
 			}
		}
		
		public function getRetrovisor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Retrovisor) ;
 			}else{
 				return $this->Retrovisor ;
 			}
		}
		
		public function getCenicero($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Cenicero) ;
 			}else{
 				return $this->Cenicero ;
 			}
		}
		
		public function getCinturones($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Cinturones) ;
 			}else{
 				return $this->Cinturones ;
 			}
		}
		
		public function getReclinables($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Reclinables) ;
 			}else{
 				return $this->Reclinables ;
 			}
		}
		
		public function getTapetes($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Tapetes) ;
 			}else{
 				return $this->Tapetes ;
 			}
		}
		
		public function getVestiduras($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Vestiduras) ;
 			}else{
 				return $this->Vestiduras ;
 			}
		}
		
		public function getGuantera($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Guantera) ;
 			}else{
 				return $this->Guantera ;
 			}
		}
		
		public function getComentariosInt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ComentariosInt) ;
 			}else{
 				return $this->ComentariosInt ;
 			}
		}
		
		public function getGato($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Gato) ;
 			}else{
 				return $this->Gato ;
 			}
		}
		
		public function getManeralGato($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ManeralGato) ;
 			}else{
 				return $this->ManeralGato ;
 			}
		}
		
		public function getLlavedeLlantas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->LlavedeLlantas) ;
 			}else{
 				return $this->LlavedeLlantas ;
 			}
		}
		
		public function getHerramientas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Herramientas) ;
 			}else{
 				return $this->Herramientas ;
 			}
		}
		
		public function getSenalesReflejantes($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->SenalesReflejantes) ;
 			}else{
 				return $this->SenalesReflejantes ;
 			}
		}
		
		public function getExtinguidor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Extinguidor) ;
 			}else{
 				return $this->Extinguidor ;
 			}
		}
		
		public function getLlantaRefaccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->LlantaRefaccion) ;
 			}else{
 				return $this->LlantaRefaccion ;
 			}
		}
		
		public function getAlarmaControl($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->AlarmaControl) ;
 			}else{
 				return $this->AlarmaControl ;
 			}
		}
		
		public function getEquipoAV($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->EquipoAV) ;
 			}else{
 				return $this->EquipoAV ;
 			}
		}
		
		public function getCablesPasaCorriente($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->CablesPasaCorriente) ;
 			}else{
 				return $this->CablesPasaCorriente ;
 			}
		}
		
		public function getDadoSeg($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->DadoSeg) ;
 			}else{
 				return $this->DadoSeg ;
 			}
		}
		
		public function getComentariosAcces($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ComentariosAcces) ;
 			}else{
 				return $this->ComentariosAcces ;
 			}
		}
		
		public function getTaponAceite($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TaponAceite) ;
 			}else{
 				return $this->TaponAceite ;
 			}
		}
		
		public function getTaponDirHD($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TaponDirHD) ;
 			}else{
 				return $this->TaponDirHD ;
 			}
		}
		
		public function getTaponDepFrenos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TaponDepFrenos) ;
 			}else{
 				return $this->TaponDepFrenos ;
 			}
		}
		
		public function getTaponLimpiaparabrisas($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TaponLimpiaparabrisas) ;
 			}else{
 				return $this->TaponLimpiaparabrisas ;
 			}
		}
		
		public function getBateria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Bateria) ;
 			}else{
 				return $this->Bateria ;
 			}
		}
		
		public function getMarcaBateria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->MarcaBateria) ;
 			}else{
 				return $this->MarcaBateria ;
 			}
		}
		
		public function getClaxon($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->Claxon) ;
 			}else{
 				return $this->Claxon ;
 			}
		}
		
		public function getComentariosComp($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ComentariosComp) ;
 			}else{
 				return $this->ComentariosComp ;
 			}
		}
		
		public function getTarjetaCirc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TarjetaCirc) ;
 			}else{
 				return $this->TarjetaCirc ;
 			}
		}
		
		public function getPolizaNum($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->PolizaNum) ;
 			}else{
 				return $this->PolizaNum ;
 			}
		}
		
		public function getPolizaSeg($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->PolizaSeg) ;
 			}else{
 				return $this->PolizaSeg ;
 			}
		}
		
		public function getReporteNum($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ReporteNum) ;
 			}else{
 				return $this->ReporteNum ;
 			}
		}
		
		public function getSiniestro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->siniestro) ;
 			}else{
 				return $this->siniestro ;
 			}
		}
		
		public function getDeducible($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deducible) ;
 			}else{
 				return $this->deducible ;
 			}
		}
		
		public function getManualProp($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ManualProp) ;
 			}else{
 				return $this->ManualProp ;
 			}
		}
		
		public function getTalonVerif($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->TalonVerif) ;
 			}else{
 				return $this->TalonVerif ;
 			}
		}
		
		public function getComentariosDoc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ComentariosDoc) ;
 			}else{
 				return $this->ComentariosDoc ;
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
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
 			}
		}
		
		public function getStatusVehiculo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status_vehiculo) ;
 			}else{
 				return $this->status_vehiculo ;
 			}
		}
		
		public function getFechaFirma($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_firma) ;
 			}else{
 				return $this->fecha_firma ;
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
			$this->setFechaAlta( $res['fecha_alta'] );
			$this->setFechaPromesa( $res['fecha_promesa'] );
			$this->setModelo( $res['modelo'] );
			$this->setColor( $res['color'] );
			$this->setPlacasNum( $res['placas_num'] );
			$this->setKilometraje( $res['kilometraje'] );
			$this->setVin( $res['vin'] );
			$this->setMatricula( $res['matricula'] );
			$this->setTransmisionTipo( $res['TransmisionTipo'] );
			$this->setFuncionamientoAC( $res['FuncionamientoAC'] );
			$this->setVestidurasTipo( $res['VestidurasTipo'] );
			$this->setInteriorTipo( $res['InteriorTipo'] );
			$this->setRinTipo( $res['RinTipo'] );
			$this->setDirTipo( $res['DirTipo'] );
			$this->setGasolina( $res['Gasolina'] );
			$this->setFaros( $res['Faros'] );
			$this->setLucesch( $res['Lucesch'] );
			$this->setAntena( $res['Antena'] );
			$this->setEspejosLaterales( $res['EspejosLaterales'] );
			$this->setCristales( $res['Cristales'] );
			$this->setEmblemas( $res['Emblemas'] );
			$this->setLlantas( $res['Llantas'] );
			$this->setTaponesrin( $res['Taponesrin'] );
			$this->setMolduras( $res['Molduras'] );
			$this->setTaponGasolina( $res['TaponGasolina'] );
			$this->setCalaveras( $res['Calaveras'] );
			$this->setFarosNiebla( $res['FarosNiebla'] );
			$this->setComentariosExt( $res['ComentariosExt'] );
			$this->setLimpiadores( $res['Limpiadores'] );
			$this->setFlasher( $res['Flasher'] );
			$this->setCalefaccion( $res['Calefaccion'] );
			$this->setRadio( $res['Radio'] );
			$this->setEncendedor( $res['Encendedor'] );
			$this->setRetrovisor( $res['Retrovisor'] );
			$this->setCenicero( $res['Cenicero'] );
			$this->setCinturones( $res['Cinturones'] );
			$this->setReclinables( $res['Reclinables'] );
			$this->setTapetes( $res['Tapetes'] );
			$this->setVestiduras( $res['Vestiduras'] );
			$this->setGuantera( $res['Guantera'] );
			$this->setComentariosInt( $res['ComentariosInt'] );
			$this->setGato( $res['Gato'] );
			$this->setManeralGato( $res['ManeralGato'] );
			$this->setLlavedeLlantas( $res['LlavedeLlantas'] );
			$this->setHerramientas( $res['Herramientas'] );
			$this->setSenalesReflejantes( $res['SenalesReflejantes'] );
			$this->setExtinguidor( $res['Extinguidor'] );
			$this->setLlantaRefaccion( $res['LlantaRefaccion'] );
			$this->setAlarmaControl( $res['AlarmaControl'] );
			$this->setEquipoAV( $res['EquipoAV'] );
			$this->setCablesPasaCorriente( $res['CablesPasaCorriente'] );
			$this->setDadoSeg( $res['DadoSeg'] );
			$this->setComentariosAcces( $res['ComentariosAcces'] );
			$this->setTaponAceite( $res['TaponAceite'] );
			$this->setTaponDirHD( $res['TaponDirHD'] );
			$this->setTaponDepFrenos( $res['TaponDepFrenos'] );
			$this->setTaponLimpiaparabrisas( $res['TaponLimpiaparabrisas'] );
			$this->setBateria( $res['Bateria'] );
			$this->setMarcaBateria( $res['MarcaBateria'] );
			$this->setClaxon( $res['Claxon'] );
			$this->setComentariosComp( $res['ComentariosComp'] );
			$this->setTarjetaCirc( $res['TarjetaCirc'] );
			$this->setPolizaNum( $res['PolizaNum'] );
			$this->setPolizaSeg( $res['PolizaSeg'] );
			$this->setReporteNum( $res['ReporteNum'] );
			$this->setSiniestro( $res['siniestro'] );
			$this->setDeducible( $res['deducible'] );
			$this->setManualProp( $res['ManualProp'] );
			$this->setTalonVerif( $res['TalonVerif'] );
			$this->setComentariosDoc( $res['ComentariosDoc'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setStatusVehiculo( $res['status_vehiculo'] );
			$this->setFechaFirma( $res['fecha_firma'] );
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
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `fecha_promesa` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `color` = ? ,";
			$sql .= " `placas_num` = ? ,";
			$sql .= " `kilometraje` = ? ,";
			$sql .= " `vin` = ? ,";
			$sql .= " `matricula` = ? ,";
			$sql .= " `TransmisionTipo` = ? ,";
			$sql .= " `FuncionamientoAC` = ? ,";
			$sql .= " `VestidurasTipo` = ? ,";
			$sql .= " `InteriorTipo` = ? ,";
			$sql .= " `RinTipo` = ? ,";
			$sql .= " `DirTipo` = ? ,";
			$sql .= " `Gasolina` = ? ,";
			$sql .= " `Faros` = ? ,";
			$sql .= " `Lucesch` = ? ,";
			$sql .= " `Antena` = ? ,";
			$sql .= " `EspejosLaterales` = ? ,";
			$sql .= " `Cristales` = ? ,";
			$sql .= " `Emblemas` = ? ,";
			$sql .= " `Llantas` = ? ,";
			$sql .= " `Taponesrin` = ? ,";
			$sql .= " `Molduras` = ? ,";
			$sql .= " `TaponGasolina` = ? ,";
			$sql .= " `Calaveras` = ? ,";
			$sql .= " `FarosNiebla` = ? ,";
			$sql .= " `ComentariosExt` = ? ,";
			$sql .= " `Limpiadores` = ? ,";
			$sql .= " `Flasher` = ? ,";
			$sql .= " `Calefaccion` = ? ,";
			$sql .= " `Radio` = ? ,";
			$sql .= " `Encendedor` = ? ,";
			$sql .= " `Retrovisor` = ? ,";
			$sql .= " `Cenicero` = ? ,";
			$sql .= " `Cinturones` = ? ,";
			$sql .= " `Reclinables` = ? ,";
			$sql .= " `Tapetes` = ? ,";
			$sql .= " `Vestiduras` = ? ,";
			$sql .= " `Guantera` = ? ,";
			$sql .= " `ComentariosInt` = ? ,";
			$sql .= " `Gato` = ? ,";
			$sql .= " `ManeralGato` = ? ,";
			$sql .= " `LlavedeLlantas` = ? ,";
			$sql .= " `Herramientas` = ? ,";
			$sql .= " `SenalesReflejantes` = ? ,";
			$sql .= " `Extinguidor` = ? ,";
			$sql .= " `LlantaRefaccion` = ? ,";
			$sql .= " `AlarmaControl` = ? ,";
			$sql .= " `EquipoAV` = ? ,";
			$sql .= " `CablesPasaCorriente` = ? ,";
			$sql .= " `DadoSeg` = ? ,";
			$sql .= " `ComentariosAcces` = ? ,";
			$sql .= " `TaponAceite` = ? ,";
			$sql .= " `TaponDirHD` = ? ,";
			$sql .= " `TaponDepFrenos` = ? ,";
			$sql .= " `TaponLimpiaparabrisas` = ? ,";
			$sql .= " `Bateria` = ? ,";
			$sql .= " `MarcaBateria` = ? ,";
			$sql .= " `Claxon` = ? ,";
			$sql .= " `ComentariosComp` = ? ,";
			$sql .= " `TarjetaCirc` = ? ,";
			$sql .= " `PolizaNum` = ? ,";
			$sql .= " `PolizaSeg` = ? ,";
			$sql .= " `ReporteNum` = ? ,";
			$sql .= " `siniestro` = ? ,";
			$sql .= " `deducible` = ? ,";
			$sql .= " `ManualProp` = ? ,";
			$sql .= " `TalonVerif` = ? ,";
			$sql .= " `ComentariosDoc` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `status_vehiculo` = ? ,";
			$sql .= " `fecha_firma` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE vehiculo SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_marca` = ? ,";
			$sql .= " `id_submarca` = ? ,";
			$sql .= " `id_cliente` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `id_taller` = ? ,";
			$sql .= " `id_aseguradora` = ? ,";
			$sql .= " `fecha_alta` = ? ,";
			$sql .= " `fecha_promesa` = ? ,";
			$sql .= " `modelo` = ? ,";
			$sql .= " `color` = ? ,";
			$sql .= " `placas_num` = ? ,";
			$sql .= " `kilometraje` = ? ,";
			$sql .= " `vin` = ? ,";
			$sql .= " `matricula` = ? ,";
			$sql .= " `TransmisionTipo` = ? ,";
			$sql .= " `FuncionamientoAC` = ? ,";
			$sql .= " `VestidurasTipo` = ? ,";
			$sql .= " `InteriorTipo` = ? ,";
			$sql .= " `RinTipo` = ? ,";
			$sql .= " `DirTipo` = ? ,";
			$sql .= " `Gasolina` = ? ,";
			$sql .= " `Faros` = ? ,";
			$sql .= " `Lucesch` = ? ,";
			$sql .= " `Antena` = ? ,";
			$sql .= " `EspejosLaterales` = ? ,";
			$sql .= " `Cristales` = ? ,";
			$sql .= " `Emblemas` = ? ,";
			$sql .= " `Llantas` = ? ,";
			$sql .= " `Taponesrin` = ? ,";
			$sql .= " `Molduras` = ? ,";
			$sql .= " `TaponGasolina` = ? ,";
			$sql .= " `Calaveras` = ? ,";
			$sql .= " `FarosNiebla` = ? ,";
			$sql .= " `ComentariosExt` = ? ,";
			$sql .= " `Limpiadores` = ? ,";
			$sql .= " `Flasher` = ? ,";
			$sql .= " `Calefaccion` = ? ,";
			$sql .= " `Radio` = ? ,";
			$sql .= " `Encendedor` = ? ,";
			$sql .= " `Retrovisor` = ? ,";
			$sql .= " `Cenicero` = ? ,";
			$sql .= " `Cinturones` = ? ,";
			$sql .= " `Reclinables` = ? ,";
			$sql .= " `Tapetes` = ? ,";
			$sql .= " `Vestiduras` = ? ,";
			$sql .= " `Guantera` = ? ,";
			$sql .= " `ComentariosInt` = ? ,";
			$sql .= " `Gato` = ? ,";
			$sql .= " `ManeralGato` = ? ,";
			$sql .= " `LlavedeLlantas` = ? ,";
			$sql .= " `Herramientas` = ? ,";
			$sql .= " `SenalesReflejantes` = ? ,";
			$sql .= " `Extinguidor` = ? ,";
			$sql .= " `LlantaRefaccion` = ? ,";
			$sql .= " `AlarmaControl` = ? ,";
			$sql .= " `EquipoAV` = ? ,";
			$sql .= " `CablesPasaCorriente` = ? ,";
			$sql .= " `DadoSeg` = ? ,";
			$sql .= " `ComentariosAcces` = ? ,";
			$sql .= " `TaponAceite` = ? ,";
			$sql .= " `TaponDirHD` = ? ,";
			$sql .= " `TaponDepFrenos` = ? ,";
			$sql .= " `TaponLimpiaparabrisas` = ? ,";
			$sql .= " `Bateria` = ? ,";
			$sql .= " `MarcaBateria` = ? ,";
			$sql .= " `Claxon` = ? ,";
			$sql .= " `ComentariosComp` = ? ,";
			$sql .= " `TarjetaCirc` = ? ,";
			$sql .= " `PolizaNum` = ? ,";
			$sql .= " `PolizaSeg` = ? ,";
			$sql .= " `ReporteNum` = ? ,";
			$sql .= " `siniestro` = ? ,";
			$sql .= " `deducible` = ? ,";
			$sql .= " `ManualProp` = ? ,";
			$sql .= " `TalonVerif` = ? ,";
			$sql .= " `ComentariosDoc` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `status_vehiculo` = ? ,";
			$sql .= " `fecha_firma` = ? ,";
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
			$stmt->mbind_param( 's', $this->fecha_alta );
			$stmt->mbind_param( 's', $this->fecha_promesa );
			$stmt->mbind_param( 's', $this->modelo );
			$stmt->mbind_param( 's', $this->color );
			$stmt->mbind_param( 's', $this->placas_num );
			$stmt->mbind_param( 's', $this->kilometraje );
			$stmt->mbind_param( 's', $this->vin );
			$stmt->mbind_param( 's', $this->matricula );
			$stmt->mbind_param( 's', $this->TransmisionTipo );
			$stmt->mbind_param( 's', $this->FuncionamientoAC );
			$stmt->mbind_param( 's', $this->VestidurasTipo );
			$stmt->mbind_param( 's', $this->InteriorTipo );
			$stmt->mbind_param( 's', $this->RinTipo );
			$stmt->mbind_param( 's', $this->DirTipo );
			$stmt->mbind_param( 's', $this->Gasolina );
			$stmt->mbind_param( 's', $this->Faros );
			$stmt->mbind_param( 's', $this->Lucesch );
			$stmt->mbind_param( 's', $this->Antena );
			$stmt->mbind_param( 's', $this->EspejosLaterales );
			$stmt->mbind_param( 's', $this->Cristales );
			$stmt->mbind_param( 's', $this->Emblemas );
			$stmt->mbind_param( 's', $this->Llantas );
			$stmt->mbind_param( 's', $this->Taponesrin );
			$stmt->mbind_param( 's', $this->Molduras );
			$stmt->mbind_param( 's', $this->TaponGasolina );
			$stmt->mbind_param( 's', $this->Calaveras );
			$stmt->mbind_param( 's', $this->FarosNiebla );
			$stmt->mbind_param( 's', $this->ComentariosExt );
			$stmt->mbind_param( 's', $this->Limpiadores );
			$stmt->mbind_param( 's', $this->Flasher );
			$stmt->mbind_param( 's', $this->Calefaccion );
			$stmt->mbind_param( 's', $this->Radio );
			$stmt->mbind_param( 's', $this->Encendedor );
			$stmt->mbind_param( 's', $this->Retrovisor );
			$stmt->mbind_param( 's', $this->Cenicero );
			$stmt->mbind_param( 's', $this->Cinturones );
			$stmt->mbind_param( 's', $this->Reclinables );
			$stmt->mbind_param( 's', $this->Tapetes );
			$stmt->mbind_param( 's', $this->Vestiduras );
			$stmt->mbind_param( 's', $this->Guantera );
			$stmt->mbind_param( 's', $this->ComentariosInt );
			$stmt->mbind_param( 's', $this->Gato );
			$stmt->mbind_param( 's', $this->ManeralGato );
			$stmt->mbind_param( 's', $this->LlavedeLlantas );
			$stmt->mbind_param( 's', $this->Herramientas );
			$stmt->mbind_param( 's', $this->SenalesReflejantes );
			$stmt->mbind_param( 's', $this->Extinguidor );
			$stmt->mbind_param( 's', $this->LlantaRefaccion );
			$stmt->mbind_param( 's', $this->AlarmaControl );
			$stmt->mbind_param( 's', $this->EquipoAV );
			$stmt->mbind_param( 's', $this->CablesPasaCorriente );
			$stmt->mbind_param( 's', $this->DadoSeg );
			$stmt->mbind_param( 's', $this->ComentariosAcces );
			$stmt->mbind_param( 's', $this->TaponAceite );
			$stmt->mbind_param( 's', $this->TaponDirHD );
			$stmt->mbind_param( 's', $this->TaponDepFrenos );
			$stmt->mbind_param( 's', $this->TaponLimpiaparabrisas );
			$stmt->mbind_param( 's', $this->Bateria );
			$stmt->mbind_param( 's', $this->MarcaBateria );
			$stmt->mbind_param( 's', $this->Claxon );
			$stmt->mbind_param( 's', $this->ComentariosComp );
			$stmt->mbind_param( 's', $this->TarjetaCirc );
			$stmt->mbind_param( 's', $this->PolizaNum );
			$stmt->mbind_param( 's', $this->PolizaSeg );
			$stmt->mbind_param( 's', $this->ReporteNum );
			$stmt->mbind_param( 's', $this->siniestro );
			$stmt->mbind_param( 's', $this->deducible );
			$stmt->mbind_param( 's', $this->ManualProp );
			$stmt->mbind_param( 's', $this->TalonVerif );
			$stmt->mbind_param( 's', $this->ComentariosDoc );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
			$stmt->mbind_param( 's', $this->status_vehiculo );
			$stmt->mbind_param( 's', $this->fecha_firma );
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
			if (in_array("fecha_alta",$fieldstoupdate)){
				$sql .= " `fecha_alta` = ? ,";
			}
			if (in_array("fecha_promesa",$fieldstoupdate)){
				$sql .= " `fecha_promesa` = ? ,";
			}
			if (in_array("modelo",$fieldstoupdate)){
				$sql .= " `modelo` = ? ,";
			}
			if (in_array("color",$fieldstoupdate)){
				$sql .= " `color` = ? ,";
			}
			if (in_array("placas_num",$fieldstoupdate)){
				$sql .= " `placas_num` = ? ,";
			}
			if (in_array("kilometraje",$fieldstoupdate)){
				$sql .= " `kilometraje` = ? ,";
			}
			if (in_array("vin",$fieldstoupdate)){
				$sql .= " `vin` = ? ,";
			}
			if (in_array("matricula",$fieldstoupdate)){
				$sql .= " `matricula` = ? ,";
			}
			if (in_array("TransmisionTipo",$fieldstoupdate)){
				$sql .= " `TransmisionTipo` = ? ,";
			}
			if (in_array("FuncionamientoAC",$fieldstoupdate)){
				$sql .= " `FuncionamientoAC` = ? ,";
			}
			if (in_array("VestidurasTipo",$fieldstoupdate)){
				$sql .= " `VestidurasTipo` = ? ,";
			}
			if (in_array("InteriorTipo",$fieldstoupdate)){
				$sql .= " `InteriorTipo` = ? ,";
			}
			if (in_array("RinTipo",$fieldstoupdate)){
				$sql .= " `RinTipo` = ? ,";
			}
			if (in_array("DirTipo",$fieldstoupdate)){
				$sql .= " `DirTipo` = ? ,";
			}
			if (in_array("Gasolina",$fieldstoupdate)){
				$sql .= " `Gasolina` = ? ,";
			}
			if (in_array("Faros",$fieldstoupdate)){
				$sql .= " `Faros` = ? ,";
			}
			if (in_array("Lucesch",$fieldstoupdate)){
				$sql .= " `Lucesch` = ? ,";
			}
			if (in_array("Antena",$fieldstoupdate)){
				$sql .= " `Antena` = ? ,";
			}
			if (in_array("EspejosLaterales",$fieldstoupdate)){
				$sql .= " `EspejosLaterales` = ? ,";
			}
			if (in_array("Cristales",$fieldstoupdate)){
				$sql .= " `Cristales` = ? ,";
			}
			if (in_array("Emblemas",$fieldstoupdate)){
				$sql .= " `Emblemas` = ? ,";
			}
			if (in_array("Llantas",$fieldstoupdate)){
				$sql .= " `Llantas` = ? ,";
			}
			if (in_array("Taponesrin",$fieldstoupdate)){
				$sql .= " `Taponesrin` = ? ,";
			}
			if (in_array("Molduras",$fieldstoupdate)){
				$sql .= " `Molduras` = ? ,";
			}
			if (in_array("TaponGasolina",$fieldstoupdate)){
				$sql .= " `TaponGasolina` = ? ,";
			}
			if (in_array("Calaveras",$fieldstoupdate)){
				$sql .= " `Calaveras` = ? ,";
			}
			if (in_array("FarosNiebla",$fieldstoupdate)){
				$sql .= " `FarosNiebla` = ? ,";
			}
			if (in_array("ComentariosExt",$fieldstoupdate)){
				$sql .= " `ComentariosExt` = ? ,";
			}
			if (in_array("Limpiadores",$fieldstoupdate)){
				$sql .= " `Limpiadores` = ? ,";
			}
			if (in_array("Flasher",$fieldstoupdate)){
				$sql .= " `Flasher` = ? ,";
			}
			if (in_array("Calefaccion",$fieldstoupdate)){
				$sql .= " `Calefaccion` = ? ,";
			}
			if (in_array("Radio",$fieldstoupdate)){
				$sql .= " `Radio` = ? ,";
			}
			if (in_array("Encendedor",$fieldstoupdate)){
				$sql .= " `Encendedor` = ? ,";
			}
			if (in_array("Retrovisor",$fieldstoupdate)){
				$sql .= " `Retrovisor` = ? ,";
			}
			if (in_array("Cenicero",$fieldstoupdate)){
				$sql .= " `Cenicero` = ? ,";
			}
			if (in_array("Cinturones",$fieldstoupdate)){
				$sql .= " `Cinturones` = ? ,";
			}
			if (in_array("Reclinables",$fieldstoupdate)){
				$sql .= " `Reclinables` = ? ,";
			}
			if (in_array("Tapetes",$fieldstoupdate)){
				$sql .= " `Tapetes` = ? ,";
			}
			if (in_array("Vestiduras",$fieldstoupdate)){
				$sql .= " `Vestiduras` = ? ,";
			}
			if (in_array("Guantera",$fieldstoupdate)){
				$sql .= " `Guantera` = ? ,";
			}
			if (in_array("ComentariosInt",$fieldstoupdate)){
				$sql .= " `ComentariosInt` = ? ,";
			}
			if (in_array("Gato",$fieldstoupdate)){
				$sql .= " `Gato` = ? ,";
			}
			if (in_array("ManeralGato",$fieldstoupdate)){
				$sql .= " `ManeralGato` = ? ,";
			}
			if (in_array("LlavedeLlantas",$fieldstoupdate)){
				$sql .= " `LlavedeLlantas` = ? ,";
			}
			if (in_array("Herramientas",$fieldstoupdate)){
				$sql .= " `Herramientas` = ? ,";
			}
			if (in_array("SenalesReflejantes",$fieldstoupdate)){
				$sql .= " `SenalesReflejantes` = ? ,";
			}
			if (in_array("Extinguidor",$fieldstoupdate)){
				$sql .= " `Extinguidor` = ? ,";
			}
			if (in_array("LlantaRefaccion",$fieldstoupdate)){
				$sql .= " `LlantaRefaccion` = ? ,";
			}
			if (in_array("AlarmaControl",$fieldstoupdate)){
				$sql .= " `AlarmaControl` = ? ,";
			}
			if (in_array("EquipoAV",$fieldstoupdate)){
				$sql .= " `EquipoAV` = ? ,";
			}
			if (in_array("CablesPasaCorriente",$fieldstoupdate)){
				$sql .= " `CablesPasaCorriente` = ? ,";
			}
			if (in_array("DadoSeg",$fieldstoupdate)){
				$sql .= " `DadoSeg` = ? ,";
			}
			if (in_array("ComentariosAcces",$fieldstoupdate)){
				$sql .= " `ComentariosAcces` = ? ,";
			}
			if (in_array("TaponAceite",$fieldstoupdate)){
				$sql .= " `TaponAceite` = ? ,";
			}
			if (in_array("TaponDirHD",$fieldstoupdate)){
				$sql .= " `TaponDirHD` = ? ,";
			}
			if (in_array("TaponDepFrenos",$fieldstoupdate)){
				$sql .= " `TaponDepFrenos` = ? ,";
			}
			if (in_array("TaponLimpiaparabrisas",$fieldstoupdate)){
				$sql .= " `TaponLimpiaparabrisas` = ? ,";
			}
			if (in_array("Bateria",$fieldstoupdate)){
				$sql .= " `Bateria` = ? ,";
			}
			if (in_array("MarcaBateria",$fieldstoupdate)){
				$sql .= " `MarcaBateria` = ? ,";
			}
			if (in_array("Claxon",$fieldstoupdate)){
				$sql .= " `Claxon` = ? ,";
			}
			if (in_array("ComentariosComp",$fieldstoupdate)){
				$sql .= " `ComentariosComp` = ? ,";
			}
			if (in_array("TarjetaCirc",$fieldstoupdate)){
				$sql .= " `TarjetaCirc` = ? ,";
			}
			if (in_array("PolizaNum",$fieldstoupdate)){
				$sql .= " `PolizaNum` = ? ,";
			}
			if (in_array("PolizaSeg",$fieldstoupdate)){
				$sql .= " `PolizaSeg` = ? ,";
			}
			if (in_array("ReporteNum",$fieldstoupdate)){
				$sql .= " `ReporteNum` = ? ,";
			}
			if (in_array("siniestro",$fieldstoupdate)){
				$sql .= " `siniestro` = ? ,";
			}
			if (in_array("deducible",$fieldstoupdate)){
				$sql .= " `deducible` = ? ,";
			}
			if (in_array("ManualProp",$fieldstoupdate)){
				$sql .= " `ManualProp` = ? ,";
			}
			if (in_array("TalonVerif",$fieldstoupdate)){
				$sql .= " `TalonVerif` = ? ,";
			}
			if (in_array("ComentariosDoc",$fieldstoupdate)){
				$sql .= " `ComentariosDoc` = ? ,";
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
			if (in_array("deleted_date",$fieldstoupdate)){
				$sql .= " `deleted_date` = ? ,";
			}
			if (in_array("status_vehiculo",$fieldstoupdate)){
				$sql .= " `status_vehiculo` = ? ,";
			}
			if (in_array("fecha_firma",$fieldstoupdate)){
				$sql .= " `fecha_firma` = ? ,";
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
			if (in_array("fecha_alta",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaAlta  );
			}
			if (in_array("fecha_promesa",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaPromesa  );
			}
			if (in_array("modelo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->modelo  );
			}
			if (in_array("color",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->color  );
			}
			if (in_array("placas_num",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->placasNum  );
			}
			if (in_array("kilometraje",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->kilometraje  );
			}
			if (in_array("vin",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->vin  );
			}
			if (in_array("matricula",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->matricula  );
			}
			if (in_array("TransmisionTipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->transmisionTipo  );
			}
			if (in_array("FuncionamientoAC",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->funcionamientoAC  );
			}
			if (in_array("VestidurasTipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->vestidurasTipo  );
			}
			if (in_array("InteriorTipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->interiorTipo  );
			}
			if (in_array("RinTipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->rinTipo  );
			}
			if (in_array("DirTipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->dirTipo  );
			}
			if (in_array("Gasolina",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->gasolina  );
			}
			if (in_array("Faros",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->faros  );
			}
			if (in_array("Lucesch",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->lucesch  );
			}
			if (in_array("Antena",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->antena  );
			}
			if (in_array("EspejosLaterales",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->espejosLaterales  );
			}
			if (in_array("Cristales",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cristales  );
			}
			if (in_array("Emblemas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->emblemas  );
			}
			if (in_array("Llantas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->llantas  );
			}
			if (in_array("Taponesrin",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponesrin  );
			}
			if (in_array("Molduras",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->molduras  );
			}
			if (in_array("TaponGasolina",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponGasolina  );
			}
			if (in_array("Calaveras",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->calaveras  );
			}
			if (in_array("FarosNiebla",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->farosNiebla  );
			}
			if (in_array("ComentariosExt",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentariosExt  );
			}
			if (in_array("Limpiadores",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->limpiadores  );
			}
			if (in_array("Flasher",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->flasher  );
			}
			if (in_array("Calefaccion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->calefaccion  );
			}
			if (in_array("Radio",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->radio  );
			}
			if (in_array("Encendedor",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->encendedor  );
			}
			if (in_array("Retrovisor",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->retrovisor  );
			}
			if (in_array("Cenicero",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cenicero  );
			}
			if (in_array("Cinturones",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cinturones  );
			}
			if (in_array("Reclinables",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->reclinables  );
			}
			if (in_array("Tapetes",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tapetes  );
			}
			if (in_array("Vestiduras",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->vestiduras  );
			}
			if (in_array("Guantera",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->guantera  );
			}
			if (in_array("ComentariosInt",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentariosInt  );
			}
			if (in_array("Gato",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->gato  );
			}
			if (in_array("ManeralGato",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->maneralGato  );
			}
			if (in_array("LlavedeLlantas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->llavedeLlantas  );
			}
			if (in_array("Herramientas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->herramientas  );
			}
			if (in_array("SenalesReflejantes",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->senalesReflejantes  );
			}
			if (in_array("Extinguidor",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->extinguidor  );
			}
			if (in_array("LlantaRefaccion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->llantaRefaccion  );
			}
			if (in_array("AlarmaControl",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->alarmaControl  );
			}
			if (in_array("EquipoAV",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->equipoAV  );
			}
			if (in_array("CablesPasaCorriente",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cablesPasaCorriente  );
			}
			if (in_array("DadoSeg",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->dadoSeg  );
			}
			if (in_array("ComentariosAcces",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentariosAcces  );
			}
			if (in_array("TaponAceite",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponAceite  );
			}
			if (in_array("TaponDirHD",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponDirHD  );
			}
			if (in_array("TaponDepFrenos",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponDepFrenos  );
			}
			if (in_array("TaponLimpiaparabrisas",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->taponLimpiaparabrisas  );
			}
			if (in_array("Bateria",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->bateria  );
			}
			if (in_array("MarcaBateria",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->marcaBateria  );
			}
			if (in_array("Claxon",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->claxon  );
			}
			if (in_array("ComentariosComp",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentariosComp  );
			}
			if (in_array("TarjetaCirc",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tarjetaCirc  );
			}
			if (in_array("PolizaNum",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->polizaNum  );
			}
			if (in_array("PolizaSeg",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->polizaSeg  );
			}
			if (in_array("ReporteNum",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->reporteNum  );
			}
			if (in_array("siniestro",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->siniestro  );
			}
			if (in_array("deducible",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deducible  );
			}
			if (in_array("ManualProp",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->manualProp  );
			}
			if (in_array("TalonVerif",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->talonVerif  );
			}
			if (in_array("ComentariosDoc",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->comentariosDoc  );
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
			if (in_array("deleted_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deletedDate  );
			}
			if (in_array("status_vehiculo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->statusVehiculo  );
			}
			if (in_array("fecha_firma",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaFirma  );
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
