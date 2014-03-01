<?php
$this->breadcrumbs=array(
	'Train Flight Numbers',
);

$this->menu=array(
	array('label'=>'Create TrainFlightNumber', 'url'=>array('create')),
	array('label'=>'Manage TrainFlightNumber', 'url'=>array('admin')),
);
?>

<h1>Train Flight Numbers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
