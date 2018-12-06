<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('admin')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('business-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<!--<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
));*/ ?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'business-user-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
            'id'=>'id',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '50', 
            //'value' => $data->event_id, 
            //'checkBoxHtmlOptions' => array('name' => 'idList[]'),
        ),
		array(
			'name'=>'image',
			'type' => 'raw',
			'value' => 'CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . $data->image,"image",array("width"=>80))',
			'filter' => false,
		),
		'first_name',
		'last_name',
		'email',
		array(
			'name' => 'is_active',
			'value' => '($data->is_active === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
		),
		array(
			'name' => 'is_agree',
			'value' => '($data->is_agree === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
		),
		/*
		'id',
		'status',
		'username',
		'osnap_id',
		'business_osnap_id',
		'password',
		'birth_date',
		'country_code',
		'phone',
		'city',
		'state',
		'country',
		'post_code',
		'address',
		'latitude',
		'longtitude',
		'user_type',
		'parent_user',
		'business_name',
		'business_type',
		'business_category',
		'business_owner',
		'business_image',
		'auth_id',
		'auth_provider',
		'token',
		'created_at',
		'device_type',
		'device_token',
		'activation_code',
		'forget_pass_code',
		'base',
		*/
		array(
		   	'header'=>'Operations',
		   	'class'=>'CButtonColumn',
		 	'template'=>'{view}{delete}',
		),
	),
)); ?>



<input type="button" name="mdelete" id="mdelete" value="Delete" onclick="act();" />  



<script type="text/javascript">
var is_check = 0;
	function act()
	{
		var idList = "";
		$('input[type=checkbox]:checked').each(function () {
		    idList += (idList == "" ? '' : ',') + $(this).val();
		});		

		//alert(idList);
		if(idList)
		{
			if(confirm('Are you sure want to delete?'))
			{
			$.ajax({
    			type: "POST",
    		  	url: "<?= Yii::app()->getBaseUrl() ?>/admin/BusinessUser/multipaldelete",
    		  	data: "idList="+idList,
    		  	success: function(data) {
              		location.reload();
              		//alert(data);
             	}
    		});
				
			}
		}
	}
	$(document).ajaxSend(function() {
	   is_check = 1;
	}).ajaxComplete(function() {
	    
	});
	$(document).ready(function() {
		function my_rapid_call() {
		   $(".page.selected").find('a').trigger( "click" );
		    if(is_check == 0){
		    	setTimeout( my_rapid_call, 1000 );
		    }
		}
		my_rapid_call();
        
    });
	
</script>