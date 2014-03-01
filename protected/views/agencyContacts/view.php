<?php
/* @var $this AgencymoredetailController */
/* @var $model Agencymoredetail */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Agencymoredetails'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Agencymoredetail', 'url'=>array('index')),
	array('label'=>'Create Agencymoredetail', 'url'=>array('create')),
	array('label'=>'Update Agencymoredetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Agencymoredetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agencymoredetail', 'url'=>array('admin')),
);
?>

<h1>View Contact Detail - <?php echo Agencymoredetail::model()->getBranchname($model->agency_name); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'designation',
		'name',
		'mobile_no',
		'Email_id',
		array(
			'name'=>'agency_name',
			'value'=>Agencymoredetail::model()->getBranchname($model->agency_name),
		),
	),
)); ?>
