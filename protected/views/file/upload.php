<?php
$this->breadcrumbs=array(
	'File'=>array('index'),
	'Upload File',
);

$this->menu=array(
	array('label'=>'List File', 'url'=>array('index')),
	array('label'=>'Manage File', 'url'=>array('admin')),
);
?>

<h1>Create File</h1>

<?php echo $this->renderPartial('_uploadform', array('model'=>$model)); ?>