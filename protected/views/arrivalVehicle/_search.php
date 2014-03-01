<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pnr_no'); ?>
		<?php echo $form->textField($model,'pnr_no',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicleCategory'); ?>
		<?php echo $form->textField($model,'vehicleCategory',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acOrNot'); ?>
		<?php echo $form->textField($model,'acOrNot',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'noOfVehicle'); ?>
		<?php echo $form->textField($model,'noOfVehicle',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'particularDate'); ?>
		<?php echo $form->textField($model,'particularDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicleNumber'); ?>
		<?php echo $form->textField($model,'vehicleNumber',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driverName'); ?>
		<?php echo $form->textField($model,'driverName',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driverMobile'); ?>
		<?php echo $form->textField($model,'driverMobile',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->