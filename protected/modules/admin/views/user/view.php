
<style>
	.green{
		color: #0e3f21;
	}
	.red{
		color: #ff0000;
	}
	.blue{
		color: #1803af;
	}
	.gray{
		color: #5e555a;
	}
	.yello{
		color: #c1a82f;
		
	}
</style>
<?php
$this->breadcrumbs = array(
	$model->label(2) => array('index'), 
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	/*array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?'),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php 
	$user_type = User::model()->findByAttributes(array('id'=>$_GET['id']));
	if($user_type->user_type == 1){
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
				'id',
				'osnap_id',
				'business_osnap_id',
				'username',
				'password',
				'email',
				'first_name',
				'last_name',
				'birth_date', 
				'phone',
				'city',
				'state',
				'country',
				'post_code',
				'address',
				//'image',
				array( 
				   'name' => 'image',
				   'type' => 'raw',
				   'value' => CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($model->image)? $model->image: "noimage.png"),"image",array("width"=>70,"class" => "userimg")),
				   //'filter' => false,
				),
				//'user_type',
				array(
				   'name' => 'user_type',
				   'value' => GlobalFunction::getUserType($model->user_type),
				),
				'is_active:boolean',
				'is_agree:boolean',
			),
		));
	}else{
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
				'id',      
				'osnap_id',
				'business_osnap_id',
				'username',
				'password',
				'email',
				'first_name',
				'last_name',
				'birth_date', 
				'phone',
				'city',
				'state',
				'country',
				'post_code',
				'address',
				//'image',
				array( 
				   'name' => 'image',
				   'type' => 'raw',
				   'value' => CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($model->image)? $model->image: "noimage.png"),"image",array("width"=>70,"class" => "userimg")),
				   //'filter' => false,
				),
				array(
				   'name' => 'user_type',
				   'value' => GlobalFunction::getUserType($model->user_type),
			    ),
				'parent_user',
				'business_name',
			    array(
				   'name' => 'business_type',
				   'value' => GlobalFunction::getBusinessTypes($model->business_type),
				),
				array(
				   'name' => 'business_category',
				   'value' => GlobalFunction::getBusinessCategory($model->business_category),
				),
				//'business_category',
				'business_owner',
					array( 
				   'name' => 'business_image',
				   'type' => 'raw',
				   'value' => CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($model->business_image)? $model->business_image: "noimage.png"),"business Image",array("width"=>70,"class" => "userimg")),
				   //'filter' => false,
				),
				'is_active:boolean',
				'is_agree:boolean',
				
			),
		));
	}
	
?>
  
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
  <!--<p>The .table-bordered class adds borders to a table:</p>-->
  <table class="table table-bordered table-striped" id="datatable">
    <thead class="table_head">
      <tr>
        <th>Post Id</th>
        <th>Job Title</th>
        <th>category</th>
        <th>sub category</th>
        <th>Work Type</th>
        <th>Status</th>        
        <th>Operation</th>        
      </tr>
    </thead>
    <tbody>
    <?php
    	if(!empty($deposit)){
	    		foreach($deposit as $ord){ ?>
	    		<tr>
	    		  <td><?php echo $ord['user_id'] ?></td>
	    		  <td><?php echo $ord['job_title'] ?></td>
	    		  <td><?php 
	    		  $category = Category::model()->find("id='".$ord['category_id']."'");
						  if(!empty($category)){
						   
						     echo $category->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></td>
	    		  <td><?php 
	    		  $subcategory = Category::model()->find("id='".$ord['subcategory_id']."'");
						  if(!empty($subcategory)){
						   
						     echo $subcategory->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></td>
	    		  <td><?php echo GlobalFunction::getworkType($ord['work_type'] ); ?></td>
	    		  <!--<td><?php echo $ord['subcategory_id'] ?></td>-->
	    		  <td>
	        			
	        			<?php //echo GlobalFunction::getStatus($ord['status'] ); ?>
	        			<?php 
		    		 		$status = GlobalFunction::getStatus($ord['status'] ); 
		    		 	?>
		    		 	<span class="<?php echo ($status == 'Active' ? 'green' : ($status == 'Running' ? 'yello' : ($status == 'Completed' ? 'blue' : ($status == 'Deactive' ? 'red' : ($status == 'Cancled' ? 'red' : ''))))) ?>"><?php echo $status; ?></span>
	        	  </td>
	        	  <td><a href="<?php echo Yii::app()->getBaseUrl(TRUE).'/admin/user/PostView/id/'.$ord['post_id'] ?>"><i class="fa fa-eye"></i></a> </td>	
                </tr>	    		  
				<?php }
    		}
    ?>		
      	
    </tbody>
  </table>
</div>

<div class="container-fluid">
  <div><h3>Direct Offer</h3></div>
  <!--<p>The .table-bordered class adds borders to a table:</p>-->
  <table class="table table-bordered table-striped" id="datatable1">
    <thead class="table_head">
      <tr>
        <th>Pb id</th>
        <th>Job Title</th>
        <th>Category</th>
        <th>Sub category</th>
        <th>Status</th>
        <th>Operation</th>        
      </tr>
    </thead>
    <tbody>
    <?php
    	if(!empty($postbid)){
	    		foreach($postbid as $bid){ ?>
	    		<tr>
	    		  <td><?php echo $bid['pb_id'] ?></td>
	    		  <td><?php echo $bid['job_title'] ?></td>
	    		  <td><?php 
	    		  $category = Category::model()->find("id='".$bid['category_id']."'");
						  if(!empty($category)){
						   
						     echo $category->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></td>
	    		  <td><?php 
	    		  $subcategory = Category::model()->find("id='".$bid['subcategory_id']."'");
						  if(!empty($subcategory)){
						   
						     echo $subcategory->title;
						   
						  }else{
						   
						   echo "-";
						  }
	    		  ?></td>
	    		 <td> <?php echo GlobalFunction::getStatus($ord['status'] ); ?> </td>
	    		  <td>
	        			<a href="<?php echo Yii::app()->getBaseUrl(TRUE).'/admin/user/PostbidView/id/'.$bid['pb_id'] ?>"><i class="fa fa-eye"></i></a>
	        			
	        	  </td>	
                </tr>	    		  
				<?php }
    		}
    ?>		
      	
    </tbody>
  </table>
</div>



<script>
$(document).ready(function(){
    var t = $('#datatable1').DataTable( {
        "order": [[ 0, 'desc' ]]
    } );
});
</script>


<script>
$(document).ready(function(){
    var t = $('#datatable').DataTable( {
        "order": [[ 0, 'desc' ]]
    } );
});
</script>



 