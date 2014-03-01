<?php
/* @var $this VehicleMasterController */
/* @var $data VehicleMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_name')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_name')); ?>:</b>
	<?php echo CHtml::encode($data->owner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fathers_husband_name')); ?>:</b>
	<?php echo CHtml::encode($data->fathers_husband_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('registration_number')); ?>:</b>
	<?php echo CHtml::encode($data->registration_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('registration_date')); ?>:</b>
	<?php echo CHtml::encode($data->registration_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engine_number')); ?>:</b>
	<?php echo CHtml::encode($data->engine_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chesis_number')); ?>:</b>
	<?php echo CHtml::encode($data->chesis_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_number')); ?>:</b>
	<?php echo CHtml::encode($data->permit_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_validity')); ?>:</b>
	<?php echo CHtml::encode($data->permit_validity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_vehicle')); ?>:</b>
	<?php echo CHtml::encode($data->type_vehicle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_category')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_type')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_number')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seating_capacity')); ?>:</b>
	<?php echo CHtml::encode($data->seating_capacity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_name')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_upload')); ?>:</b>
	<?php echo CHtml::encode($data->file_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />

	*/ ?>

</div>