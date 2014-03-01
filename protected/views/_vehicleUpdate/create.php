<?php
$this->breadcrumbs=array(
	'Vehicle Updates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VehicleUpdate', 'url'=>array('index')),
	array('label'=>'Manage VehicleUpdate', 'url'=>array('admin')),
);
?>

<h1>Create VehicleUpdate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>