<?php
/* @var $this HotelImagesController */
/* @var $model HotelImages */

$this->breadcrumbs=array(
	'Hotel Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HotelImages', 'url'=>array('index')),
	array('label'=>'Create HotelImages', 'url'=>array('create')),
	array('label'=>'Update HotelImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HotelImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HotelImages', 'url'=>array('admin')),
);
?>

<h1>View HotelImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'caption',
		'hotel_id_fk',
	),
)); ?>
