<?php
$this->breadcrumbs=array(
	'Doc Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List docLog', 'url'=>array('index')),
	array('label'=>'Manage docLog', 'url'=>array('admin')),
);
?>

<h1>Create docLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>