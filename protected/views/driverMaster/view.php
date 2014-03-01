<?php $this->layout="travel_layout_content"; ?>

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
		'short_code', 
		'address', 
		'license_number', 
		'phone1', 
		'expiry_date', 
		'photo'
	),
)); ?>
