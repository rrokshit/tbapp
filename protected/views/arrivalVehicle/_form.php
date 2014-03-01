<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arrival-vehicle-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pnr_no'); ?>
		<?php echo $form->textField($model,'pnr_no',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pnr_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicleCategory'); ?>
		<?php echo $form->textField($model,'vehicleCategory',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vehicleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acOrNot'); ?>
		<?php echo $form->textField($model,'acOrNot',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'acOrNot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noOfVehicle'); ?>
		<?php echo $form->textField($model,'noOfVehicle',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'noOfVehicle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'particularDate'); ?>
		<?php echo $form->textField($model,'particularDate'); ?>
		<?php echo $form->error($model,'particularDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicleNumber'); ?>
		<?php echo $form->textField($model,'vehicleNumber',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'vehicleNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'driverName'); ?>
		<?php echo $form->textField($model,'driverName',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'driverName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'driverMobile'); ?>
		<?php echo $form->textField($model,'driverMobile',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'driverMobile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->