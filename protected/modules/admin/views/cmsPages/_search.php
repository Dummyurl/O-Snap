<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<!--div class="row">
		<?php echo $form->label($model, 'page_id'); ?>
		<?php echo $form->textField($model, 'page_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'page_name'); ?>
		<?php echo $form->textField($model, 'page_name', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'page_description'); ?>
		<?php echo $form->textArea($model, 'page_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'page_title'); ?>
		<?php echo $form->textField($model, 'page_title', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_active'); ?>
		<?php echo $form->dropDownList($model, 'is_active', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div-->

<?php $this->endWidget(); ?>

</div><!-- search-form -->
