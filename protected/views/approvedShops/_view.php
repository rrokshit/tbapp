<?php
/* @var $this ApprovedMasterController */
/* @var $data ApprovedMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shops_name')); ?>:</b>
	<?php echo CHtml::encode($data->shops_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_no')); ?>:</b>
	<?php echo CHtml::encode($data->phone_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_name')); ?>:</b>
	<?php echo CHtml::encode($data->contact_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile_no')); ?>:</b>
	<?php echo CHtml::encode($data->mobile_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_r')); ?>:</b>
	<?php echo CHtml::encode($data->phone_r); ?>
	<br />

	*/ ?>

</div>