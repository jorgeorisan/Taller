<?php
$_SERVER['HTTP_HOST']="";
include_once("../config/config.php");
include_once("../config/classes/db.class.php");

if ( !isset($argv[1]) || !isset($argv[2]) ){
	echo "\n\n\n--------------\nusage: " . $argv[0]. " table_name model_name \n\t\te.g. "  . $argv[0]. " user User\n\nThe following files are created:\nsystem/config/classes/{table_name}.auto.class.php\nsystem/config/classes/{table_name}.class.php\nsystem/pages/Ajax_{table_name}.php\nsystem/pages/{table_name}_jqgrid.php\n";
	die;
}else{
	$table_name=$argv[1];
	$model_name=$argv[2];
}

function camelCase($str){
	$ret="";
	$a=explode("_",$str);
	foreach ($a as $aa){
		$ret.=ucfirst($aa);
	}
	return lcfirst($ret);
}

/*
Type number to type name to bind type;
numerics
-------------
BIT: 16
TINYINT: 1
BOOL: 1
SMALLINT: 2
MEDIUMINT: 9
INTEGER: 3
BIGINT: 8
SERIAL: 8
FLOAT: 4
DOUBLE: 5
DECIMAL: 246
NUMERIC: 246
FIXED: 246

dates
------------
DATE: 10
DATETIME: 12
TIMESTAMP: 7
TIME: 11
YEAR: 13

strings & binary
------------
CHAR: 254
VARCHAR: 253
ENUM: 254
SET: 254
BINARY: 254
VARBINARY: 253
TINYBLOB: 252
BLOB: 252
MEDIUMBLOB: 252
TINYTEXT: 252
TEXT: 252
MEDIUMTEXT: 252
LONGTEXT: 252

// mysqli bind
The argument may be one of four types:

    i - integer
    d - double
    s - string
    b - BLOB


/// Naming conventions

Model name: First capitalized, singular (e.g. User)
Database name: all lower case, plural (e.g. users)

Database fields: all lower case, singular, if two words use _  (e.g. id, email, first_name)
Database primary key: id int(11) auto increment
Database created modified: created datetime, modified datetime  (ALL TIMES/DATES should be UTC)

Model field names:  camal case of database fields (e.g.  email, firstName)
Model setters and getters:  camal case (e.g setEmail, getFirstName)

*/
$fieldTypes= array(
		1=>array('num'=>1,'type'=>'BOOL','bind'=>'s'),
		2=>array('num'=>2,'type'=>'SMALLINT','bind'=>'i'),
		3=>array('num'=>3,'type'=>'INTEGER','bind'=>'i'),
		4=>array('num'=>4,'type'=>'FLOAT','bind'=>'d'),
		5=>array('num'=>5,'type'=>'DOUBLE','bind'=>'d'),
		7=>array('num'=>7,'type'=>'TIMESTAMP','bind'=>'s'),
		8=>array('num'=>8,'type'=>'SERIAL','bind'=>'s'),
		9=>array('num'=>9,'type'=>'MEDIUMINT','bind'=>'i'),
		10=>array('num'=>10,'type'=>'DATE','bind'=>'s'),
		11=>array('num'=>11,'type'=>'TIME','bind'=>'s'),
		12=>array('num'=>12,'type'=>'DATETIME','bind'=>'s'),
		13=>array('num'=>13,'type'=>'YEAR','bind'=>'s'),
		16=>array('num'=>16,'type'=>'BIT','bind'=>'s'),
		246=>array('num'=>246,'type'=>'DECIMAL','bind'=>'d'),
		252=>array('num'=>252,'type'=>'BLOB','bind'=>'b'),
		252=>array('num'=>252,'type'=>'TEXT','bind'=>'s'),
		253=>array('num'=>253,'type'=>'VARCHAR','bind'=>'s'),
		254=>array('num'=>254,'type'=>'CHAR','bind'=>'s')
	);



     // Set character set, to show its impact on some values (e.g., length in bytes)
    //$db->set_charset($charset);

    $query = "SELECT *  from ".$db->real_escape_string($table_name)." ORDER BY id";

    $fields=array();
    
    if ($result = $db->query($query)) {

        /* Get field information for all columns */
        $finfo = $result->fetch_fields();

        foreach ($finfo as $val) {
        	$fields[$val->name]=array(
        		'database_name'=>$val->name,
        		'model_name'=>camelCase($val->name),
        		'bind_type'=>$fieldTypes[$val->type]['bind'],
        		'num'=>$fieldTypes[$val->type]['num']
        	);

/*
            printf("Name:      %s\n",   $val->name);
            printf("Table:     %s\n",   $val->table);
            printf("Max. Len:  %d\n",   $val->max_length);
            printf("Length:    %d\n",   $val->length);
            printf("charsetnr: %d\n",   $val->charsetnr);
            printf("Flags:     %d\n",   $val->flags);
            printf("Type:      %d\n\n", $val->type);
*/            
        }
        $result->free();
    }
 //print_r($finfo);die;

/*  START OF AUTO GENERATED CLASS  */
$output ='<?php 

	class Auto' . $model_name . ' {

	// Variables
		protected $db;
		';


 $output.="\n";
foreach ($fields as $k=>$v){
	$output.= "\t\tprotected $".$v['database_name'];
	if ($v['bind_type']=="i" ||$v['bind_type']=="d" ){
		$output.= " = 0;\n";
	}else {
		$output.= " = \"\";\n";
	}
}
$output.= '
		protected $validclass = true;
		protected $statusclass = array();
';

$output.= "\n\n";


$output.= '	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$'. lcfirst($model_name) .' = new '. $model_name .'();
			$'. lcfirst($model_name) .'->setId( $id );
			return $'. lcfirst($model_name) .';
		}
		public static function constructWithValues( $values ){
			$'. lcfirst($model_name) .' = new '. $model_name .'();
			$'. lcfirst($model_name) .'->setValues( $values );
			return $'. lcfirst($model_name) .';
		}
';

$output.= "\n\n" .'	// Setter Methods' . "";
foreach ($fields as $k=>$v){
		$output.= '
		public function set' . ucfirst($v['model_name']) . '( $value ){';
		if ($v['num'] != 252){
$output.='			
			if ( $this->validclassateInput("/^.*$/", $value, "' . strtoupper($v['model_name']) . '","'.$v['bind_type'].'") ) 
';
		}
$output.= ' 				$this->' . $v['database_name'] . ' = $value;
		}
		'."";
}
 
$output.= '
		public function setValidclass( $value ){
			if ( $this->validclassateInput(\'/^(true|false)$/\', ( $value ) ? \'true\' : \'false\', "Validclass",\'s\') )
				$this->validclass = $value;
		}

		public function setStatusclass( $value ){
			if ( ! is_array($this->statusclass) ){
				$this->statusclass=array();
			}

			$this->statusclass[] = $value;
			$this->statusclass = array_unique($this->statusclass );
			
		}
';		

$output.= "\n\n" .'	// Getter Methods' . "";
foreach ($fields as $k=>$v){
		$output.= '
		public function get' . ucfirst($v['model_name']) . '($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->' . $v['database_name'] . ') ;
 			}else{
 				return $this->' . $v['database_name'] . ' ;
 			}
		}
		'."";
}
$output.= '
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}
';		

$output.= '
	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM ' . $table_name . ' WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalidclass( "The ID not validclass." );

			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( \'i\', $id );
			$stmt->execute();

			$res = $stmt->get_result();
			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalidclass( "Unable to retrieve information for ID. Please try again later, or contact support." );
			}
';
foreach ($fields as $k=>$v){
		$output.= '
			$this->set' . ucfirst($v['model_name']) . '( $res[\'' . $v['database_name'] . '\'] );';
}
$output.= '
			return true;
		}
		// end function load
';

$output.= '
		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO ' . $table_name . ' SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		$output.= '
			$sql .= " `'.$v['database_name'].'` = ? ,";';
		}
}
$output.= '
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE ' . $table_name . ' SET modified=UTC_TIMESTAMP(),";	
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		$output.= '
			$sql .= " `' . $v['database_name'] . '` = ? ,";';
		}
}
$output.= '
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}
';

$output.= '
			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( \'i\', $id );
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		$output.= '
			$stmt->mbind_param( \'' . $v['bind_type'] . '\', $this->' . $v['database_name'] . ' );';
		}
}
$output.= '
			if ($this->getId()>0){
				$stmt->mbind_param( \'i\', $this->id  );
			} // end save
';


$output.= '
			$stmt->execute();
			if ($this->getId()==0){
				$this->setId( $this->db->insert_id );
			}
			return $this->getId();
		}
		
';

/// updateFields
$output.= '
		public function updateFields($fieldstoupdate) {
			if ($this->getId()==0){ // insert new
				// only updates no save new here
			} else { // updated existing
				$sql = "UPDATE ' . $table_name . ' SET modified=UTC_TIMESTAMP(),";	
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created'  ){
		$output.= '
			if (in_array("' . $k . '",$fieldstoupdate)){
				$sql .= " `' . $v['database_name'] . '` = ? ,";
			}';
		}
}
$output.= '
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}
';

$output.= '
			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( \'i\', $id );
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		$output.= '
			if (in_array("' . $k . '",$fieldstoupdate)){
				$stmt->mbind_param( \'' . $v['bind_type'] . '\', $this->' . $v['model_name'] .  '  );
			}';
		}
}
$output.= '
			if ($this->getId()>0){
				$stmt->mbind_param( \'i\', $this->getId()  );
			}
';
$output.= '
			$stmt->execute();
			//if ($this->getId()==0){
			//	$this->setId( $this->db->insert_id );
			//}
			return $this->getId();
		}  // updateFields
		
';






$output.= '
		public function getAll() {
			$sql="SELECT id FROM ' . $table_name . ' WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new ' . $model_name . '();
				$retval[$id[0]]->load($id[0]);
			}
			return $retval;
		}

';

$output.= '

	// Private Support Functions
		protected function validclassateInput( $pcre, $input, $field , $bind_type) {
			//if ( ! $this->validclass )
			//	return $this->validclass;

			if ( ! preg_match($pcre, $input) ){ 
				return $this->killInvalidclass( "The input provided for the field \'$field\' is not validclass. Value provided: ".htmlentities($input),$field);
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
';

$output.= '
}
';
$filename=SYSTEM_DIR.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR.$table_name.".auto.class.php";
file_put_contents($filename, $output) ;


$filename=SYSTEM_DIR.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR.$table_name.".class.php";

$output='<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "' . $table_name . '.auto.class.php");

class ' . $model_name . ' extends Auto' . $model_name . ' { 

		public function getAjax' . $model_name . 'Rows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
			$onPage=1 * $onPage;
			$numRows = 1 * $numRows;
			if ($onPage<1){$onPage=1;}
			if ($numRows<1 || $numRows>100 ){$numRows=10;}
			
			$sql= "SELECT count(l.id) as cnt FROM ' . $table_name . ' l WHERE 1 ";//. $num ; 

 			if (!$stmt = $this->db->prepare( $sql )){die("bad query");}
			$stmt->execute();
			$res = $stmt->get_result();
			$records = 0;
			if($row = $res->fetch_assoc()){
				$records=$row["cnt"]; 
			}
			$res->free();
			$stmt->close();

			$total=ceil($records/$numRows); // number of pages
			$retval=array("records"=>$records , "page"=>$onPage , "total"=>$total , "rows"=>array() );

			if (in_array($sortIndex,array("id","name"))){}else{$sortIndex="id";} 
			if (in_array($shortOrder,array("asc","desc"))){}else{$shortOrder="asc";} 

			$sql= "SELECT * FROM ' . $table_name . ' l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ; 

				if (!$stmt = $this->db->prepare( $sql )){echo $sql;die("bad query2");}
				$stmt->execute();
			$res = $stmt->get_result();

			while($row = $res->fetch_assoc()){
				foreach($row as $kk=>$vv){$row[$kk]=htmlentities($vv);}
				//echo ss;
				//print_r($row);
				$retval["rows"][] = $row; 
			}
			$res->free();
			$stmt->close();
		 	//print_r($retval);
			//echo json_encode($retval, JSON_HEX_APOS);
			//echo json_last_error (  );
			//echo json_last_error_msg();
			return json_encode($retval);
			
		}


}
';
if (file_exists($filename)){
	$filename.="__".date('Ymdhsi')."-".uniqid();
}

file_put_contents($filename, $output) ;





/*
$output  = <<<EOF
<?php 

	class {!MODEL_NAME!} {

	// Variables
		protected $db;
		protected $id = 0;

		protected $email = "";
		protected $first_name = "";
		protected $last_name = "";

		protected $initials = "";
		protected $password = ""; 
		protected $type = ""; 

		protected $token = ""; 
		protected $token_expires = ""; 

		protected $deleted = 0;
		protected $enabled = 0; 

		protected $created = "";
		protected $modified = "";

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
			if ( $this->validclassateInput('/^[0-9]{1,10}$/', $value, "ID") ) 
 				$this->id = $value;
		}
		public function setEmail( $value ){
			if ( $this->validclassateInput('/^[a-z0-9]+@illumant\.com$/', $value, "Email") ) 
 				$this->email = $value;
		}


EOF;
*/