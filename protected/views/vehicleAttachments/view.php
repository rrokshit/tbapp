<?php
/* @var $this VehicleAttachmentsController */
/* @var $model VehicleAttachments */

$this->breadcrumbs=array(
	'Vehicle Attachments'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List VehicleAttachments', 'url'=>array('index')),
	array('label'=>'Create VehicleAttachments', 'url'=>array('create')),
	array('label'=>'Update VehicleAttachments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VehicleAttachments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VehicleAttachments', 'url'=>array('admin')),
);
?>

<h1>View VehicleAttachments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'remark',
		'vehicle_id_fk',
	),
)); ?>
