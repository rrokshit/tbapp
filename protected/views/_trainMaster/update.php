<?php
/* @var $this TrainMasterController */
/* @var $model TrainMaster */

$this->breadcrumbs=array(
	'Train Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
	$model_flight->id=>array('view','id'=>$model_flight->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TrainMaster', 'url'=>array('index')),
	array('label'=>'Create TrainMaster', 'url'=>array('create')),
	array('label'=>'View TrainMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TrainMaster', 'url'=>array('admin')),
);
?>
 
 
   
<?php echo $this->renderPartial('_form', array('model'=>$model,'model_flight' => $model_flight, 'model_bus'=>$model_bus,'modelFrom' => $modelFrom,'modelTo' => $modelTo,'modelNumber' => $modelNumber));?>