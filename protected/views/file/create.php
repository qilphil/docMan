<?php
$this->breadcrumbs=array(
	'File'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Files', 'url'=>array('index')),
	array('label'=>'Manage Files', 'url'=>array('admin')),
);
?>

<h1>Create File</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>