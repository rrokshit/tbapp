<?php
/* @var $this AgencyAccountdetailController */
/* @var $model agencyAccountdetail */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Agency Accountdetails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List agencyAccountdetail', 'url'=>array('index')),
	array('label'=>'Create agencyAccountdetail', 'url'=>array('create')),
	array('label'=>'Update agencyAccountdetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete agencyAccountdetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage agencyAccountdetail', 'url'=>array('admin')),
);
?>

<h1>View Agency Account detail For <?php echo Agencymoredetail::model()->getBranchname($model->agency_name); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		array(
			'name'=>'agency_name',
			'value'=>Agencymoredetail::model()->getBranchname($model->agency_name),
		),
		
		'account_type',
		'bank_name',
		'account_number',
		'account_holder_name',
		'ifsc_no',
		'switf_no',
		'micr_code',
		'branch_name',
		'address',
		'country',
		'state',
		'city',
		'email_id',
		'phone_no',
		'mobile_no',
	),
)); ?>
