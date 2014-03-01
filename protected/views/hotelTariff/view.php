<?php
/* @var $this HotelTariffController */
/* @var $model HotelTariff */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Hotel Tariffs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HotelTariff', 'url'=>array('index')),
	array('label'=>'Create HotelTariff', 'url'=>array('create')),
	array('label'=>'Update HotelTariff', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HotelTariff', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HotelTariff', 'url'=>array('admin')),
);
?>

<h1>View Hotel Tariff <?php echo HotelTariff::model()->getBranchname($model->hotel_name); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	
		
		array(
		'name'=>'hotel_name',
		'value'=>HotelTariff::model()->getBranchname($model->hotel_name),
		),
		'room_category',
		'room_type',
		's_cpai',
		's_mapi',
		's_apai',
		'w_cpai',
		'w_mapi',
		'w_apai',
	),
)); ?>
