
<style>	
	.table{
		background-color:#ffffff !important;
	}
	thead{
		background-color:#3c8dbc !important;
	}
</style>
<div class="container-fluid">
  <div><h3>Job</h3></div>
</div>
<div class="sidebar-jobs box">
	<div class="container">
	 <?php
    	if(!empty($deposit)){
	    		 ?>
		<div class="row">
		  <h3><?php echo $deposit['job_title'] ?></h3>
		  <hr>
			<div class="col-sm-6">
			  <p><b>Work Type</b> : <?php echo GlobalFunction::getworkType($deposit['work_type'] ); ?></p>
			  <p><b>How Long</b> : <?php echo GlobalFunction::HowLong($deposit['how_long'] ); ?></p>
			  <p><b>Category</b> : <?php 
	    		  $Category = Category::model()->find("id='".$deposit['category_id']."'");
						  if(!empty($Category)){
						   
						     echo $Category->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></p>
			  <p><b>Commitment</b> : <?php echo GlobalFunction::getcommitment($deposit['commitment'] ); ?></p> 
			</div>
			<div class="col-sm-6">
			  <p><b>Sub Category</b> : <?php 
	    		    $subcategory = Category::model()->find("id='".$deposit['subcategory_id']."'");
						  if(!empty($subcategory)){
						   
						     echo $subcategory->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></p>
			</div>
		</div>
	  <hr>
		<div class="row"> 
		  <div class="col-sm-12">
		  	<p><b>Job Description</b> : <?php echo $deposit['job_description'] ?></p>
		  </div>
		  <div class="col-sm-4">
		   	<p><b>Pay By</b> : <?php echo GlobalFunction::getPayBy($deposit['exp_level'] ); ?></p> 
		  </div>
		  <div class="col-sm-4">
		  	<p><b>Exp Level</b> : <?php echo GlobalFunction::getExpLevel($deposit['pay_by'] ); ?></p>
		  </div>
	      <div class="col-sm-4">
	    	<p><b>Rate</b> : <?php echo $deposit['rate'] ?></p>
	      </div>
		</div>
		<?php } ?>
	</div>
</div>
<div class="container-fluid">
  <div><h3>Bid-Post</h3></div>
</div>
<div class="sidebar-jobs box">
	<div class="container">
	    <?php if(!empty($userbidDetail )){
    		  foreach($userbidDetail as $bid){
	    		 ?>
		<div class="row">
	        <div class="col-sm-2 text-center">
	          <br>
	          <img src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$bid['image'];?> " class="img-circle" height="65" width="65" alt="Avatar">
	        </div>
	        <div class="col-sm-10">
	          <h4><?php echo $bid['job_title'] ?> </h4>
	          <p><?php echo $bid['job_description'] ?></p>
	          <br>
		          <div class="col-sm-5">
		        	<p><b>How Long</b> : <?php echo GlobalFunction::HowLong($bid['how_long'] ); ?></p>
		        	<p><b>Exp Level </b> : <?php echo GlobalFunction::getExpLevel($bid['exp_level '] ); ?></p>
		        	<p><b>Rate</b> : <?php echo $bid['rate']; ?></p>
		        </div>
		        <div class="col-sm-5">
		        	<p><b>Pay By</b> : <?php echo GlobalFunction::getPayBy($bid['pay_by'] ); ?></p>
		        	<p><b>Commitment</b> : <?php echo GlobalFunction::getcommitment($bid['commitment'] ); ?></p>
		        	<p><b>Work Type</b> : <?php echo GlobalFunction::getworkType($bid['work_type '] ); ?></p>
		        	 
		        </div>
		        <div class="col-sm-10">
		        	<p><b><h4>Skill</h4></b><?php $skill = $bid['skill'];
		        	      $skilljson =  json_decode($skill);?>
                    		<table class="table table-bordered table-striped" id="datatable1">
		                    <tr>
						        <th>Subcategory Name</th>
						        <th>Description</th>
						        <th>Service Name</th>
						        <th>Category</th>
						        <th>Start Time</th>
						        <th>Price</th>
						        <th>Price Type</th>
						        <th>Category Name</th>
						        <th>Subcategory</th>
						        <th>End Time</th>
						        <th>Service Photo</th>
						               
						    </tr>
		                    <?PHP
	                    	if(!empty($skilljson)){
	    		     			foreach($skilljson as $skil){ 
	                    	?> 
	                    		<tr>
		                            <td><?php echo $skil->subcategory_name; ?></td>
		                            <td><?php echo $skil->description; ?></td>
		                            <td><?php echo $skil->service_name; ?></td>
		                            <td><?php echo $skil->category_id; ?></td>
		                            <td><?php echo $skil->start_time; ?></td>
		                            <td><?php echo $skil->price; ?></td>
		                            <td><?php echo $skil->price_type; ?></td>
		                            <td><?php echo $skil->category_name; ?></td>
		                            <td><?php echo $skil->subcategory_id; ?></td>
		                            <td><?php echo $skil->end_time; ?></td>
		                            <td><?php $servic = $skil->service_photo;
						    			foreach($servic as $servicphoto){ 
									    ?>
				                    	<img height="80px" width="80px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$servicphoto?> " />
				                    	<?php  } ?>
		                            </td>
		                        </tr>
		                    <?php } }?>   
		                    </table> 
		                    </p>
	                    <p><b>Description</b> : <?php echo $bid['description']; ?></p>  
	                     <p><h4>Attachments : </h4><br> <?php  $attaimage = $bid['attachments']; 
						    $attaimage = str_replace('[','',$attaimage);
						    $attaimage = str_replace(']','',$attaimage);
						    $attaimage = str_replace('"','',$attaimage);
						    $attaimages = explode(',',$attaimage);
						    foreach($attaimages as $attaimagess){
						    ?>
	                    	<img height="80px" width="80px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$attaimagess?> " />
	                    	<?php  } ?></p>      
		        </div>
		        <div class="col-sm-12">
					  <a href="#demo" class="btn btn-info" data-toggle="collapse">My InFormation </a>
					    <div id="demo" class="collapse">
					        <p><h4>Client Attachments  : </h4><br> <?php $ClientAttaimage = $bid['client_attachments']; 
						    $ClientAttaimage = str_replace('[','',$ClientAttaimage);
						    $ClientAttaimage = str_replace(']','',$ClientAttaimage);
						    $ClientAttaimage = str_replace('"','',$ClientAttaimage);
						    $ClientAttaimage = explode(',',$ClientAttaimage);
						    foreach($ClientAttaimage as $Clientattaimagess){  
						    ?>
	                    	<img height="80px" width="80px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$Clientattaimagess?> " />
	                    	<?php  } ?></p> 
					        <hr />
		                    <p><b><h4>Selected Skill </h4></b> <?php $Selectedskillall = $bid['selected_skill'];
		                    $skillaa = json_decode($Selectedskillall); ?>
			                    <table class="table table-bordered table-striped" id="datatable1">
			                    <tr>
							        <th>Subcategory Name</th>
							        <th>Description</th>
							        <th>Category</th>
							        <th>Start Time</th>
							        <th>Price</th>
							        <th>Price Type</th>
							        <th>Category Name</th>
							        <th>Subcategory</th>
							        <th>End Time</th>
							        <th>Service Photo</th>
							               
							    </tr>
			                    <?PHP
		                    	if(!empty($skillaa)){
		    		     			foreach($skillaa as $ski){ 
		                    	?> 
		                    		<tr>
			                            <td><?php echo $ski->subcategory_name; ?></td>
			                            <td><?php echo $ski->description; ?></td>
			                            <td><?php echo $ski->category_id; ?></td>
			                            <td><?php echo $ski->start_time; ?></td>
			                            <td><?php echo $ski->price; ?></td>
			                            <td><?php echo $ski->price_type; ?></td>
			                            <td><?php echo $ski->category_name; ?></td>
			                            <td><?php echo $ski->subcategory_id; ?></td>
			                            <td><?php echo $ski->end_time; ?></td>
			                            <td><?php $servicc = $ski->service_photo;
			                             foreach($servicc as $selectservicphoto){ 
										    ?>
					                    	<img height="80px" width="80px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$selectservicphoto?> " />
					                    	<?php  } ?>
			                                </td>
			                        </tr>
			                    <?php } }?>
			                    </table>
		                    </p>  
	                       <p><b>Address</b> : <?php echo $bid['address'] ?></p>
		                   <p><B>Note</B> : <?php echo $bid['notes'] ?></p>
		                   <p><B>Signature</B> : <img height="80px" width="80px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/image/'.$bid ['signature']?> " /></p>
					       <div class="col-sm-12">
					       	<div class="col-sm-5">
					       		<p><B>Preferred Datetime</B> : <?php echo $bid['preferred_datetime'] ?></p>
					       	</div>
					       	<div class="col-sm-5">
					       		<p><B>Response Datetime</B> : <?php echo $bid['response_datetime'] ?></p>
					       	</div>
					       </div>
					    </div>
		        </div>
		    </div>
        </div>
		<hr />
		 <?php }} ?> 
	</div>  
</div> 
      

<script>
$(document).ready(function(){
    var t = $('#datatable').DataTable( {
        "order": [[ 0, 'desc' ]]
    } );
});
</script>
