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
<h1><?php echo $model->service_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'service_name', 
		'short_code'
	
		
	),
)); ?>
