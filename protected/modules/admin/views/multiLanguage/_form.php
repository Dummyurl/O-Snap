<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'multi-language-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'noti_key'); ?>
		<?php echo $form->textField($model, 'noti_key', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'noti_key'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'noti_eng'); ?>
		<?php echo $form->textArea($model, 'noti_eng'); ?>
		<?php echo $form->error($model,'noti_eng'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'noti_other'); ?>
		<?php echo $form->textArea($model, 'noti_other'); ?>
		<?php echo $form->error($model,'noti_other'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->