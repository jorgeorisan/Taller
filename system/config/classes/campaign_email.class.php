<?php

require_once("/var/www/html/SocEng_v2.2/SocEng/system/config/classes/campaign_email.auto.class.php");
class CampaignEmail extends AutoCampaignEmail { 


			public function getAjaxCampaignEmailRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
				$onPage=1 * $onPage;
				$numRows = 1 * $numRows;
				if ($onPage<1){$onPage=1;}
				if ($numRows<1 || $numRows>100 ){$numRows=10;}
				
				$sql= "SELECT count(l.id) as cnt FROM campaign_email l WHERE 1 ";//. $num ; 

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

				$sql= "SELECT * FROM campaign_email l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ; 
 
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
