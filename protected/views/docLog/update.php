<?php
$this->breadcrumbs=array(
	'Doc Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List docLog', 'url'=>array('index')),
	array('label'=>'Create docLog', 'url'=>array('create')),
	array('label'=>'View docLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage docLog', 'url'=>array('admin')),
);
?>

<h1>Update docLog <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>