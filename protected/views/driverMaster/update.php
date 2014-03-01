<?php
/* @var $this DriverMasterController */
/* @var $model DriverMaster */

$this->breadcrumbs=array(
	'Driver Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DriverMaster', 'url'=>array('index')),
	array('label'=>'Create DriverMaster', 'url'=>array('create')),
	array('label'=>'View DriverMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DriverMaster', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>