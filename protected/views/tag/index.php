<?php
$this->breadcrumbs=array(
	'Tag',
);

$this->menu=array(
	array('label'=>'Create Tags', 'url'=>array('create')),
	array('label'=>'Manage Tag', 'url'=>array('admin')),
);
?>

<h1>Tag</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
