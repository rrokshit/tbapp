<?php
/* @var $this TrainMasterController */
/* @var $model TrainMaster */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Train Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TrainMaster', 'url'=>array('index')),
	array('label'=>'Create TrainMaster', 'url'=>array('create')),
	array('label'=>'Update TrainMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TrainMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TrainMaster', 'url'=>array('admin')),
);
?>

<h1>View Train Master <?php echo $model->train_flight_master; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'train_flight_master',
		'short_code',
	//	'number',
	//	'from',
	//	'to',
	//	'arrival_time',
	//	'dept_time',
	//	'choose_branch',
	)
)); ?>
