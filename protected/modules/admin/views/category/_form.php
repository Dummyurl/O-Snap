<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'category-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		
		<div class="row">
			<?php echo $form->labelEx($model,'parent'); ?>
		 	<?php $perentmodel = Category::model()->findAll('parent=0');
					$list = CHtml::listData($perentmodel,'id', 'title');			
					$list[0]= 'Select Parent category';
					ksort($list);
			echo $form->dropDownList($model,'parent',$list );
			 ?>
		   <?php echo $form->error($model,'parent'); ?>
		</div>
		
		
		
		<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->

	<?php if($model->isNewRecord!='1'){ ?>
		<div class="row">
		     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/image/'.$model->image,"image",array("width"=>200)); ?>
		</div>
		<?php } ?>
		<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkBox($model, 'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->