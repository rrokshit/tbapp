<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pnr_no')); ?>:</b>
	<?php echo CHtml::encode($data->pnr_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicleByTb')); ?>:</b>
	<?php echo CHtml::encode($data->vehicleByTb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driverName')); ?>:</b>
	<?php echo CHtml::encode($data->driverName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driverNumber')); ?>:</b>
	<?php echo CHtml::encode($data->driverNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicleCategory')); ?>:</b>
	<?php echo CHtml::encode($data->vehicleCategory); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicleNumber')); ?>:</b>
	<?php echo CHtml::encode($data->vehicleNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outsideDriverName')); ?>:</b>
	<?php echo CHtml::encode($data->outsideDriverName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outsideDriverNumber')); ?>:</b>
	<?php echo CHtml::encode($data->outsideDriverNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outsideVehicleCategory')); ?>:</b>
	<?php echo CHtml::encode($data->outsideVehicleCategory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outsideVehicleNumber')); ?>:</b>
	<?php echo CHtml::encode($data->outsideVehicleNumber); ?>
	<br />

	*/ ?>

</div>