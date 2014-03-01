<?php
/* @var $this DriverMasterController */
/* @var $data DriverMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_name')); ?>:</b>
	<?php echo CHtml::encode($data->driver_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_number')); ?>:</b>
	<?php echo CHtml::encode($data->license_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_no')); ?>:</b>
	<?php echo CHtml::encode($data->phone_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiry_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('attchment_name')); ?>:</b>
	<?php echo CHtml::encode($data->attchment_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_upload')); ?>:</b>
	<?php echo CHtml::encode($data->file_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_upload')); ?>:</b>
	<?php echo CHtml::encode($data->photo_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_Birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_Birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_no1')); ?>:</b>
	<?php echo CHtml::encode($data->phone_no1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	*/ ?>

</div>