<?php
/* @var $this VehicleMasterController */
/* @var $model VehicleMaster */
$this->layout="travel_layout_content";

?>

<style>
	.container{
		background:none;
	}
	table{
		border-radius:10px;
	}
	tr.odd, tr.even{
		background:#FFF;
	}
</style>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name', 
		'registration_number', 
		'short_code', 
		'owner', 
		'address', 
		'country', 
		'city', 
		'state', 
		'engine_number', 
		'chesis_number', 
		'registration_date', 
		'model', 
		'permit_number'
		
	)
)); ?>
