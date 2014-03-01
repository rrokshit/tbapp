<?php
/* @var $this FlightMasterController */
/* @var $model FlightMaster */
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

<?php 
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'short_code', 
		'name', 
		'from', 
		'to', 
		'arrival_time', 
		'departure_time'
		),
)); ?>
