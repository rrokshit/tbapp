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
<h1><?php echo $model->branch_name; ?> Branch</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'branch_name',
		'short_code',
		'address',
		'phone_no',
		'email_id',
		'country',
		'state',
		'city',
		'fax',
	),
)); ?>
