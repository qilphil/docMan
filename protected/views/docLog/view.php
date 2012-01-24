<?php
$this->breadcrumbs=array(
	'Doc Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List docLog', 'url'=>array('index')),
	array('label'=>'Create docLog', 'url'=>array('create')),
	array('label'=>'Update docLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete docLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage docLog', 'url'=>array('admin')),
);
?>

<h1>View docLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'logtime',
		'log_text',
		'log_data',
		'log_table',
		'log_item',
	),
)); ?>
