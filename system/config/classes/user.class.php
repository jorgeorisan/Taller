<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "user.auto.class.php");
class User extends AutoUser {


		public function getAjaxUserRows($onPage=1,$numRows=10,$sortIndex="id",$shortOrder="asc"){
				$onPage=1 * $onPage;
				$numRows = 1 * $numRows;
				if ($onPage<1){$onPage=1;}
				if ($numRows<1 || $numRows>100 ){$numRows=10;}

				$sql= "SELECT count(l.id) as cnt FROM user l WHERE 1 ";//. $num ;

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

				$sql= "SELECT * FROM user l WHERE 1 ORDER BY " . $sortIndex . " " .$shortOrder." LIMIT " . ($onPage-1)*$numRows . " , " . $numRows . "  ";//. $num ;

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

		public function getAllUsers()
		{

			$sql= "SELECT id,first_name,last_name,email,type,enabled FROM user";//. $num ;

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
		public function addUser($email,$first_name,$last_name,$test)
		{
			$email=$this->db->real_escape_string($email);
			$first_name=$this->db->real_escape_string($first_name);
			$last_name=$this->db->real_escape_string($last_name);
			$sql= "INSERT INTO user(email,first_name,last_name) VALUES('".$email."','".$first_name."','".$last_name."');";
			$res=$this->db->query($sql);
			//echo $this->db->error;
			//$res->close();

		}

		public function saveUser($id,$email,$first_name,$last_name,$enabled)
		{
			$email=$this->db->real_escape_string($email);
			$first_name=$this->db->real_escape_string($first_name);
			$last_name=$this->db->real_escape_string($last_name);
			//$enabled=$this->db->real_escape_string($enabled);
			$sql= "UPDATE user SET email='".$email."',first_name='".$first_name."',last_name='".$last_name."',enabled=".$enabled." WHERE id=".$id.";";
			//echo $sql;
			$row=$this->db->query($sql);

			if(!$row)
				{
					return false;}
			else
				{
					return true;}
			//echo $this->db->error;

		}


		public function userExists($email)
		{

			$email=$this->db->real_escape_string($email);
			$sql= "SELECT * FROM user WHERE email='".$email."';";
			$res=$this->db->query($sql);
			if(!$res)
				{die('Error getting result');}
			//echo $sql;
			$row = $res->fetch_assoc();
			//echo $this->db->error;
			$res->close();
			if(!$row)
				{
					return false;}
			else
				{
					return true;}

		}

		public function getUser($id)
		{
			$id=$this->db->real_escape_string($id);
			$sql= "SELECT * FROM user WHERE id='".$id."';";
			$res=$this->db->query($sql);
			if(!$res)
				{die('Error getting result');}
			//echo $sql;
			$row = $res->fetch_assoc();
			$res->close();

			//echo $this->db->error;

			return $row;

		}


}
