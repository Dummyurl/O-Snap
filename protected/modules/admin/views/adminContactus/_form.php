<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'admin-contactus-form',
	'enableAjaxValidation' => false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'contact_fname'); ?>
		<?php echo $form->textField($model, 'contact_fname', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'contact_fname'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'contact_lname'); ?>
		<?php echo $form->textField($model, 'contact_lname', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'contact_lname'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model, 'contact_email', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'contact_phone'); ?>
		<?php echo $form->textField($model, 'contact_phone'); ?>
		<?php echo $form->error($model,'contact_phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'contact_msg'); ?>
		<?php echo $form->textField($model, 'contact_msg', array('maxlength' => 500)); ?>
		<?php echo $form->error($model,'contact_msg'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'contact_file'); ?>
		<?php echo $form->fileField($model, 'contact_file'); ?>
		<?php echo $form->error($model,'contact_file'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->