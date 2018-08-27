<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "company.auto.class.php");
class Company extends AutoCompany { 


		public function getAjaxCompanyRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
			$onPage=1 * $onPage;
			$numRows = 1 * $numRows;
			if ($onPage<1){$onPage=1;}
			if ($numRows<1 || $numRows>100 ){$numRows=10;}
			
			$sql= "SELECT count(l.id) as cnt FROM company l WHERE 1 ";//. $num ; 

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

			$sql= "SELECT * FROM company l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ; 

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
		public function getAll()
		{

			$sql= "SELECT * FROM company";//. $num ;

			$res=$this->db->query($sql);
			$set=array();
			if(!$res)
				{die('Error getting result');}
			else
			{
				while ($row = $res->fetch_assoc())
					{$set[]=$row;}
			}
			//echo $this->db->error;
			$res->close();

			return $set;
		}


}
