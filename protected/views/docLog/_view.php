<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logtime')); ?>:</b>
	<?php echo CHtml::encode($data->logtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_text')); ?>:</b>
	<?php echo CHtml::encode($data->log_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_data')); ?>:</b>
	<?php echo CHtml::encode($data->log_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_table')); ?>:</b>
	<?php echo CHtml::encode($data->log_table); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_item')); ?>:</b>
	<?php echo CHtml::encode($data->log_item); ?>
	<br />


</div>