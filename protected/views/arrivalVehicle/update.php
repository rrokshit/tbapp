<?php
$this->breadcrumbs=array(
	'Arrival Vehicles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArrivalVehicle', 'url'=>array('index')),
	array('label'=>'Create ArrivalVehicle', 'url'=>array('create')),
	array('label'=>'View ArrivalVehicle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ArrivalVehicle', 'url'=>array('admin')),
);
?>

<h1>Update ArrivalVehicle <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>