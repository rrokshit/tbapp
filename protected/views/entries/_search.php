<?php
/* @var $this EntriesController */
/* @var $model Entries */
/* @var $form CActiveForm */
?>

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
		<?php echo $form->label($model,'staff_name'); ?>
		<?php echo $form->textField($model,'staff_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'short_code'); ?>
		<?php echo $form->textField($model,'short_code',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrival_date'); ?>
		<?php echo $form->textField($model,'arrival_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agency'); ?>
		<?php echo $form->textField($model,'agency',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_name'); ?>
		<?php echo $form->textField($model,'client_name',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indian_adult'); ?>
		<?php echo $form->textField($model,'indian_adult'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indian_child'); ?>
		<?php echo $form->textField($model,'indian_child'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foreigner_adult'); ?>
		<?php echo $form->textField($model,'foreigner_adult'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foreigner_child'); ?>
		<?php echo $form->textField($model,'foreigner_child'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hotel_required'); ?>
		<?php echo $form->textField($model,'hotel_required'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_hotel'); ?>
		<?php echo $form->textField($model,'choose_hotel',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_room'); ?>
		<?php echo $form->textField($model,'choose_room',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'same_day'); ?>
		<?php echo $form->textField($model,'same_day',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assistance_on_arrival'); ?>
		<?php echo $form->textField($model,'assistance_on_arrival',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tour_reference_no'); ?>
		<?php echo $form->textField($model,'tour_reference_no',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oder_no'); ?>
		<?php echo $form->textField($model,'oder_no',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oder_date'); ?>
		<?php echo $form->textField($model,'oder_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driver_name'); ?>
		<?php echo $form->textField($model,'driver_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_no'); ?>
		<?php echo $form->textField($model,'vehicle_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile_no'); ?>
		<?php echo $form->textField($model,'mobile_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'out_site_driver'); ?>
		<?php echo $form->textField($model,'out_site_driver',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'outsite_drivername'); ?>
		<?php echo $form->textField($model,'outsite_drivername',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'outsite_vehicle_no'); ?>
		<?php echo $form->textField($model,'outsite_vehicle_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driver_mobile_no'); ?>
		<?php echo $form->textField($model,'driver_mobile_no'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->