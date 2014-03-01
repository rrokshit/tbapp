<?php
/* @var $this HotelTariffController */
/* @var $model HotelTariff */

$this->breadcrumbs=array(
	'Hotel Tariffs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HotelTariff', 'url'=>array('index')),
	array('label'=>'Create HotelTariff', 'url'=>array('create')),
	array('label'=>'View HotelTariff', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HotelTariff', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>