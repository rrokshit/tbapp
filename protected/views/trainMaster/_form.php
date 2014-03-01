<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
		<div class="title">
			<h3><i class="icon-book"></i>
			<span>Train Master
				<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("TrainMaster/admin"); ?>" class="btn btn-success">Trains</a>
				</span>
			</span>
			</h3>
		</div>
		<div class="content">
			<!-- Train Master Start -->

			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'train-master-form',
				'enableAjaxValidation' => false,
			));
			?>
			
			
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="Phone_no">Train Number</label>
				<div class="controls span7">
					<?php echo $form->textField($model, 'number',
					array('size' => 200, 'maxlength' => 200, 'class' => 'row-fluid')); ?>
				</div>
			</div>
			
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="name">Train Name</label>
				<div class="controls span7">
					<?php echo $form->textField($model, 'name',
					array('size' => 200, 'maxlength' => 200, 'class' => 'row-fluid')); ?>
				</div>
			</div>
			
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="type">Train Type</label>
				<div class="controls span7">
					<?php echo $form->textField($model, 'type',
					array('size' => 200, 'maxlength' => 200, 'class' => 'row-fluid')); ?>
				</div>
			</div>

			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="short_code">Short Code</label>
				<div class="controls span7">
					<?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
				</div>
			</div>
			
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="status">Status</label>
				<div class="controls span7">
					<?php echo $form->textField($model, 'status',
					array('size' => 200, 'maxlength' => 200, 'class' => 'row-fluid')); ?>
				</div>
			</div>

			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="default-select">From</label>
				<div class="controls span7">
					<?php 
						echo CHtml::activeDropDownList($model,'from',
															CHtml::listData(Places::model()->findAll(), 'id', 'name'),
															array(
																'id'=>'slTo',
																'empty'=>'Select Place',
																'options'=>array(
																	$model->from => array(
																		'selected'=>'true',
																	)
																)
															)); 
					?>		
				</div>
			</div>

			<div class="form-row control-group row-fluid">
				<label class="control-label span3">To</label>
				<div class="controls span7">
					<?php 
						echo CHtml::activeDropDownList($model,'to',
															CHtml::listData(Places::model()->findAll(), 'id', 'name'),
															array(
																'id'=>'slFrom',
																'empty'=>'Select Place',
																'options'=>array(
																	$model->to => array(
																		'selected'=>'true',
																	)
																)
															)); 
					?>	
				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="Arrival_time">Arrival Time</label>
				<div class="controls span7">
					
					HH <select name="TrainMaster[ahh]" style="width: 65px;">
						<?php
							if(!isset($model->arrival_time) || trim($model->arrival_time)===''){
								for ($i = 0; $i <= 23; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{
								$arrTime = explode(':',$model->arrival_time);
								for ($i = 0; $i <= 23; $i++) {
									if($arrTime[0]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}
							}
						?>
					</select>
					MM <select name="TrainMaster[amm]" style="width: 65px;">
						<?php
							if(!isset($model->arrival_time) || trim($model->arrival_time)===''){
								for ($i = 0; $i <= 59; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{								
								for ($i = 0; $i <= 59; $i++) {
									if($arrTime[1]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}
							}
						?>
					</select>

				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="Dept_Time">Departure Time</label>
				<div class="controls span7">
					HH <select name="TrainMaster[dhh]" style="width: 65px;">
						<?php
							$drrTime = explode(':',$model->dept_time);
							if(!isset($model->dept_time) || trim($model->dept_time)===''){
								for ($i = 0; $i <= 23; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{
								for ($i = 0; $i <= 23; $i++) {
									if($drrTime[0]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}							
							}
						?>
					</select>

					MM <select name="TrainMaster[dmm]" style="width: 65px;">
						<?php
							if(!isset($model->dept_time) || trim($model->dept_time)===''){
								for ($i = 0; $i <= 59; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{
								for ($i = 0; $i <= 59; $i++) {
									if($drrTime[0]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}							
							}
						?>
					</select>
				</div>
			</div>


			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="inputEmail">Choose Branch <span class="help-block"></span></label>
				<div class="controls span7">
					<?php 
						if($this->getAction()->getId() == 'create'){
							echo CHtml::activeDropDownList($model, 'branch_id_fk', $this->branches ,array('id'=>'slBranches'));
						}
						else{
							echo $this->updatedBranches;
						}
					?>
				</div>
			</div>
			<div class="form-actions row-fluid">
				<div class="span7 offset3">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<input type="reset" class="btn btn-secondary" value="Cancel"/>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>   
	</div>
<div>


<script>
//Train other option show or hide    
    $("#TrainMaster_train_flight_master").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTrain").css('display', 'block');
        } else {
            $("#otherTrain").css('display', 'none');
        }
    });

//Train Number Other option show or hide
    $("#TrainFlightNumber_trainFlightNumber").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherNumber").css('display', 'block');
        } else {
            $("#otherNumber").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_from").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherFrom").css('display', 'block');
        } else {
            $("#otherFrom").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_to").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTo").css('display', 'block');
        } else {
            $("#otherTo").css('display', 'none');
        }
    });
</script>
