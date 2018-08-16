<?php

// get users

$con=start_connection();
$users=array();
		$sql="SELECT id,email,type,first_name,last_name,enabled,deleted FROM users WHERE 1"; 
		 
		if ($result = $con->query($sql)) {

		    while($row = $result->fetch_array(MYSQL_ASSOC)) {
		    		//$row['password']=''; 
		            $users[] = $row;
		    } 
		}

$result->close();
close_connection($con);


// check if $blog_path is in database -- if so display , if not show blog listing page (Blog_list.php )


include_once("includes/top.php");

?><!--=== Content Part ===-->
<link rel="stylesheet" href="http://www.dropzonejs.com/css/dropzone.css?v=1473248119" />
<div class="breadcrumbs">
			<div class="container">
				<h1 class="pull-left">Image Upload Example</h1>
				<ul class="pull-right breadcrumb">
					 
				</ul>
			</div>
		</div>
 
			<div class="container content-sm">
				<div class="row">
 <div class="col-12">		 
<pre>
Example image up load


</pre>

   <div class="row"><div class="col-12-md">

						<form action="<?php echo  make_url("Upload"); ?>" class="dropzone" id="mydropzone"></form>

					</div>

					</div>


</div>


</div>



</div>						
					<!-- End Blog All Posts -->
		<!-- PAGE RELATED PLUGIN(S) -->

<?php 
include_once("includes/footer.php");