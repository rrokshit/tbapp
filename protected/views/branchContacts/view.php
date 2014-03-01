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
<h1>Contact Of Branch - <?php echo $model->branchIdFk->branch_name;?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'designation',
		array(
			'name'=>'branch_name',
			'value'=>$model->branchIdFk->branch_name,
		),
		'name',
		'mobile_no',
		'residence_number',
		'email_id',
	),
)); ?>
