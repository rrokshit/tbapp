<?php
/* @var $this VehicleAttachmentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehicle Attachments',
);

$this->menu=array(
	array('label'=>'Create VehicleAttachments', 'url'=>array('create')),
	array('label'=>'Manage VehicleAttachments', 'url'=>array('admin')),
);
?>

<h1>Vehicle Attachments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
