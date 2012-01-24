<?php
$this->breadcrumbs=array(
	'Tag'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tags', 'url'=>array('index')),
	array('label'=>'Create Tag', 'url'=>array('create')),
	array('label'=>'Update Tag', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tag', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tags', 'url'=>array('admin')),
);
?>

<h1>View Tag #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'creator_id',
		'created',
		'lastchange_id',
		'lastchange',
		'tag_type',
		'tag_name',
		'tag_name_lower',
		'deleted',
	),
)); ?>
