<?php

//require_once("/var/www/html/SocEng_v2.2/SocEng/system/config/classes/campaign.auto.class.php");
require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "campaign.auto.class.php");
class Campaign extends AutoCampaign {


			public function getAjaxCampaignRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
				$onPage=1 * $onPage;
				$numRows = 1 * $numRows;
				if ($onPage<1){$onPage=1;}
				if ($numRows<1 || $numRows>100 ){$numRows=10;}

				$sql= "SELECT count(l.id) as cnt FROM campaign l WHERE 1 ";//. $num ;

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

				$sql= "SELECT * FROM campaign l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ;

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

		public function getCampaignTypes()
		{
			$sql= "SELECT id,name FROM campaign_type WHERE status='ACTIVE';";
			$res=$this->db->query($sql);
			//echo $this->db->error;
			$set=array();
			if(!$res)
				{die('Error getting result');}
			else
			{
				while ($row = $res->fetch_assoc())
					{$set[]=$row;}
			}
			$res->close();

			return $set;
		}
		public function addCampaign($name,$description,$projectid,$typeid)
		{
			$name=$this->db->real_escape_string($name);
			$description=$this->db->real_escape_string($description);
			$sql= "INSERT INTO campaign(name,description,status,created,project_id,campaign_type_id) VALUES('".$name."','".$description."','ACTIVE',NOW(),".$projectid.",".$typeid.");";
			echo $sql;
			$res=$this->db->query($sql);
			//echo $this->db->error;

		}

		public function getCampaigns()
		{
			$sql= 'SELECT campaign.id as id,campaign.name as name,campaign.description as description,campaign.status as status,campaign.created_date as created
                  FROM campaign
                    ORDER BY created_date DESC;';//. $num ;
			//echo '+++++++++'.$sql;
			$res=$this->db->query($sql);
			//echo $this->db->error;
			$set=array();
			if(!$res)
				{die('Error getting result');}
			else
			{
				while ($row = $res->fetch_assoc())
					{$set[]=$row;}
			}
			$res->close();

			return $set;

		}

		public function getCampaign($id)
		{
			$id=$this->db->real_escape_string($id);
			$sql= "SELECT * FROM campaign WHERE id='".$id."';";
			$res=$this->db->query($sql);
			if(!$res)
				{die('Error getting result');}
			//echo $sql;
			$row = $res->fetch_assoc();
			//echo $this->db->error;

			return $row;

		}


}
