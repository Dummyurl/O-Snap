<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'cms-pages-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'page_name'); ?>
		<?php echo $form->textField($model, 'page_name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'page_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'page_description'); ?>
		<?php
		Yii::import('ext.krichtexteditor.KRichTextEditor');
		$this->widget('KRichTextEditor', array(
			'model' => $model,
			'value' => $model->isNewRecord ? $model->page_description : '',
			'attribute' => 'page_description',
			'options' => array(
				'theme_advanced_resizing' => 'true',
				'theme_advanced_statusbar_location' => 'bottom',
			),
		));
		 //echo $form->textArea($model, 'page_description'); ?>
		<?php echo $form->error($model,'page_description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<?php if($model->isNewRecord!='1'){ ?>
		<script>
		document.getElementById("CmsPages_page_name").disabled = true;
			
		</script>
		<div class="row">
		     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/image/'.$model->image,"image",array("width"=>200)); ?>  
		</div>
		<?php } ?>
		<div class="row">
		<?php echo $form->labelEx($model,'page_title'); ?>
		<?php echo $form->textField($model, 'page_title', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'page_title'); ?>
		</div><!-- row -->
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