<?php
$this->breadcrumbs=array(
	'Doc Logs',
);

$this->menu=array(
	array('label'=>'Create docLog', 'url'=>array('create')),
	array('label'=>'Manage docLog', 'url'=>array('admin')),
);
?>

<h1>Doc Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
