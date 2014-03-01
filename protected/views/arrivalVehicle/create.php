<?php
$this->breadcrumbs=array(
	'Arrival Vehicles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArrivalVehicle', 'url'=>array('index')),
	array('label'=>'Manage ArrivalVehicle', 'url'=>array('admin')),
);
?>

<h1>Create ArrivalVehicle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>