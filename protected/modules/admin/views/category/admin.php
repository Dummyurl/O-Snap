<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('admin')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
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
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'category-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'id',
		'title',
		/*'parent'=>array(
			'name'=>'parent',
			'type' => 'raw',
			'value' => '($data->parent == 0) ?  "---" : Attributes::getCodeName($data->parent)'
		),*/
		/*'parent',*/
		//'image',
		/*array(
			'name'=>'image',
			'type' => 'raw',
			'value' => 'CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . $data->image,"image",array("width"=>80))'

		),*/
		array(
		   'name' => 'image',
		   'type' => 'raw',
		   'value' => 'CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($data->image)? $data->image: "noimage.png"),"image",array("width"=>80,"class" => "userimg"))',
		   'filter' => false,
		),
		array(
					'name' => 'is_active',
					'value' => '($data->is_active == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
			'header' => 'Operation',
			'class' => 'CButtonColumn',
		),
	),
)); ?>

<!-- <input type="text" id="search">

<script language="javascript" type="text/javascript">

            $(document).ready(function() {
                        $('#search').keyup(function() {
                                    searchTable($(this).val());
                        });
            });
            function searchTable(inputVal) {
                        var table = $('#searchTable');
                        table.find('tr').each(function(index, row) {
                                    var allCells = $(row).find('td');
                                    if (allCells.length > 0) {
                                                var found = false;
                                                allCells.each(function(index, td) {
                                                            var regExp = new RegExp(inputVal, 'i');
                                                            if (regExp.test($(td).text())) {
                                                                        found = true;
                                                                        return false;
                                                            }
                                                });
                                                if (found == true)
                                                            $(row).show();
                                                else
                                                            $(row).hide();
                                    }
                        });
            }

</script> -->