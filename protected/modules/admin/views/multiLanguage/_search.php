<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noti_key'); ?>
		<?php echo $form->textField($model, 'noti_key', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noti_eng'); ?>
		<?php echo $form->textArea($model, 'noti_eng'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noti_other'); ?>
		<?php echo $form->textArea($model, 'noti_other'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
