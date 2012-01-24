<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastchange_id')); ?>:</b>
	<?php echo CHtml::encode($data->lastchange_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastchange')); ?>:</b>
	<?php echo CHtml::encode($data->lastchange); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_type')); ?>:</b>
	<?php echo CHtml::encode($data->tag_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_name')); ?>:</b>
	<?php echo CHtml::encode($data->tag_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_name_lower')); ?>:</b>
	<?php echo CHtml::encode($data->tag_name_lower); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>