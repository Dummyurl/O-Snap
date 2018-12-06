<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('app', 'View') . ' Business User Detail'; ?></h2>

<?php
$clientdata = Yii::app()->db->createCommand()
	->select('*')
	->from('user')
	->where('user_type=:user_type', array(':user_type'=>2))
	->andWhere('id='.$_GET['id'])
	->queryRow();

$user_experiance = Yii::app()->db->createCommand()
	->select('*')
	->from('user_experience')
	->andWhere('user_id='.$_GET['id'])
	->queryAll();

$user_skills = Yii::app()->db->createCommand()
	->select('*')
	->from('user_skill')
	->andWhere('user_id='.$_GET['id'])
	->queryAll();
?>
<div class="table-responsive"> 
	<table class="table table-striped">
	    <tbody>
	      <tr>
	        <th> Profile Picture </th>
	        <td><img width="80" src="<?php echo Yii::app()->getBaseUrl(true) . "/upload/image/" . $clientdata['image']; ?>"></td>
	      </tr>
	      <tr>
	        <th> First Name </th>
	        <td><?php echo $clientdata['first_name']; ?></td>
	      </tr>
	      <tr>
	        <th> Last Name </th>
	        <td><?php echo $clientdata['last_name']; ?></td>
	      </tr>
	      <tr>
	        <th> username </th>
	        <td><?php echo $clientdata['username']; ?></td>
	      </tr>
	      <tr>
	        <th> Email </th>
	        <td><?php echo $clientdata['email']; ?></td>
	      </tr>
	      <tr>
	        <th> O'snap ID </th>
	        <td><?php echo $clientdata['osnap_id']; ?></td>
	      </tr>
	      <tr>
	        <th> Birth Date </th>
	        <td><?php echo $clientdata['birth_date']; ?></td>
	      </tr>
	      <tr>
	        <th> Address </th>
	        <td><?php echo $clientdata['address']; ?></td>
	      </tr>
	      <tr>
	        <th> Postal Code </th>
	        <td><?php echo $clientdata['post_code']; ?></td>
	      </tr>
	    </tbody>
  	</table>
  	
  	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th colspan="2"><h3 class="text-center"> User Experiance </h3></th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    $no = 0;
	    foreach($user_experiance as $exp){
	    	$no++; ?>
	    	<tr>
	    		<th colspan="2"><?php echo '('.$no.')'; ?></th>
	    	</tr>
	      <tr>
	        <th> Comapany Name </th>
	        <td><?php echo $exp['company_name']; ?></td>
	      </tr>
	      <tr>
	        <th> From Date </th>
	        <?php
	        $dateObj   = DateTime::createFromFormat('!m', $exp['from_month']);
			$monthName = $dateObj->format('F');
	        ?>
	        <td><?php echo $monthName.' '.$exp['from_year']; ?></td>
	      </tr>
	      <tr>
	        <th> To Date </th>
	        <?php
	        $dateObj2   = DateTime::createFromFormat('!m', $exp['to_month']);
			$monthName2 = $dateObj2->format('F');
	        ?>
	        <td><?php echo $monthName2.' '.$exp['to_year']; ?></td>
	      </tr>
	      <tr>
	        <th> Education </th>
	        <td><?php echo $exp['education']; ?></td>
	      </tr>
	      <tr>
	        <th> Professional Experience  </th>
	        <td><?php echo $exp['professional_experience'].' Year'; ?></td>
	      </tr>
	    <?php } ?>
	    </tbody>
  	</table>
  	
  	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th colspan="2"><h3 class="text-center"> User Skills </h3></th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    $no2 = 0;
	    foreach($user_skills as $skill){
	  		$no2++; ?>
	  		<tr>
	    		<th colspan="2"><?php echo '('.$no2.')'; ?></th>
	    	</tr>
	      <tr>
	        <th> Service Name </th>
	        <td><?php echo $skill['service_name']; ?></td>
	      </tr>
	      <tr>
	        <th> Category </th>
	        <?php
	        $skill_category = BusinessCategory::model()->findByAttributes(array('id' => $skill['category_id']));
			?>
	        <td><?php echo $skill_category['name']; ?></td>
	      </tr>
	      <tr>
	        <th> Sub Category </th>
	        <?php
	        $skill_subcategory = BusinessTypes::model()->findByAttributes(array('id' => $skill['subcategory_id']));
			?>
	        <td><?php echo $skill_subcategory['name']; ?></td>
	      </tr>
	      <tr>
	        <th> Price </th>
	        <td><?php echo $skill['price']; ?> /hour</td>
	      </tr>
	      <tr>
	        <th> Start Time </th>
	        <td><?php echo $skill['start_time']; ?></td>
	      </tr>
	      <tr>
	        <th> End Time </th>
	        <td><?php echo $skill['end_time']; ?></td>
	      </tr>
	      <tr>
	        <th> description </th>
	        <td><?php echo $skill['description']; ?></td>
	      </tr>
	    <?php } ?>
	    </tbody>
  	</table>
</div>
<style>
	table th{ width:25%; }
</style>
