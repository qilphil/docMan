<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass_sha'); ?>
		<?php echo $form->textField($model,'pass_sha',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pass_sha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creator_id'); ?>
		<?php echo $form->textField($model,'creator_id'); ?>
		<?php echo $form->error($model,'creator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastchange'); ?>
		<?php echo $form->textField($model,'lastchange'); ?>
		<?php echo $form->error($model,'lastchange'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_profile'); ?>
		<?php echo $form->textField($model,'user_profile'); ?>
		<?php echo $form->error($model,'user_profile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->