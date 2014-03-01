<?php
/* @var $this HotelTariffController */
/* @var $data HotelTariff */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_category')); ?>:</b>
	<?php echo CHtml::encode($data->room_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_type')); ?>:</b>
	<?php echo CHtml::encode($data->room_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_cpai')); ?>:</b>
	<?php echo CHtml::encode($data->s_cpai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_mapi')); ?>:</b>
	<?php echo CHtml::encode($data->s_mapi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_apai')); ?>:</b>
	<?php echo CHtml::encode($data->s_apai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('w_cpai')); ?>:</b>
	<?php echo CHtml::encode($data->w_cpai); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('w_mapi')); ?>:</b>
	<?php echo CHtml::encode($data->w_mapi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('w_apai')); ?>:</b>
	<?php echo CHtml::encode($data->w_apai); ?>
	<br />

	*/ ?>

</div>