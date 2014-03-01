<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vehicle-update-form',
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
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicleByTb'); ?>
		<?php echo $form->textField($model,'vehicleByTb',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vehicleByTb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'driverName'); ?>
		<?php echo $form->textField($model,'driverName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'driverName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'driverNumber'); ?>
		<?php echo $form->textField($model,'driverNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'driverNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicleCategory'); ?>
		<?php echo $form->textField($model,'vehicleCategory',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'vehicleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicleNumber'); ?>
		<?php echo $form->textField($model,'vehicleNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'vehicleNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outsideDriverName'); ?>
		<?php echo $form->textField($model,'outsideDriverName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'outsideDriverName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outsideDriverNumber'); ?>
		<?php echo $form->textField($model,'outsideDriverNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'outsideDriverNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outsideVehicleCategory'); ?>
		<?php echo $form->textField($model,'outsideVehicleCategory',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'outsideVehicleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outsideVehicleNumber'); ?>
		<?php echo $form->textField($model,'outsideVehicleNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'outsideVehicleNumber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->