
<div class="container-fluid">
  <div><h3> Post Bid</h3></div>
</div>
<div class="sidebar-jobs box">
	<div class="container">
	 <?php
    	if(!empty($despostbid)){
	    		 ?>
		<div class="row">
		  <h3><?php echo $despostbid['job_title'] ?></h3>
		  <hr>
			<div class="col-sm-6">
			  <p><b>Work Type</b> : <?php echo GlobalFunction::getworkType($despostbid['work_type'] ); ?></p>
			  <p><b>HowLong</b> : <?php echo GlobalFunction::HowLong($despostbid['how_long'] ); ?></p>
			  <p><b>Category</b> : <?php 
	    		  $Category = Category::model()->find("id='".$despostbid['category_id']."'");
						  if(!empty($Category)){
						   
						     echo $Category->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></p>
			  <p><b>Commitment</b> : <?php echo GlobalFunction::getcommitment($despostbid['commitment'] ); ?></p> 
			  <p><b>PayBy</b> : pay by the hour</p> 
			  <p><b>Rate</b> : <?php echo $despostbid['rate'] ?></p>
			</div>
			<div class="col-sm-6">
			  <p><b>Sub Category</b> : <?php 
	    		    $subcategory = Category::model()->find("id='".$despostbid['subcategory_id']."'");
						  if(!empty($subcategory)){
						   
						     echo $subcategory->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></p>
	    		  <p><b>Address</b> : <?php echo $despostbid['address']; ?></p>
	    		  		  	<p><b>Exp Level :</b><?php echo GlobalFunction::getExpLevel($despostbid['exp_level'] ); ?></p>
			</div>
		</div>
	  <hr>
		<div class="row"> 
		  <div class="col-sm-12">
		  	<p><b>Job Description</b> : <?php echo $despostbid['job_description'] ?></p>
		  </div>
		</div>
		<div class="row"> 
		  <div class="col-sm-12">
		  	<p><b>Notes</b> : <?php echo $despostbid['notes'] ?></p>
		  </div>
		</div>
		<?php } ?>
	</div>
</div>
<script>
$(document).ready(function(){
    var t = $('#datatable').DataTable( {
        "order": [[ 0, 'desc' ]]
    } );
});
</script>