<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pnr_no')); ?>:</b>
	<?php echo CHtml::encode($data->pnr_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicleCategory')); ?>:</b>
	<?php echo CHtml::encode($data->vehicleCategory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acOrNot')); ?>:</b>
	<?php echo CHtml::encode($data->acOrNot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noOfVehicle')); ?>:</b>
	<?php echo CHtml::encode($data->noOfVehicle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particularDate')); ?>:</b>
	<?php echo CHtml::encode($data->particularDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicleNumber')); ?>:</b>
	<?php echo CHtml::encode($data->vehicleNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driverName')); ?>:</b>
	<?php echo CHtml::encode($data->driverName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driverMobile')); ?>:</b>
	<?php echo CHtml::encode($data->driverMobile); ?>
	<br />

	*/ ?>

</div>