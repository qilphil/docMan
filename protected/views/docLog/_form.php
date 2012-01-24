<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logtime'); ?>
		<?php echo $form->textField($model,'logtime'); ?>
		<?php echo $form->error($model,'logtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_text'); ?>
		<?php echo $form->textArea($model,'log_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'log_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_data'); ?>
		<?php echo $form->textField($model,'log_data'); ?>
		<?php echo $form->error($model,'log_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_table'); ?>
		<?php echo $form->textField($model,'log_table',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'log_table'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_item'); ?>
		<?php echo $form->textField($model,'log_item'); ?>
		<?php echo $form->error($model,'log_item'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->