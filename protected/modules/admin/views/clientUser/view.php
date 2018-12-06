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

<h2><?php echo Yii::t('app', 'View') . ' Client Detail'; ?></h2>

<?php
$clientdata = Yii::app()->db->createCommand()
	->select('*')
	->from('user')
	->where('user_type=:user_type', array(':user_type'=>1))
	->andWhere('id='.$_GET['id'])
	->queryRow();
//print_r($clientdata);
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
	        <th> Phone </th>
	        <td><?php echo $clientdata['phone']; ?></td>
	      </tr>
	      <tr>
	        <th> Latitude & Longtitude  </th>
	        <td><?php echo $clientdata['latitude'].' - '.$clientdata['longtitude']; ?></td>
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
</div>
<style>
	table th{
		width:25%;
	}
</style>
