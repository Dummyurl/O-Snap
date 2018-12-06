<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'client-user-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'osnap_id'); ?>
		<?php echo $form->textField($model, 'osnap_id', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'osnap_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_osnap_id'); ?>
		<?php echo $form->textField($model, 'business_osnap_id', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'business_osnap_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model, 'username', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'username'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model, 'password', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'password'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'first_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'last_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'birth_date',
			'value' => $model->birth_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'birth_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'country_code'); ?>
		<?php echo $form->textField($model, 'country_code', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'country_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('maxlength' => 13)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model, 'city', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'city'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model, 'state', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'state'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model, 'country', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'country'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'post_code'); ?>
		<?php echo $form->textField($model, 'post_code', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'post_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model, 'address'); ?>
		<?php echo $form->error($model,'address'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model, 'latitude'); ?>
		<?php echo $form->error($model,'latitude'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'longtitude'); ?>
		<?php echo $form->textField($model, 'longtitude'); ?>
		<?php echo $form->error($model,'longtitude'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_type'); ?>
		<?php echo $form->textField($model, 'user_type'); ?>
		<?php echo $form->error($model,'user_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent_user'); ?>
		<?php echo $form->textField($model, 'parent_user'); ?>
		<?php echo $form->error($model,'parent_user'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_name'); ?>
		<?php echo $form->textField($model, 'business_name', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'business_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_type'); ?>
		<?php echo $form->textField($model, 'business_type'); ?>
		<?php echo $form->error($model,'business_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_category'); ?>
		<?php echo $form->textField($model, 'business_category'); ?>
		<?php echo $form->error($model,'business_category'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_owner'); ?>
		<?php echo $form->textField($model, 'business_owner', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'business_owner'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'business_image'); ?>
		<?php echo $form->textField($model, 'business_image', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'business_image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'auth_id'); ?>
		<?php echo $form->textField($model, 'auth_id', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'auth_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'auth_provider'); ?>
		<?php echo $form->textField($model, 'auth_provider', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'auth_provider'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model, 'token', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'token'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model, 'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_type'); ?>
		<?php echo $form->textField($model, 'device_type'); ?>
		<?php echo $form->error($model,'device_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_token'); ?>
		<?php echo $form->textField($model, 'device_token', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'device_token'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'activation_code'); ?>
		<?php echo $form->textField($model, 'activation_code', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'activation_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'forget_pass_code'); ?>
		<?php echo $form->textField($model, 'forget_pass_code', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'forget_pass_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'base'); ?>
		<?php echo $form->textField($model, 'base'); ?>
		<?php echo $form->error($model,'base'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkBox($model, 'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'is_agree'); ?>
		<?php echo $form->checkBox($model, 'is_agree'); ?>
		<?php echo $form->error($model,'is_agree'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->