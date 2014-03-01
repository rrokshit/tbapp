<?php
/* @var $this BusMasterController */
/* @var $model BusMaster */
$this->layout = "travel_layout_content";
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

<h1><?php echo $model->short_code; ?></h1>


<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
		'short_code', 
		'from', 
		'to', 
		'arrival_time',
		'departure_time',
	),
));
?>
