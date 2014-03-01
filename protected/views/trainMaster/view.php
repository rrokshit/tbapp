<?php
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
		'type', 
		'number', 
		'status', 
		'arrival_time', 
		'dept_time', 
		'from', 
		'to', 
		'name', 
		'short_code'
	),
)); ?>
